# SADSGO

Migracion de pilotos IASis a Go (net/http + html/template + MySQL).

## Requisitos
- Go 1.22+
- MySQL/MariaDB activo

## Base de datos (demo)
Usa los mismos scripts de IASis:

```sql
SOURCE d:/backsobral/Sistema/www/html/IASis/sql/local_schema_min.sql;
SOURCE d:/backsobral/Sistema/www/html/IASis/sql/local_seed_min.sql;
```

Por defecto el servidor usa:
- Host: `127.0.0.1`
- Puerto: `3306`
- Usuario: `root`
- Password: vacio
- DB base: `base_sobral`
- DB sid: `sid`

## Ejecutar
Desde `SADSGO/`:

```bash
go run ./cmd/sadsgo
```

Abrir:
- `http://localhost:8080/`

## Pilotos
- asistencia
- alumnosausentes
- boletin
- notificaciones
- ver_notificaciones
- notificacionausente
- asistenciaef
- ver_notas
- ver_notastodas

## Variables de entorno
- `SADSGO_HTTP_ADDR` (default `:8080`)
- `SADSGO_DB_HOST` (default `127.0.0.1`)
- `SADSGO_DB_PORT` (default `3306`)
- `SADSGO_DB_USER` (default `root`)
- `SADSGO_DB_PASS` (default vacio)
- `SADSGO_DB_BASE` (default `base_sobral`)
- `SADSGO_DB_SID` (default `sid`)
- `SADSGO_USER` (default `demo`)
- `SADSGO_AUTH_BYPASS` (default `true`)
