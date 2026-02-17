Plantilla base IASis (inasistencia)
===================================

Objetivo
--------
Reutilizar una estructura minima por capas para migrar flujos legacy sin reescribir todo.

Capas
-----
- controller/TemplateController.php
- service/TemplateService.php
- repository/TemplateRepository.php
- view/TemplateView.php

Regla de uso
------------
1) Copiar esta carpeta y renombrar segun flujo (ej: asistencia_diaria).
2) Mover SQL desde el archivo legacy a repository.
3) Mover validaciones/reglas a service.
4) Dejar controller como orquestador.
5) Dejar view sin SQL ni reglas de negocio.

Restriccion actual
------------------
En este proyecto no se cambian conexiones de base de datos por requerimiento operativo.
