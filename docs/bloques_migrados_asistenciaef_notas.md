# Bloques Migrados: Asistencia EF y Notas

Fecha: 2026-02-16
Modulo: `inasistencia`

## Flujos migrados manualmente
1. `asistenciaef`
   - `IASis/migrado/inasistencia/logica/asistenciaef.logic.php`
   - `IASis/migrado/inasistencia/vistas/asistenciaef.view.php`
2. `ver_notas`
   - `IASis/migrado/inasistencia/logica/ver_notas.logic.php`
   - `IASis/migrado/inasistencia/vistas/ver_notas.view.php`
3. `ver_notastodas`
   - `IASis/migrado/inasistencia/logica/ver_notastodas.logic.php`
   - `IASis/migrado/inasistencia/vistas/ver_notastodas.view.php`

## Criterio aplicado
- Separacion de logica y vista sin tocar codigo original fuera de IASis.
- Se mantienen conexiones y SQL legacy.
- Se simplifica paginacion legacy para priorizar estabilidad del flujo migrado.

## Entrada
- `IASis/public/index.php`
