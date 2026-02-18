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

## Modulos (paquete minimo)
Para todos los modulos listados en `/?m=modulos&f=index` se agrego:
- index
- buscar (demo)
- alta (demo)
- ver (demo)

## Alumnos y Docentes (funcional)
Se habilito paquete minimo real (CRUD basico) usando `base_sobral`:
- `/?m=alumnos&f=buscar`
- `/?m=alumnos&f=alta`
- `/?m=alumnos&f=ver`
- `/?m=docentes&f=buscar`
- `/?m=docentes&f=alta`
- `/?m=docentes&f=ver`

## Preceptores (funcional)
Tabla nueva `preceptores` agregada en `sql/local_schema_min.sql` y seed en `sql/local_seed_min.sql`.
- `/?m=preceptores&f=buscar`
- `/?m=preceptores&f=alta`
- `/?m=preceptores&f=ver`

## Roles (demo)
Se agrego login con roles por usuario.
- `directivo`, `secretario`, `tecnico`: acceso completo.
- `preceptores`: solo `inasistencia/asistencia`, `alumnosausentes`, `parte_diario`.
- `secreAlumno`: solo modulo `alumnos`.
- `secreDocente`: solo modulo `docentes`.

Usuario demo: `demo` / `demo` (rol `directivo`).

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
