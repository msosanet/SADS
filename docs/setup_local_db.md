# Setup Local DB (IASis)

Fecha: 2026-02-16
Objetivo: levantar base minima local para demo sin importar datos del sistema real.

## Archivos
- `IASis/sql/local_schema_min.sql`
- `IASis/sql/local_seed_min.sql`

## Requisitos
- MySQL/MariaDB local activo.
- Permiso para crear bases y tablas.
- Servidor web apuntando a `d:/backsobral/Sistema/www/html`.

## Paso 1: crear esquema
Ejecutar:
```sql
SOURCE d:/backsobral/Sistema/www/html/IASis/sql/local_schema_min.sql;
```

## Paso 2: cargar datos demo
Ejecutar:
```sql
SOURCE d:/backsobral/Sistema/www/html/IASis/sql/local_seed_min.sql;
```

## Paso 3: credenciales legacy (si no conecta)
El sistema usa credenciales hardcodeadas en varios archivos:
- `fgoicoechea` / `sobral2011`
- `root` / ``

Si tu MySQL local no acepta esas credenciales, tenes 2 alternativas:
1. Crear usuarios locales con esas claves (ver bloque comentado en `local_schema_min.sql`).
2. Ajustar solo en tu entorno local los `conexion*.php` de IASis (no recomendado para demo rapida).

## Paso 4: abrir sistema
- `http://localhost/IASis/public/index.php`

## Flujos cubiertos por esta base minima
- asistencia
- asistenciaef
- alumnosausentes
- boletin
- notificaciones
- ver_notificaciones
- notificacionausente
- ver_notas
- ver_notastodas

## URL de ejemplo para notificacionausente
```text
http://localhost/IASis/public/index.php?m=inasistencia&f=notificacionausente&dnix=30111222&fechaxxx=2026-02-16&materiax=Matematica&cursox=1A&turnox=M&tipox=A&vistax=N
```

## Nota
Los datos son ficticios y de demostracion. No dependen de la base original del colegio.

