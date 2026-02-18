package handlers

import (
	"database/sql"
	"html/template"
	"net/http"
	"net/url"
	"strconv"
	"strings"
	"time"

	"sadsgo/internal/config"
	"sadsgo/internal/db"
)

type Handler struct {
	Tmpl *template.Template
	DB   db.Connections
	Cfg  config.Config
}

func New(t *template.Template, dbc db.Connections, cfg config.Config) *Handler {
	return &Handler{Tmpl: t, DB: dbc, Cfg: cfg}
}

func (h *Handler) Index(w http.ResponseWriter, r *http.Request) {
	h.render(w, "index", nil)
}

func (h *Handler) Asistencia(w http.ResponseWriter, r *http.Request) {
	q := r.URL.Query()
	curso := q.Get("curso")
	mostrar := q.Has("mostrar")
	enviar := q.Has("enviar")
	materia := q.Get("materia")
	if materia == "" {
		materia = "General"
	}

	cursos, _ := h.fetchCursos()
	alumnos := []Alumno{}
	if mostrar && curso != "" {
		ciclo := time.Now().Year()
		alumnos, _ = h.fetchAlumnos(curso, ciclo)
	}

	mensaje := ""
	if enviar {
		ausentes := q["ausentes"]
		ij := parseIJ(q)
		_ = h.guardarFaltas(materia, ausentes, ij)
		mensaje = "Datos Guardados"
	}

	data := AsistenciaPage{
		Cursos:            cursos,
		Alumnos:           alumnos,
		CursoSeleccionado: curso,
		Mostrar:           mostrar,
		Materia:           materia,
		Mensaje:           mensaje,
		FechaForm:         time.Now().Format("02/01/06"),
	}

	h.render(w, "asistencia", data)
}

func (h *Handler) AsistenciaEF(w http.ResponseWriter, r *http.Request) {
	q := r.URL.Query()
	curso := q.Get("curso")
	mostrar := q.Has("mostrar")
	enviar := q.Has("enviar")

	cursos, _ := h.fetchCursos()
	alumnos := []Alumno{}
	if mostrar && curso != "" {
		ciclo := time.Now().Year()
		alumnos, _ = h.fetchAlumnos(curso, ciclo)
	}

	mensaje := ""
	if enviar {
		ausentes := q["ausentes"]
		ij := parseIJ(q)
		_ = h.guardarFaltas("EF", ausentes, ij)
		mensaje = "Datos Guardados"
	}

	data := AsistenciaEFPage{
		Cursos:            cursos,
		Alumnos:           alumnos,
		CursoSeleccionado: curso,
		Mostrar:           mostrar,
		Mensaje:           mensaje,
	}

	h.render(w, "asistenciaef", data)
}

func (h *Handler) AlumnosAusentes(w http.ResponseWriter, r *http.Request) {
	fecha := time.Now().Format("2006-01-02")
	ausentes, _ := h.fetchAusentes(fecha)

	data := AlumnosAusentesPage{
		Fecha:    fecha,
		Ausentes: ausentes,
	}

	h.render(w, "alumnosausentes", data)
}

func (h *Handler) Boletin(w http.ResponseWriter, r *http.Request) {
	q := r.URL.Query()
	cursoSel := q.Get("curso")
	mesSel, _ := strconv.Atoi(q.Get("mes"))
	if mesSel < 1 || mesSel > 12 {
		mesSel = int(time.Now().Month())
	}
	mostrar := q.Has("mostrar")

	cursos, _ := h.fetchCursos()

	data := BoletinPage{
		Cursos:            cursos,
		CursoSeleccionado: cursoSel,
		MesSeleccionado:   mesSel,
		Meses:             mesesLista(),
		Mostrar:           mostrar,
	}

	if mostrar && cursoSel != "" {
		planilla, headers, titulo, subtitulo := h.buildBoletin(cursoSel, mesSel)
		data.Planilla = planilla
		data.DiasHeaders = headers
		data.Titulo = titulo
		data.Subtitulo = subtitulo
	}

	h.render(w, "boletin", data)
}

func (h *Handler) Notificaciones(w http.ResponseWriter, r *http.Request) {
	data := NotificacionesPage{
		Anio: time.Now().Year(),
	}

	if r.Method == http.MethodPost {
		if err := r.ParseForm(); err == nil {
			asunto := strings.TrimSpace(r.FormValue("asunto"))
			data.Asunto = asunto
			if asunto == "" {
				data.Errores = append(data.Errores, "Debe completar la descripcion de la notificacion.")
			}

			if len(data.Errores) == 0 {
				agente := h.resolveAgente()
				numero, anio, err := h.insertNotificacion(asunto, agente)
				if err != nil {
					data.Errores = append(data.Errores, "No se pudo guardar en la base de datos.")
				} else {
					data.Guardado = true
					data.NotificacionNumero = strconv.Itoa(numero)
					data.NotificacionAnio = strconv.Itoa(anio)
					data.Asunto = strings.Title(asunto)
				}
			}
		}
	}

	h.render(w, "notificaciones", data)
}

func (h *Handler) VerNotificaciones(w http.ResponseWriter, r *http.Request) {
	desc := strings.TrimSpace(r.URL.Query().Get("descripcion"))
	filas, _ := h.fetchNotificaciones(desc)

	data := VerNotificacionesPage{
		Descripcion:    desc,
		Notificaciones: filas,
	}

	h.render(w, "ver_notificaciones", data)
}

func (h *Handler) NotificacionAusente(w http.ResponseWriter, r *http.Request) {
	q := r.URL.Query()
	dni := q.Get("dnix")
	fechafalta := q.Get("fechaxxx")
	materia := q.Get("materiax")
	curso := q.Get("cursox")
	turno := q.Get("turnox")
	tipo := q.Get("tipox")
	vista := q.Get("vistax")

	parametrosCompletos := dni != "" && fechafalta != "" && materia != "" && curso != "" && turno != "" && tipo != ""
	paramWarning := ""
	if !parametrosCompletos {
		paramWarning = "Faltan parametros para generar la cedula. Requeridos: dnix, fechaxxx, materiax, cursox, turnox, tipox, vistax."
	}

	movi := "inasistencia"
	if tipo == "T" {
		movi = "tardanza"
	}
	turnoTxt := turno
	switch turno {
	case "M":
		turnoTxt = "Manana"
	case "T":
		turnoTxt = "Tarde"
	case "V":
		turnoTxt = "Vespertino"
	}

	nya := ""
	domicilio := ""
	numero := ""

	if parametrosCompletos {
		nya, domicilio = h.fetchDocente(dni)
	}

	if parametrosCompletos {
		numero = h.ensureNotificacionNumero(vista, nya, fechafalta, materia, curso, turnoTxt)
	}

	hoyTxt := spanishDateLong(time.Now())
	faltaTxt := ""
	if fechafalta != "" {
		if t, err := time.Parse("2006-01-02", fechafalta); err == nil {
			faltaTxt = spanishDateDayMonth(t)
		}
	}

	data := NotificacionAusentePage{
		ParamWarning: paramWarning,
		Numero:       numero,
		HoyTxt:       hoyTxt,
		Nya:          nya,
		DNI:          dni,
		Domicilio:    domicilio,
		Movi:         movi,
		FaltaTxt:     faltaTxt,
		Materia:      materia,
		Curso:        curso,
		Turno:        turnoTxt,
	}

	h.render(w, "notificacionausente", data)
}

func (h *Handler) VerNotas(w http.ResponseWriter, r *http.Request) {
	desc := strings.TrimSpace(r.URL.Query().Get("descripcion"))
	notas, _ := h.fetchNotas(desc)

	data := VerNotasPage{
		Descripcion: desc,
		Notas:       notas,
	}

	h.render(w, "ver_notas", data)
}

func (h *Handler) VerNotasTodas(w http.ResponseWriter, r *http.Request) {
	q := r.URL.Query()
	desc := strings.TrimSpace(q.Get("descripcion"))
	buscar := q.Has("muestra2")

	notas := []NotaView{}
	if buscar {
		notas, _ = h.fetchNotasTodas(desc)
	}

	data := VerNotasTodasPage{
		Descripcion: desc,
		Buscar:      buscar,
		Notas:       notas,
	}

	h.render(w, "ver_notastodas", data)
}

// Data models

type Curso struct {
	ID          string
	Descripcion string
}

type Alumno struct {
	DNI    string
	Nombre string
}

type AusenteRow struct {
	DNI      string
	Alumno   string
	Curso    string
	Division string
	Tipo     string
}

type BoletinCelda struct {
	Codigo string
	BG     string
	Link   string
}

type BoletinFila struct {
	DNI             string
	Alumno          string
	Celdas          []BoletinCelda
	Justificadas    int
	Injustificadas  int
	TotalAusentes   int
	Presentes       int
	Porcentaje      int
	ColorPorcentaje string
}

type MesItem struct {
	Num    int
	Nombre string
}

type NotificacionRow struct {
	ID          int
	Codigo      int
	Descripcion string
	Agente      string
	Anio        int
	Path        string
}

type NotaView struct {
	ID          int
	Codigo      int
	Anio        int
	Descripcion string
	Gen         string
	Fecha       string
	Agente      string
	Path        string
}

// Page models

type AsistenciaPage struct {
	Cursos            []Curso
	Alumnos           []Alumno
	CursoSeleccionado string
	Mostrar           bool
	Materia           string
	Mensaje           string
	FechaForm         string
}

type AsistenciaEFPage struct {
	Cursos            []Curso
	Alumnos           []Alumno
	CursoSeleccionado string
	Mostrar           bool
	Mensaje           string
}

type AlumnosAusentesPage struct {
	Fecha    string
	Ausentes []AusenteRow
}

type BoletinPage struct {
	Cursos            []Curso
	CursoSeleccionado string
	MesSeleccionado   int
	Meses             []MesItem
	Mostrar           bool
	DiasHeaders       []string
	Planilla          []BoletinFila
	Titulo            string
	Subtitulo         string
}

type NotificacionesPage struct {
	Anio               int
	Asunto             string
	Errores            []string
	Guardado           bool
	NotificacionNumero string
	NotificacionAnio   string
}

type VerNotificacionesPage struct {
	Descripcion    string
	Notificaciones []NotificacionRow
}

type NotificacionAusentePage struct {
	ParamWarning string
	Numero       string
	HoyTxt       string
	Nya          string
	DNI          string
	Domicilio    string
	Movi         string
	FaltaTxt     string
	Materia      string
	Curso        string
	Turno        string
}

type VerNotasPage struct {
	Descripcion string
	Notas       []NotaView
}

type VerNotasTodasPage struct {
	Descripcion string
	Buscar      bool
	Notas       []NotaView
}

type ModulesPage struct {
	Modulos []string
}

type ModuleIndexPage struct {
	Modulo string
}

type ModuleBuscarPage struct {
	Modulo string
	Query  string
}

type ModuleAltaPage struct {
	Modulo   string
	Nombre   string
	Notas    string
	Guardado bool
}

type ModuleVerPage struct {
	Modulo string
	ID     string
}

type AlumnoRecord struct {
	DNI      string
	Apellido string
	Nombre   string
}

type DocenteRecord struct {
	DNI       string
	Apellido  string
	Nombre    string
	Direccion string
	Numero    string
}

type AlumnosBuscarPage struct {
	Query  string
	Result []AlumnoRecord
}

type AlumnosAltaPage struct {
	DNI      string
	Apellido string
	Nombre   string
	Guardado bool
	Error    string
}

type AlumnosVerPage struct {
	DNI   string
	Item  *AlumnoRecord
	Error string
}

type DocentesBuscarPage struct {
	Query  string
	Result []DocenteRecord
}

type DocentesAltaPage struct {
	DNI       string
	Apellido  string
	Nombre    string
	Direccion string
	Numero    string
	Guardado  bool
	Error     string
}

type DocentesVerPage struct {
	DNI   string
	Item  *DocenteRecord
	Error string
}

type PreceptorRecord struct {
	DNI      string
	Apellido string
	Nombre   string
	Turno    string
	Email    string
	Telefono string
	Activo   int
}

type PreceptoresBuscarPage struct {
	Query  string
	Result []PreceptorRecord
}

type PreceptoresAltaPage struct {
	DNI      string
	Apellido string
	Nombre   string
	Turno    string
	Email    string
	Telefono string
	Activo   bool
	Guardado bool
	Error    string
}

type PreceptoresVerPage struct {
	DNI   string
	Item  *PreceptorRecord
	Error string
}

type ForbiddenPage struct{}

type LoginPage struct {
	Usuario string
	Pass    string
	Error   string
}

// Helpers

func (h *Handler) render(w http.ResponseWriter, name string, data any) {
	w.Header().Set("Content-Type", "text/html; charset=utf-8")
	_ = h.Tmpl.ExecuteTemplate(w, name, data)
}

func parseIJ(q url.Values) map[string]string {
	ij := map[string]string{}
	for key, vals := range q {
		if strings.HasPrefix(key, "ij[") && strings.HasSuffix(key, "]") {
			dni := strings.TrimSuffix(strings.TrimPrefix(key, "ij["), "]")
			if len(vals) > 0 {
				ij[dni] = vals[0]
			}
		}
	}
	return ij
}

func mesesLista() []MesItem {
	return []MesItem{
		{1, "Enero"}, {2, "Febrero"}, {3, "Marzo"}, {4, "Abril"},
		{5, "Mayo"}, {6, "Junio"}, {7, "Julio"}, {8, "Agosto"},
		{9, "Septiembre"}, {10, "Octubre"}, {11, "Noviembre"}, {12, "Diciembre"},
	}
}

func (h *Handler) fetchCursos() ([]Curso, error) {
	rows, err := h.DB.Base.Query("SELECT idcurso, descripcion FROM curso2 WHERE habilitado='1' ORDER BY curso, division ASC")
	if err != nil {
		return nil, err
	}
	defer rows.Close()

	cursos := []Curso{}
	for rows.Next() {
		var c Curso
		if err := rows.Scan(&c.ID, &c.Descripcion); err != nil {
			return nil, err
		}
		cursos = append(cursos, c)
	}
	return cursos, rows.Err()
}

func (h *Handler) fetchAlumnos(cursoSeleccionado string, anio int) ([]Alumno, error) {
	if cursoSeleccionado == "" {
		return nil, nil
	}
	curso := cursoSeleccionado[:1]
	division := ""
	if len(cursoSeleccionado) > 1 {
		division = cursoSeleccionado[1:]
	}

	rows, err := h.DB.Base.Query(
		"SELECT a.dni, CONCAT(a.apellido, ' ', a.nombre) as alumno FROM alumno a, cursa c WHERE c.control='1' AND c.anio=? AND c.curso=? AND c.divi=? AND c.alumno=a.dni ORDER BY alumno",
		anio, curso, division,
	)
	if err != nil {
		return nil, err
	}
	defer rows.Close()

	alumnos := []Alumno{}
	for rows.Next() {
		var a Alumno
		if err := rows.Scan(&a.DNI, &a.Nombre); err != nil {
			return nil, err
		}
		alumnos = append(alumnos, a)
	}
	return alumnos, rows.Err()
}

func (h *Handler) guardarFaltas(materia string, ausentes []string, ij map[string]string) error {
	hoy := time.Now().Format("2006-01-02")
	stmt, err := h.DB.Base.Prepare("INSERT INTO alumnos_faltas (dni, fecha, tipo, injus) VALUES (?, ?, ?, ?)")
	if err != nil {
		return err
	}
	defer stmt.Close()

	for _, dni := range ausentes {
		injus := ij[dni]
		if injus == "" {
			injus = "1"
		}
		if _, err := stmt.Exec(dni, hoy, materia, injus); err != nil {
			return err
		}
	}
	return nil
}

func (h *Handler) fetchAusentes(fecha string) ([]AusenteRow, error) {
	rows, err := h.DB.Sid.Query("SELECT ac.dni, ac.alumno, ac.curso, ac.division, af.tipo FROM alumnos ac, alumnos_faltas af WHERE ac.dni=af.dni AND af.fecha=? ORDER BY ac.curso, ac.division, ac.alumno", fecha)
	if err != nil {
		return nil, err
	}
	defer rows.Close()

	out := []AusenteRow{}
	for rows.Next() {
		var r AusenteRow
		if err := rows.Scan(&r.DNI, &r.Alumno, &r.Curso, &r.Division, &r.Tipo); err != nil {
			return nil, err
		}
		out = append(out, r)
	}
	return out, rows.Err()
}

func (h *Handler) buildBoletin(cursoSeleccionado string, mes int) ([]BoletinFila, []string, string, string) {
	curso := cursoSeleccionado[:1]
	division := ""
	if len(cursoSeleccionado) > 1 {
		division = cursoSeleccionado[1:]
	}

	year := time.Now().Year()
	now := time.Now()
	dias := daysInMonth(year, mes)
	if int(now.Month()) == mes {
		dias = now.Day()
	}
	if int(now.Month()) < mes {
		dias = 0
	}

	headers := []string{}
	for j := 1; j <= dias; j++ {
		headers = append(headers, strconv.Itoa(j)+"/"+strconv.Itoa(mes))
	}

	titulo := "PLANILLA DE ASISTENCIA " + strconv.Itoa(mes) + "-" + strconv.Itoa(year)
	subtitulo := "Cantidad de dias del mes: " + strconv.Itoa(dias)

	alumnos, _ := h.fetchAlumnos(curso+division, year)
	filas := []BoletinFila{}

	for _, alumno := range alumnos {
		presente := 0
		celdas := []BoletinCelda{}
		for z := 1; z <= dias; z++ {
			fecha := time.Date(year, time.Month(mes), z, 0, 0, 0, 0, time.Local)
			diaSemana := int(fecha.Weekday())
			celda := h.boletinCeldaDia(alumno.DNI, fecha, diaSemana)
			if celda.Codigo == "P" {
				presente++
			}
			celdas = append(celdas, celda)
		}

		justificadas, injustificadas := h.boletinResumenAlumno(alumno.DNI, mes, year)
		totalAus := justificadas + injustificadas
		denom := totalAus + presente
		porcentaje := 0
		if denom > 0 {
			porcentaje = int(float64(100) - (float64(totalAus)/float64(denom))*100)
		}
		color := boletinColorPorcentaje(porcentaje)

		filas = append(filas, BoletinFila{
			DNI:             alumno.DNI,
			Alumno:          alumno.Nombre,
			Celdas:          celdas,
			Justificadas:    justificadas,
			Injustificadas:  injustificadas,
			TotalAusentes:   totalAus,
			Presentes:       presente,
			Porcentaje:      porcentaje,
			ColorPorcentaje: color,
		})
	}

	return filas, headers, titulo, subtitulo
}

func (h *Handler) boletinResumenAlumno(dni string, mes int, year int) (int, int) {
	justificadas := 0
	injustificadas := 0

	var totalJ sql.NullFloat64
	_ = h.DB.Base.QueryRow(
		"SELECT SUM(CASE WHEN a.tipo = 'TEDI' AND a.injus IN (0) THEN i.valorfalta / 2 ELSE i.valorfalta END) as total FROM alumnos_faltas a, injus i WHERE i.id=0 AND a.injus=i.id AND MONTH(fecha)=? AND YEAR(fecha)=? AND a.dni=?",
		mes, year, dni,
	).Scan(&totalJ)
	if totalJ.Valid {
		justificadas = int(totalJ.Float64)
	}

	var totalI sql.NullFloat64
	_ = h.DB.Base.QueryRow(
		"SELECT SUM(CASE WHEN a.tipo = 'TEDI' AND a.injus IN (1) THEN i.valorfalta / 2 ELSE i.valorfalta END) as total FROM alumnos_faltas a, injus i WHERE i.id=1 AND a.injus=i.id AND MONTH(fecha)=? AND YEAR(fecha)=? AND a.dni=?",
		mes, year, dni,
	).Scan(&totalI)
	if totalI.Valid {
		injustificadas = int(totalI.Float64)
	}

	return justificadas, injustificadas
}

func (h *Handler) boletinCeldaDia(dni string, fecha time.Time, diaSemana int) BoletinCelda {
	if diaSemana == 0 {
		return BoletinCelda{Codigo: "D", BG: "#f0f8ff"}
	}
	if diaSemana == 6 {
		return BoletinCelda{Codigo: "S", BG: "#f0f8ff"}
	}

	var feriadoCount int
	_ = h.DB.Base.QueryRow("SELECT COUNT(*) FROM feriados WHERE fecha=?", fecha.Format("2006-01-02")).Scan(&feriadoCount)
	if feriadoCount > 0 {
		return BoletinCelda{Codigo: "F", BG: "#f0f8ff"}
	}

	rows, err := h.DB.Base.Query("SELECT i.letra FROM alumnos_faltas a, injus i WHERE a.injus=i.id AND a.fecha=? AND a.dni=?", fecha.Format("2006-01-02"), dni)
	if err == nil {
		defer rows.Close()
		letras := []string{}
		for rows.Next() {
			var letra string
			if err := rows.Scan(&letra); err == nil {
				letras = append(letras, letra)
			}
		}
		if len(letras) > 0 {
			return BoletinCelda{Codigo: strings.Join(letras, " | "), BG: "#FF0000"}
		}
	}

	return BoletinCelda{Codigo: "P", BG: "#00FF00"}
}

func boletinColorPorcentaje(p int) string {
	if p > 80 {
		return "#00FF00"
	}
	if p >= 50 && p <= 79 {
		return "#FFFF00"
	}
	return "#FF0000"
}

func daysInMonth(year int, month int) int {
	t := time.Date(year, time.Month(month)+1, 0, 0, 0, 0, 0, time.Local)
	return t.Day()
}

func (h *Handler) resolveAgente() string {
	usuario := h.Cfg.User
	var nombre sql.NullString
	_ = h.DB.Sid.QueryRow("SELECT nombre FROM usuarios WHERE usuario=?", usuario).Scan(&nombre)
	if nombre.Valid && nombre.String != "" {
		return nombre.String
	}
	return usuario
}

func (h *Handler) insertNotificacion(asunto string, agente string) (int, int, error) {
	asunto = strings.Title(asunto)
	anio := time.Now().Year()

	var ultimo int
	_ = h.DB.Sid.QueryRow("SELECT COUNT(*) FROM notificaciones WHERE anio=YEAR(NOW())").Scan(&ultimo)
	ultimo++

	_, err := h.DB.Sid.Exec("INSERT INTO notificaciones (codigo, descripcion, agente, anio, path) VALUES (?, ?, ?, ?, '')", ultimo, asunto, agente, anio)
	if err != nil {
		return 0, 0, err
	}

	return ultimo, anio, nil
}

func (h *Handler) fetchNotificaciones(desc string) ([]NotificacionRow, error) {
	like := "%" + desc + "%"
	rows, err := h.DB.Sid.Query("SELECT id, codigo, descripcion, agente, anio, path FROM notificaciones WHERE descripcion LIKE ? OR codigo LIKE ? ORDER BY anio DESC, codigo DESC", like, like)
	if err != nil {
		return nil, err
	}
	defer rows.Close()

	out := []NotificacionRow{}
	for rows.Next() {
		var r NotificacionRow
		var path sql.NullString
		if err := rows.Scan(&r.ID, &r.Codigo, &r.Descripcion, &r.Agente, &r.Anio, &path); err != nil {
			return nil, err
		}
		if path.Valid {
			r.Path = path.String
		}
		out = append(out, r)
	}
	return out, rows.Err()
}

func (h *Handler) fetchDocente(dni string) (string, string) {
	var nombre sql.NullString
	var direccion sql.NullString
	var numero sql.NullString

	_ = h.DB.Base.QueryRow("SELECT CONCAT(apellido, ' ', nombre) as nombredoc, direccion, numero FROM docente WHERE dni=?", dni).Scan(&nombre, &direccion, &numero)

	dom := strings.TrimSpace(direccion.String + " " + numero.String)
	return nombre.String, dom
}

func (h *Handler) ensureNotificacionNumero(vista string, nya string, fechafalta string, materia string, curso string, turno string) string {
	asunto := "FALTA - " + nya + " FECHA: " + fechafalta + " MATERIA: " + materia + " CURSO: " + curso + " TURNO: " + turno
	anio := time.Now().Year()

	var codigo sql.NullInt64
	_ = h.DB.Sid.QueryRow("SELECT codigo FROM notificaciones WHERE descripcion=? AND anio=?", asunto, anio).Scan(&codigo)
	if codigo.Valid {
		return strconv.FormatInt(codigo.Int64, 10)
	}

	if vista != "N" {
		return ""
	}

	var ultimo int
	_ = h.DB.Sid.QueryRow("SELECT COUNT(*) FROM notificaciones WHERE anio=YEAR(NOW())").Scan(&ultimo)
	ultimo++

	agente := h.resolveAgente()
	_, err := h.DB.Sid.Exec("INSERT INTO notificaciones (codigo, descripcion, agente, anio, path) VALUES (?, ?, ?, ?, '')", ultimo, asunto, agente, anio)
	if err != nil {
		return ""
	}

	return strconv.Itoa(ultimo)
}

func (h *Handler) fetchNotas(desc string) ([]NotaView, error) {
	tokens := strings.Fields(desc)
	conds := []string{}
	args := []any{}
	for _, t := range tokens {
		like := "%" + t + "%"
		conds = append(conds, "(descripcion LIKE ? OR codigo LIKE ? OR gen LIKE ?)")
		args = append(args, like, like, like)
	}
	if len(conds) == 0 {
		conds = append(conds, "1=1")
	}
	sqlQ := "SELECT id, codigo, descripcion, gen, fecha, agente, anio, path FROM notasnuevo WHERE " + strings.Join(conds, " AND ") + " ORDER BY anio DESC, codigo DESC"

	rows, err := h.DB.Sid.Query(sqlQ, args...)
	if err != nil {
		return nil, err
	}
	defer rows.Close()

	out := []NotaView{}
	for rows.Next() {
		var r NotaView
		var fecha sql.NullTime
		var path sql.NullString
		if err := rows.Scan(&r.ID, &r.Codigo, &r.Descripcion, &r.Gen, &fecha, &r.Agente, &r.Anio, &path); err != nil {
			return nil, err
		}
		if fecha.Valid {
			r.Fecha = fecha.Time.Format("2006-01-02")
		}
		if path.Valid {
			r.Path = path.String
		}
		out = append(out, r)
	}
	return out, rows.Err()
}

func (h *Handler) fetchNotasTodas(desc string) ([]NotaView, error) {
	like := "%" + desc + "%"
	rows, err := h.DB.Sid.Query("SELECT id, codigo, descripcion, gen, fecha, agente, anio, path FROM notasnuevo WHERE descripcion LIKE ? OR codigo LIKE ? ORDER BY anio DESC, codigo DESC", like, like)
	if err != nil {
		return nil, err
	}
	defer rows.Close()

	out := []NotaView{}
	for rows.Next() {
		var r NotaView
		var fecha sql.NullTime
		var path sql.NullString
		if err := rows.Scan(&r.ID, &r.Codigo, &r.Descripcion, &r.Gen, &fecha, &r.Agente, &r.Anio, &path); err != nil {
			return nil, err
		}
		if fecha.Valid {
			r.Fecha = fecha.Time.Format("2006-01-02")
		}
		if path.Valid {
			r.Path = path.String
		}
		out = append(out, r)
	}
	return out, rows.Err()
}

func spanishDateLong(t time.Time) string {
	dias := []string{"domingo", "lunes", "martes", "miercoles", "jueves", "viernes", "sabado"}
	meses := []string{"enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"}
	return dias[int(t.Weekday())] + " " + t.Format("02") + " de " + meses[int(t.Month())-1] + " de " + t.Format("2006")
}

func spanishDateDayMonth(t time.Time) string {
	meses := []string{"enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"}
	return t.Format("02") + " de " + meses[int(t.Month())-1] + " de " + t.Format("2006")
}

// Modulos genericos

func (h *Handler) ModulesIndex(w http.ResponseWriter, r *http.Request, modulos []string) {
	h.render(w, "modules", ModulesPage{Modulos: modulos})
}

func (h *Handler) ModuleIndex(w http.ResponseWriter, r *http.Request, modulo string) {
	h.render(w, "module_index", ModuleIndexPage{Modulo: modulo})
}

func (h *Handler) ModuleBuscar(w http.ResponseWriter, r *http.Request, modulo string) {
	q := r.URL.Query().Get("q")
	h.render(w, "module_buscar", ModuleBuscarPage{Modulo: modulo, Query: q})
}

func (h *Handler) ModuleAlta(w http.ResponseWriter, r *http.Request, modulo string) {
	data := ModuleAltaPage{Modulo: modulo}
	if r.Method == http.MethodPost {
		if err := r.ParseForm(); err == nil {
			data.Nombre = strings.TrimSpace(r.FormValue("nombre"))
			data.Notas = strings.TrimSpace(r.FormValue("notas"))
			data.Guardado = true
		}
	}
	h.render(w, "module_alta", data)
}

func (h *Handler) ModuleVer(w http.ResponseWriter, r *http.Request, modulo string) {
	id := r.URL.Query().Get("id")
	h.render(w, "module_ver", ModuleVerPage{Modulo: modulo, ID: id})
}

// Alumnos (funcional)

func (h *Handler) AlumnosBuscar(w http.ResponseWriter, r *http.Request) {
	q := strings.TrimSpace(r.URL.Query().Get("q"))
	items := []AlumnoRecord{}
	if q != "" {
		items, _ = h.fetchAlumnosByQuery(q)
	}
	h.render(w, "alumnos_buscar", AlumnosBuscarPage{Query: q, Result: items})
}

func (h *Handler) AlumnosAlta(w http.ResponseWriter, r *http.Request) {
	data := AlumnosAltaPage{}
	if r.Method == http.MethodPost {
		if err := r.ParseForm(); err == nil {
			data.DNI = strings.TrimSpace(r.FormValue("dni"))
			data.Apellido = strings.TrimSpace(r.FormValue("apellido"))
			data.Nombre = strings.TrimSpace(r.FormValue("nombre"))
			if data.DNI == "" || data.Apellido == "" || data.Nombre == "" {
				data.Error = "Completar DNI, apellido y nombre."
			} else if err := h.insertAlumno(data.DNI, data.Apellido, data.Nombre); err != nil {
				data.Error = "No se pudo guardar."
			} else {
				data.Guardado = true
			}
		}
	}
	h.render(w, "alumnos_alta", data)
}

func (h *Handler) AlumnosVer(w http.ResponseWriter, r *http.Request) {
	dni := strings.TrimSpace(r.URL.Query().Get("dni"))
	var item *AlumnoRecord
	var errMsg string
	if dni != "" {
		rec, err := h.fetchAlumnoByDNI(dni)
		if err != nil {
			errMsg = "No se encontro el alumno."
		} else {
			item = &rec
		}
	}
	h.render(w, "alumnos_ver", AlumnosVerPage{DNI: dni, Item: item, Error: errMsg})
}

func (h *Handler) fetchAlumnosByQuery(q string) ([]AlumnoRecord, error) {
	like := "%" + q + "%"
	rows, err := h.DB.Base.Query("SELECT dni, apellido, nombre FROM alumno WHERE dni LIKE ? OR apellido LIKE ? OR nombre LIKE ? ORDER BY apellido, nombre", like, like, like)
	if err != nil {
		return nil, err
	}
	defer rows.Close()
	out := []AlumnoRecord{}
	for rows.Next() {
		var r AlumnoRecord
		if err := rows.Scan(&r.DNI, &r.Apellido, &r.Nombre); err != nil {
			return nil, err
		}
		out = append(out, r)
	}
	return out, rows.Err()
}

func (h *Handler) fetchAlumnoByDNI(dni string) (AlumnoRecord, error) {
	var r AlumnoRecord
	err := h.DB.Base.QueryRow("SELECT dni, apellido, nombre FROM alumno WHERE dni=?", dni).Scan(&r.DNI, &r.Apellido, &r.Nombre)
	return r, err
}

func (h *Handler) insertAlumno(dni, apellido, nombre string) error {
	_, err := h.DB.Base.Exec("INSERT INTO alumno (dni, apellido, nombre) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE apellido=VALUES(apellido), nombre=VALUES(nombre)", dni, apellido, nombre)
	return err
}

// Docentes (funcional)

func (h *Handler) DocentesBuscar(w http.ResponseWriter, r *http.Request) {
	q := strings.TrimSpace(r.URL.Query().Get("q"))
	items := []DocenteRecord{}
	if q != "" {
		items, _ = h.fetchDocentesByQuery(q)
	}
	h.render(w, "docentes_buscar", DocentesBuscarPage{Query: q, Result: items})
}

func (h *Handler) DocentesAlta(w http.ResponseWriter, r *http.Request) {
	data := DocentesAltaPage{}
	if r.Method == http.MethodPost {
		if err := r.ParseForm(); err == nil {
			data.DNI = strings.TrimSpace(r.FormValue("dni"))
			data.Apellido = strings.TrimSpace(r.FormValue("apellido"))
			data.Nombre = strings.TrimSpace(r.FormValue("nombre"))
			data.Direccion = strings.TrimSpace(r.FormValue("direccion"))
			data.Numero = strings.TrimSpace(r.FormValue("numero"))
			if data.DNI == "" || data.Apellido == "" || data.Nombre == "" {
				data.Error = "Completar DNI, apellido y nombre."
			} else if err := h.insertDocente(data.DNI, data.Apellido, data.Nombre, data.Direccion, data.Numero); err != nil {
				data.Error = "No se pudo guardar."
			} else {
				data.Guardado = true
			}
		}
	}
	h.render(w, "docentes_alta", data)
}

func (h *Handler) DocentesVer(w http.ResponseWriter, r *http.Request) {
	dni := strings.TrimSpace(r.URL.Query().Get("dni"))
	var item *DocenteRecord
	var errMsg string
	if dni != "" {
		rec, err := h.fetchDocenteByDNI(dni)
		if err != nil {
			errMsg = "No se encontro el docente."
		} else {
			item = &rec
		}
	}
	h.render(w, "docentes_ver", DocentesVerPage{DNI: dni, Item: item, Error: errMsg})
}

func (h *Handler) fetchDocentesByQuery(q string) ([]DocenteRecord, error) {
	like := "%" + q + "%"
	rows, err := h.DB.Base.Query("SELECT dni, apellido, nombre, direccion, numero FROM docente WHERE dni LIKE ? OR apellido LIKE ? OR nombre LIKE ? ORDER BY apellido, nombre", like, like, like)
	if err != nil {
		return nil, err
	}
	defer rows.Close()
	out := []DocenteRecord{}
	for rows.Next() {
		var r DocenteRecord
		if err := rows.Scan(&r.DNI, &r.Apellido, &r.Nombre, &r.Direccion, &r.Numero); err != nil {
			return nil, err
		}
		out = append(out, r)
	}
	return out, rows.Err()
}

func (h *Handler) fetchDocenteByDNI(dni string) (DocenteRecord, error) {
	var r DocenteRecord
	err := h.DB.Base.QueryRow("SELECT dni, apellido, nombre, direccion, numero FROM docente WHERE dni=?", dni).
		Scan(&r.DNI, &r.Apellido, &r.Nombre, &r.Direccion, &r.Numero)
	return r, err
}

func (h *Handler) insertDocente(dni, apellido, nombre, direccion, numero string) error {
	_, err := h.DB.Base.Exec("INSERT INTO docente (dni, apellido, nombre, direccion, numero) VALUES (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE apellido=VALUES(apellido), nombre=VALUES(nombre), direccion=VALUES(direccion), numero=VALUES(numero)", dni, apellido, nombre, direccion, numero)
	return err
}

// Preceptores (funcional)

func (h *Handler) PreceptoresBuscar(w http.ResponseWriter, r *http.Request) {
	q := strings.TrimSpace(r.URL.Query().Get("q"))
	items := []PreceptorRecord{}
	if q != "" {
		items, _ = h.fetchPreceptoresByQuery(q)
	}
	h.render(w, "preceptores_buscar", PreceptoresBuscarPage{Query: q, Result: items})
}

func (h *Handler) PreceptoresAlta(w http.ResponseWriter, r *http.Request) {
	data := PreceptoresAltaPage{}
	if r.Method == http.MethodPost {
		if err := r.ParseForm(); err == nil {
			data.DNI = strings.TrimSpace(r.FormValue("dni"))
			data.Apellido = strings.TrimSpace(r.FormValue("apellido"))
			data.Nombre = strings.TrimSpace(r.FormValue("nombre"))
			data.Turno = strings.TrimSpace(r.FormValue("turno"))
			data.Email = strings.TrimSpace(r.FormValue("email"))
			data.Telefono = strings.TrimSpace(r.FormValue("telefono"))
			data.Activo = r.FormValue("activo") == "1"
			if data.DNI == "" || data.Apellido == "" || data.Nombre == "" {
				data.Error = "Completar DNI, apellido y nombre."
			} else if err := h.insertPreceptor(data); err != nil {
				data.Error = "No se pudo guardar."
			} else {
				data.Guardado = true
			}
		}
	}
	h.render(w, "preceptores_alta", data)
}

func (h *Handler) PreceptoresVer(w http.ResponseWriter, r *http.Request) {
	dni := strings.TrimSpace(r.URL.Query().Get("dni"))
	var item *PreceptorRecord
	var errMsg string
	if dni != "" {
		rec, err := h.fetchPreceptorByDNI(dni)
		if err != nil {
			errMsg = "No se encontro el preceptor."
		} else {
			item = &rec
		}
	}
	h.render(w, "preceptores_ver", PreceptoresVerPage{DNI: dni, Item: item, Error: errMsg})
}

func (h *Handler) Forbidden(w http.ResponseWriter, r *http.Request) {
	w.WriteHeader(http.StatusForbidden)
	h.render(w, "forbidden", ForbiddenPage{})
}

func (h *Handler) ParteDiario(w http.ResponseWriter, r *http.Request) {
	h.render(w, "parte_diario", struct{}{})
}

func (h *Handler) Login(w http.ResponseWriter, r *http.Request) {
	data := LoginPage{}
	if r.Method == http.MethodPost {
		if err := r.ParseForm(); err == nil {
			data.Usuario = strings.TrimSpace(r.FormValue("usuario"))
			data.Pass = strings.TrimSpace(r.FormValue("pass"))
			if data.Usuario == "" || data.Pass == "" {
				data.Error = "Completar usuario y clave."
			} else {
				role, ok := h.authenticateUser(data.Usuario, data.Pass)
				if !ok {
					data.Error = "Usuario o clave incorrectos."
				} else {
					setLoginCookies(w, data.Usuario, role)
					http.Redirect(w, r, "/", http.StatusSeeOther)
					return
				}
			}
		}
	}
	h.render(w, "login", data)
}

func (h *Handler) Logout(w http.ResponseWriter, r *http.Request) {
	clearLoginCookies(w)
	http.Redirect(w, r, "/login", http.StatusSeeOther)
}

func (h *Handler) authenticateUser(user, pass string) (string, bool) {
	var role sql.NullString
	var estado sql.NullInt64
	err := h.DB.Base.QueryRow("SELECT role, estado FROM usuarios WHERE usuario=? AND pass=?", user, pass).Scan(&role, &estado)
	if err != nil {
		return "", false
	}
	if estado.Valid && estado.Int64 == 0 {
		return "", false
	}
	if role.Valid && role.String != "" {
		return role.String, true
	}
	return "directivo", true
}

func setLoginCookies(w http.ResponseWriter, user, role string) {
	http.SetCookie(w, &http.Cookie{
		Name:     "sadsgo_user",
		Value:    user,
		Path:     "/",
		HttpOnly: true,
	})
	http.SetCookie(w, &http.Cookie{
		Name:     "sadsgo_role",
		Value:    role,
		Path:     "/",
		HttpOnly: true,
	})
}

func clearLoginCookies(w http.ResponseWriter) {
	http.SetCookie(w, &http.Cookie{
		Name:     "sadsgo_user",
		Value:    "",
		Path:     "/",
		MaxAge:   -1,
		HttpOnly: true,
	})
	http.SetCookie(w, &http.Cookie{
		Name:     "sadsgo_role",
		Value:    "",
		Path:     "/",
		MaxAge:   -1,
		HttpOnly: true,
	})
}

func (h *Handler) fetchPreceptoresByQuery(q string) ([]PreceptorRecord, error) {
	like := "%" + q + "%"
	rows, err := h.DB.Base.Query("SELECT dni, apellido, nombre, turno, email, telefono, activo FROM preceptores WHERE dni LIKE ? OR apellido LIKE ? OR nombre LIKE ? ORDER BY apellido, nombre", like, like, like)
	if err != nil {
		return nil, err
	}
	defer rows.Close()
	out := []PreceptorRecord{}
	for rows.Next() {
		var r PreceptorRecord
		if err := rows.Scan(&r.DNI, &r.Apellido, &r.Nombre, &r.Turno, &r.Email, &r.Telefono, &r.Activo); err != nil {
			return nil, err
		}
		out = append(out, r)
	}
	return out, rows.Err()
}

func (h *Handler) fetchPreceptorByDNI(dni string) (PreceptorRecord, error) {
	var r PreceptorRecord
	err := h.DB.Base.QueryRow("SELECT dni, apellido, nombre, turno, email, telefono, activo FROM preceptores WHERE dni=?", dni).
		Scan(&r.DNI, &r.Apellido, &r.Nombre, &r.Turno, &r.Email, &r.Telefono, &r.Activo)
	return r, err
}

func (h *Handler) insertPreceptor(p PreceptoresAltaPage) error {
	activo := 0
	if p.Activo {
		activo = 1
	}
	_, err := h.DB.Base.Exec("INSERT INTO preceptores (dni, apellido, nombre, turno, email, telefono, activo) VALUES (?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE apellido=VALUES(apellido), nombre=VALUES(nombre), turno=VALUES(turno), email=VALUES(email), telefono=VALUES(telefono), activo=VALUES(activo)",
		p.DNI, p.Apellido, p.Nombre, p.Turno, p.Email, p.Telefono, activo,
	)
	return err
}
