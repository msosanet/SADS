# Guion Demo Miercoles (Local)

Fecha prevista de demo: Miercoles 2026-02-18
Duracion sugerida: 20-30 minutos

## 1) Apertura (2 min)
- Mostrar que el sistema original no fue tocado.
- Explicar que IASis corre en paralelo y permite migracion gradual.

## 2) Navegacion base (3 min)
- Abrir `IASis/public/index.php`.
- Mostrar listado de flujos ya migrados.

## 3) Demo funcional (12-18 min)
- Asistencia: seleccionar curso, mostrar alumnos, guardar faltas.
- Alumnos ausentes: ver listado del dia.
- Boletin: ver planilla mensual.
- Notificaciones: alta + busqueda en listado.
- Notificacion ausente: generar cedula.
- Asistencia EF y modulo de notas (busqueda/listado).

## 4) Cierre tecnico (3-5 min)
- Mostrar estructura logica/vista en `IASis/migrado/inasistencia`.
- Mostrar documentacion en `IASis/docs`.
- Mostrar que conexiones BD legacy se mantienen sin cambios.

## Mensajes clave
- Se separo logica y vistas en flujos criticos sin interrumpir operacion.
- Se puede seguir migrando por bloques con bajo riesgo.
- Queda validacion funcional con usuarios para consolidar adopcion.
