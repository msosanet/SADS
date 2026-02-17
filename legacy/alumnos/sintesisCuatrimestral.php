<?PHP
/* Muestra estudiantes activos que adeudan materias,
** para cada espacio curricular todos los años adeudados.
*/
session_start();

// Está logueado el usuario?
include 'conexion.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt);
if (!mysql_num_rows($resultt)) {
	header('Location: i_admin.php');
	exit;
}


$ciclo = $_SESSION['cicloLectivo'];



?>
<!DOCTYPE html >
<html lang="es">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="style2.css" />
<script src="js/ordenTabla.js" type="text/javascript"></script>


<title>Apro/Reprobados por espacios del 1er Cuatrimestre</title>

</head>
<?
include 'header.php';

?>
<body>
<?

?>

<div align="center" style="max-width: 980px">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>

<div style="overflow-x: scroll;max-width: 980px">
<?PHP
require_once("submod/sintesisCuatrimestre.php");
?>
</div>
</div>
<br>

<?
include 'footer.php';
?>

</body>
<?

?>


</html>
