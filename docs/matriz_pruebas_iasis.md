# Matriz de Pruebas IASis (Demo Miercoles)

Fecha base: 2026-02-16
Objetivo demo: validar paridad funcional minima entre legacy e IASis en flujos migrados.

| Flujo | Caso | Legacy esperado | Resultado IASis | Estado | Observaciones |
|---|---|---|---|---|---|
| asistencia | Mostrar alumnos por curso | Lista correcta |  | Pendiente |  |
| asistencia | Guardar faltas | Inserta en alumnos_faltas |  | Pendiente |  |
| alumnosausentes | Ver ausentes del dia | Tabla con fecha actual |  | Pendiente |  |
| boletin | Curso+mes actual | Planilla con dias hasta hoy |  | Pendiente |  |
| boletin | Curso+mes pasado | Planilla completa de mes |  | Pendiente |  |
| notificaciones | Alta valida | Crea notificacion |  | Pendiente |  |
| ver_notificaciones | Buscar por descripcion | Lista filtrada |  | Pendiente |  |
| ver_notificaciones | Abrir adjunto/modificar | Link funcional |  | Pendiente |  |
| notificacionausente | Generar cedula con params | Datos completos en cedula |  | Pendiente |  |
| asistenciaef | Mostrar alumnos por curso | Lista correcta |  | Pendiente |  |
| asistenciaef | Guardar faltas EF | Inserta con materia EF |  | Pendiente |  |
| ver_notas | Buscar por asunto/gen/codigo | Lista filtrada |  | Pendiente |  |
| ver_notas | Subir/abrir PDF | Link/form funcional |  | Pendiente |  |
| ver_notastodas | Buscar por asunto/codigo | Lista simple filtrada |  | Pendiente |  |

## Criterio de aprobacion de ronda
- Aprobado si cada flujo tiene al menos 1 caso principal en estado OK.
- Si un flujo falla, registrar observacion y crear ajuste puntual en IASis.
