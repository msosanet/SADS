package main

import (
	"log"
	"net/http"

	"sadsgo/internal/config"
	"sadsgo/internal/db"
	"sadsgo/internal/handlers"
	"sadsgo/internal/templates"
)

func main() {
	cfg := config.Load()

	tmpl, err := templates.Parse()
	if err != nil {
		log.Fatalf("templates: %v", err)
	}

	dbc, err := db.Open(cfg)
	if err != nil {
		log.Fatalf("db: %v", err)
	}
	defer dbc.Base.Close()
	defer dbc.Sid.Close()

	h := handlers.New(tmpl, dbc, cfg)
	modulos := []string{
		"inasistencia",
		"inasistenciaprueba",
		"alumnos",
		"docentes",
		"preceptores",
		"cargadocentes",
		"estadistica",
		"mesas",
		"comedor",
		"entrada",
		"dbf2mysql",
		"archivos",
		"classes",
		"mqtt",
		"prueba",
		"shell",
	}

	mux := http.NewServeMux()
	mux.HandleFunc("/login", h.Login)
	mux.HandleFunc("/logout", h.Logout)
	mux.HandleFunc("/", func(w http.ResponseWriter, r *http.Request) {
		user, role := resolveRole(r)
		if user == "" {
			http.Redirect(w, r, "/login", http.StatusSeeOther)
			return
		}

		m := r.URL.Query().Get("m")
		f := r.URL.Query().Get("f")
		if !allowed(role, m, f, r.URL.Path) {
			h.Forbidden(w, r)
			return
		}
		if m == "modulos" && f == "index" {
			h.ModulesIndex(w, r, filteredModules(role, modulos))
			return
		}
		if m == "inasistencia" {
			if dispatchInasistencia(h, f, w, r) {
				return
			}
		}
		if m == "alumnos" {
			if dispatchAlumnos(h, f, w, r) {
				return
			}
		}
		if m == "docentes" {
			if dispatchDocentes(h, f, w, r) {
				return
			}
		}
		if m == "preceptores" {
			if dispatchPreceptores(h, f, w, r) {
				return
			}
		}
		if m != "" {
			if dispatchModule(h, m, f, w, r) {
				return
			}
		}

		switch r.URL.Path {
		case "/":
			h.Index(w, r)
		case "/inasistencia/asistencia":
			h.Asistencia(w, r)
		case "/inasistencia/asistenciaef":
			h.AsistenciaEF(w, r)
		case "/inasistencia/alumnosausentes":
			h.AlumnosAusentes(w, r)
		case "/inasistencia/boletin":
			h.Boletin(w, r)
		case "/inasistencia/notificaciones":
			h.Notificaciones(w, r)
		case "/inasistencia/ver_notificaciones":
			h.VerNotificaciones(w, r)
		case "/inasistencia/notificacionausente":
			h.NotificacionAusente(w, r)
		case "/inasistencia/ver_notas":
			h.VerNotas(w, r)
		case "/inasistencia/ver_notastodas":
			h.VerNotasTodas(w, r)
		default:
			http.NotFound(w, r)
		}
	})

	log.Printf("SADSGO escuchando en %s", cfg.HTTPAddr)
	if err := http.ListenAndServe(cfg.HTTPAddr, mux); err != nil {
		log.Fatal(err)
	}
}

func dispatchInasistencia(h *handlers.Handler, f string, w http.ResponseWriter, r *http.Request) bool {
	switch f {
	case "asistencia":
		h.Asistencia(w, r)
	case "asistenciaef":
		h.AsistenciaEF(w, r)
	case "alumnosausentes":
		h.AlumnosAusentes(w, r)
	case "boletin":
		h.Boletin(w, r)
	case "notificaciones":
		h.Notificaciones(w, r)
	case "ver_notificaciones":
		h.VerNotificaciones(w, r)
	case "parte_diario":
		h.ParteDiario(w, r)
	case "notificacionausente":
		h.NotificacionAusente(w, r)
	case "ver_notas":
		h.VerNotas(w, r)
	case "ver_notastodas":
		h.VerNotasTodas(w, r)
	default:
		return false
	}
	return true
}

func dispatchModule(h *handlers.Handler, m string, f string, w http.ResponseWriter, r *http.Request) bool {
	if f == "" {
		f = "index"
	}
	switch f {
	case "index":
		h.ModuleIndex(w, r, m)
	case "buscar":
		h.ModuleBuscar(w, r, m)
	case "alta":
		h.ModuleAlta(w, r, m)
	case "ver":
		h.ModuleVer(w, r, m)
	default:
		return false
	}
	return true
}

func dispatchAlumnos(h *handlers.Handler, f string, w http.ResponseWriter, r *http.Request) bool {
	if f == "" {
		f = "index"
	}
	switch f {
	case "index":
		h.ModuleIndex(w, r, "alumnos")
	case "buscar":
		h.AlumnosBuscar(w, r)
	case "alta":
		h.AlumnosAlta(w, r)
	case "ver":
		h.AlumnosVer(w, r)
	default:
		return false
	}
	return true
}

func dispatchDocentes(h *handlers.Handler, f string, w http.ResponseWriter, r *http.Request) bool {
	if f == "" {
		f = "index"
	}
	switch f {
	case "index":
		h.ModuleIndex(w, r, "docentes")
	case "buscar":
		h.DocentesBuscar(w, r)
	case "alta":
		h.DocentesAlta(w, r)
	case "ver":
		h.DocentesVer(w, r)
	default:
		return false
	}
	return true
}

func dispatchPreceptores(h *handlers.Handler, f string, w http.ResponseWriter, r *http.Request) bool {
	if f == "" {
		f = "index"
	}
	switch f {
	case "index":
		h.ModuleIndex(w, r, "preceptores")
	case "buscar":
		h.PreceptoresBuscar(w, r)
	case "alta":
		h.PreceptoresAlta(w, r)
	case "ver":
		h.PreceptoresVer(w, r)
	default:
		return false
	}
	return true
}

func resolveRole(r *http.Request) (string, string) {
	user := ""
	role := ""
	if c, err := r.Cookie("sadsgo_role"); err == nil && c.Value != "" {
		role = c.Value
	}
	if c, err := r.Cookie("sadsgo_user"); err == nil && c.Value != "" {
		user = c.Value
	}
	return user, role
}

func allowed(role, m, f, path string) bool {
	if role == "" {
		return false
	}
	if role == "directivo" || role == "secretario" || role == "tecnico" {
		return true
	}

	if path == "/" && (m == "" || m == "modulos") {
		return true
	}

	switch role {
	case "preceptores":
		if m == "inasistencia" {
			return f == "asistencia" || f == "alumnosausentes" || f == "parte_diario"
		}
		return false
	case "secreAlumno":
		return m == "alumnos"
	case "secreDocente":
		return m == "docentes"
	default:
		return false
	}
}

func filteredModules(role string, mods []string) []string {
	out := []string{}
	for _, m := range mods {
		if allowed(role, m, "index", "/") {
			out = append(out, m)
		}
	}
	return out
}
