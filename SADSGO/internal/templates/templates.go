package templates

import (
	"embed"
	"html/template"
)

//go:embed *.html
var fs embed.FS

func Parse() (*template.Template, error) {
	return template.New("all").Funcs(template.FuncMap{
		"urlquery": template.URLQueryEscaper,
		"eq":       func(a, b string) bool { return a == b },
		"eqInt":    func(a, b int) bool { return a == b },
	}).ParseFS(fs, "*.html")
}
