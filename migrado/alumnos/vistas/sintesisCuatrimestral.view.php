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

