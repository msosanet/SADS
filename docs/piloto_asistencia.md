# Piloto Manual: Asistencia

Fecha: 2026-02-16
Modulo: `inasistencia`
Flujo: `asistencia`

## Objetivo
Reemplazar la separacion automatica por una separacion manual fina, manteniendo comportamiento legacy y sin tocar conexiones de base de datos.

## Archivos trabajados
- `IASis/migrado/inasistencia/logica/asistencia.logic.php`
- `IASis/migrado/inasistencia/vistas/asistencia.view.php`

## Que se separo
- Logica:
  - control de sesion/autorizacion
  - carga de cursos
  - carga de alumnos por curso
  - guardado de faltas
  - armado de variables para la vista
- Vista:
  - estructura HTML
  - includes visuales de header/menu legacy
  - formulario de seleccion y carga
  - render de tabla de alumnos

## Reglas respetadas
- No se modificaron archivos del sistema original.
- No se alteraron conexiones ni credenciales de BD.
- Se mantuvo SQL y comportamiento base del flujo.

## Ejecucion
Entrada por router IASis:
- `IASis/public/index.php?m=inasistencia&f=asistencia`

## Nota tecnica
En este entorno no hay binario `php` disponible en PATH, por lo tanto no se pudo correr `php -l` para validacion automatica de sintaxis.
