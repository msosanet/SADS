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

	mux := http.NewServeMux()
	mux.HandleFunc("/", func(w http.ResponseWriter, r *http.Request) {
		m := r.URL.Query().Get("m")
		f := r.URL.Query().Get("f")
		if m == "inasistencia" {
			if dispatchInasistencia(h, f, w, r) {
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
