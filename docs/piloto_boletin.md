# Piloto Manual: Boletin

Fecha: 2026-02-16
Modulo: `inasistencia`
Flujo: `boletin`

## Objetivo
Separar logica y vista de la planilla mensual de asistencia, manteniendo consultas y comportamiento legacy.

## Archivos trabajados
- `IASis/migrado/inasistencia/logica/boletin.logic.php`
- `IASis/migrado/inasistencia/vistas/boletin.view.php`

## Alcance
- Logica:
  - autenticacion/sesion
  - carga de cursos
  - armado de encabezados por dia del mes
  - construccion de planilla por alumno y por dia
  - resumen de justificadas/injustificadas/porcentaje
- Vista:
  - formulario de curso/mes
  - tabla mensual completa
  - render de enlaces y colores de celdas

## Restricciones respetadas
- No se tocaron archivos del sistema original.
- No se alteraron conexiones de base de datos.

## Ejecucion
- `IASis/public/index.php?m=inasistencia&f=boletin`

## Nota
Se agrego control defensivo para porcentaje cuando no hay denominador, evitando division por cero.
