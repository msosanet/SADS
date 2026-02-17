# Reporte de Armado IASis

Fecha: 2026-02-16 10:04:13

## Criterio aplicado
- No se modifico codigo original del sistema.
- Se genero un fork paralelo en IASis/legacy con copias sin cambios.
- Se genero separacion automatica en IASis/migrado/<modulo>/logica y IASis/migrado/<modulo>/vistas.
- No se alteraron archivos de conexion a BD ni credenciales existentes (solo copia).
- Se excluyeron carpetas de terceros/pesadas para evitar ruido tecnico (vendor, fpdf, ckeditor, jpgraph, etc.).

## Totales
- Archivos PHP procesados: 1733
- Archivos con separacion por marcador HTML: 1092
- Archivos orientados a logica (vista vacia automatica): 641

## Estado por modulo
- inasistencia: total=542, split_html=411, solo_logica=131, estado=ok
- inasistenciaprueba: total=456, split_html=360, solo_logica=96, estado=ok
- alumnos: total=190, split_html=119, solo_logica=71, estado=ok
- docentes: total=145, split_html=109, solo_logica=36, estado=ok
- preceptores: total=15, split_html=13, solo_logica=2, estado=ok
- cargadocentes: total=57, split_html=37, solo_logica=20, estado=ok
- estadistica: total=77, split_html=3, solo_logica=74, estado=ok
- mesas: total=40, split_html=19, solo_logica=21, estado=ok
- comedor: total=10, split_html=8, solo_logica=2, estado=ok
- entrada: total=12, split_html=7, solo_logica=5, estado=ok
- dbf2mysql: total=23, split_html=1, solo_logica=22, estado=ok
- archivos: total=5, split_html=1, solo_logica=4, estado=ok
- classes: total=5, split_html=0, solo_logica=5, estado=ok
- mqtt: total=46, split_html=0, solo_logica=46, estado=ok
- prueba: total=109, split_html=4, solo_logica=105, estado=ok
- shell: total=1, split_html=0, solo_logica=1, estado=ok

## Observaciones
- La separacion fue intencionalmente conservadora para no reescribir reglas de negocio ni SQL.
- En archivos con PHP intercalado dentro de HTML, parte de logica puede permanecer en vistas por compatibilidad.
- Este fork esta preparado para refactor incremental posterior por modulo.


## Actualizacion 2026-02-16 (piloto manual)
- Se reemplazo la separacion automatica de `asistencia` por separacion manual fina:
  - `IASis/migrado/inasistencia/logica/asistencia.logic.php`
  - `IASis/migrado/inasistencia/vistas/asistencia.view.php`
- La logica ahora concentra consultas/acciones y la vista renderiza.
- No se tocaron conexiones de BD ni archivos fuera de `IASis`.

## Actualizacion 2026-02-16 (piloto manual 2)
- Se separo manualmente `alumnosausentes`:
  - `IASis/migrado/inasistencia/logica/alumnosausentes.logic.php`
  - `IASis/migrado/inasistencia/vistas/alumnosausentes.view.php`
- Se agrego plantilla base reutilizable:
  - `IASis/migrado/inasistencia/_plantilla/README.txt`
  - `IASis/migrado/inasistencia/_plantilla/controller/TemplateController.php`
  - `IASis/migrado/inasistencia/_plantilla/service/TemplateService.php`
  - `IASis/migrado/inasistencia/_plantilla/repository/TemplateRepository.php`
  - `IASis/migrado/inasistencia/_plantilla/view/TemplateView.php`

## Actualizacion 2026-02-16 (piloto manual 3)
- Se separo manualmente `boletin`:
  - `IASis/migrado/inasistencia/logica/boletin.logic.php`
  - `IASis/migrado/inasistencia/vistas/boletin.view.php`
- Se actualizo router publico con accesos rapidos a pilotos:
  - `IASis/public/index.php`
- Se completa fase inicial de IASis con 3 pilotos manuales.

## Actualizacion 2026-02-16 (fase notificaciones)
- Se separaron manualmente 3 flujos adicionales:
  - `notificaciones`
  - `ver_notificaciones`
  - `notificacionausente`
- Se actualizo `IASis/public/index.php` con accesos rapidos a los 6 pilotos manuales.
- Se considera finalizada la etapa actual de refactor inicial en IASis.

## Actualizacion 2026-02-16 (bloques siguientes migrados)
- Se migraron manualmente los bloques solicitados:
  - `asistenciaef`
  - `ver_notas`
  - `ver_notastodas`
- Se actualizo el indice de pilotos en `IASis/public/index.php`.
- Cobertura manual acumulada: 9 flujos criticos de `inasistencia`.

## Actualizacion 2026-02-16 (ronda estabilizacion local 01)
- Se ajustaron enlaces de interoperabilidad con legacy en:
  - `boletin.view.php`
  - `ver_notificaciones.view.php`
  - `ver_notas.view.php`
- Se agrego paquete de demo/pruebas:
  - `IASis/docs/matriz_pruebas_iasis.md`
  - `IASis/docs/guion_demo_miercoles.md`
  - `IASis/docs/ronda_estabilizacion_local_01.md`

## Actualizacion 2026-02-16 (ronda estabilizacion local 02)
- Se corrigieron rutas de assets (favicon/background) para entorno `IASis/public`.
- Se ajustaron enlaces a scripts legacy sobre `../../inasistencia/...`.
- Se robustecio `notificacionausente` ante parametros incompletos.
- Se agrego enlace de ejemplo en `IASis/public/index.php`.

## Actualizacion 2026-02-16 (base local minima demo)
- Se crearon scripts SQL para levantar entorno local sin base original:
  - `IASis/sql/local_schema_min.sql`
  - `IASis/sql/local_seed_min.sql`
- Se documento la instalacion local en:
  - `IASis/docs/setup_local_db.md`
- Cobertura: 9 flujos migrados de `inasistencia`.
