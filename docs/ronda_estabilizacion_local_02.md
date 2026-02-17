# Ronda de Estabilizacion Local 02

Fecha: 2026-02-16

## Ajustes aplicados
- Correccion de rutas de assets para ejecucion desde `IASis/public/index.php`:
  - favicon -> `../../imag/favicon.ico`
  - background -> `../../inasistencia/bgris.gif`
- Correccion de enlaces a acciones legacy en:
  - `boletin.view.php`
  - `ver_notificaciones.view.php`
  - `ver_notas.view.php`
  (ahora apuntan a `../../inasistencia/...`)
- Hardening de `notificacionausente`:
  - validacion de parametros requeridos
  - mensaje de ayuda cuando faltan parametros
  - no ejecuta flujo de notificacion incompleto
- Mejora del indice de pilotos:
  - link de ejemplo para `notificacionausente` con query completa

## Impacto esperado
- Menos recursos rotos en demo local.
- Menos errores por acceso directo a flujos que requieren GET especifico.
- Navegacion mas fluida entre vistas migradas y scripts legacy aun no migrados.
