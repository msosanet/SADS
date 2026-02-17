<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];

// "SELECT * FROM `calificador2`,materias,alumno WHERE calificador2.dni = alumno.dni AND materia = materias.idmateria AND idnota = 10 AND calificador2.dni IN (SELECT alumno FROM alumnos.cursa WHERE control = 1 AND anio = 2023 /* Todos los estudiantes activos en 2023*/)"

// "SELECT dni, COUNT(idmateria) AS reprobadas FROM `calificador2`,materias WHERE materia = materias.idmateria AND idnota = 10 AND calificador2.anio = 2023 AND (nota < 6 OR nota = 1000) AND calificador2.dni IN (SELECT alumno FROM alumnos.cursa WHERE control = 1 AND anio = 2023 /* Todos los estudiantes activos en 2023*/) GROUP BY dni /*Cantidad de reprobadas o ausente en definitiva*/ "

//SELECT dni, COUNT(idmateria) AS reprobadas FROM `calificador2`,materias WHERE materia = materias.idmateria AND idnota = 10 AND calificador2.anio = 2023 AND (nota < 6 OR nota = 1000) AND calificador2.dni IN (SELECT DISTINCT dni FROM `calificador2` WHERE anio = 2023 /* Todos los estudiantes que recibieron alguna calificacion en 2023*/) GROUP BY dni /*Cantidad de reprobadas o ausente en definitiva*/ 

?>

