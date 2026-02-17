# Decisiones de Arquitectura IASis

## D-001: Fork paralelo por carpeta
Se crea `IASis/` en paralelo al sistema existente para no interrumpir operacion y evitar riesgo de regresion en produccion.

## D-002: No tocar conexiones de BD
Por pedido explicito, no se modifican `conexion*.php`, credenciales ni hosts.

## D-003: Estrategia de separacion conservadora
La separacion se aplica automaticamente en pares `logica`/`vistas` por archivo, preservando el codigo legado.

## D-004: Exclusiones de terceros
Se excluyen carpetas de terceros pesadas (ej. `vendor`, `jpgraph`, `fpdf`, `ckeditor`) para concentrar el ordenamiento en codigo propio.

## D-005: Refactor incremental
`IASis` no busca una migracion total inmediata; deja base para mejoras modulo a modulo sin reescribir todo.
