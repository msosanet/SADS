# Ronda de Estabilizacion Local 01

Fecha: 2026-02-16

## Ajustes aplicados
- Correccion de enlaces en vistas migradas para interoperar con scripts legacy cuando aplica:
  - `boletin.view.php` (links a `ver_alu.php` y `alumnostarde.php`).
  - `ver_notificaciones.view.php` (modificar/upload/verdoc).
  - `ver_notas.view.php` (modificar/upload/verdoc).

## Impacto esperado
- Menos enlaces rotos durante demo local.
- Mejor continuidad entre flujos migrados e infraestructura legacy.
