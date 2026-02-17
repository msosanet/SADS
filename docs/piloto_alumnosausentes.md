# Piloto Manual: Alumnos Ausentes

Fecha: 2026-02-16
Modulo: `inasistencia`
Flujo: `alumnosausentes`

## Objetivo
Aplicar separacion manual de logica y vista sobre un flujo de consulta diaria, manteniendo comportamiento base y sin modificar conexiones BD.

## Archivos trabajados
- `IASis/migrado/inasistencia/logica/alumnosausentes.logic.php`
- `IASis/migrado/inasistencia/vistas/alumnosausentes.view.php`

## Cambios
- Logica:
  - control de sesion
  - conexion legacy
  - consulta de ausentes por fecha actual
  - entrega de dataset a vista
- Vista:
  - render de header/menu
  - tabla HTML de resultados
  - eliminacion de SQL inline en render

## Ejecucion
- `IASis/public/index.php?m=inasistencia&f=alumnosausentes`

## Nota
No hay validacion automatica con `php -l` por ausencia de binario php en PATH del entorno actual.
