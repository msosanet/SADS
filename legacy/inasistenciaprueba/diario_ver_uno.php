<?
session_start();
if ($_SESSION['estado'] == 1) { 
include 'conexion.php';
$conexion = conectar();
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css">
<title>REGISTRO ENTRADA-SALIDA</title>


<script>
function alerta()
{
alert("Ventana emergente con mensaje");
}
</script>

</head>

<body>
<div id="marco980" align="center">

<?
include 'header.php';
include 'snipet_barramenu.php';

//CARGA DE VARIABLES PARA RECUPERAR UN REGISTRO

$dni = $_GET['dni'];
$fecha = $_GET['fecha'];  
$tipo = $_GET['tipo'];  
$horario = $_GET['horario'];
?>
<br>

<p class="titulo">CONSULTA UN REGISTRO DE ENTRADA Y SALIDA</p>
<hr>
<br>

 
 
<!-- *************** GRILLA MUESTRA HORARIOS ******************** -->    					
	<table border="1" cellpadding="1" cellspacing="0">
    	<tr bgcolor="#CCCCCC" align="center">          
    		<td width="250" bgcolor="#f4bc42">DOCENTE</td>
    		<td width="80" bgcolor="#f4bc42">FECHA</td>
    		<td width="80">TIPO MOV</td>
    		<td width="80">HORA</td>
    	</tr>
		<tr>
            <td><?
                $docentestodos = mysql_query ("SELECT * FROM docentes WHERE dni = $dni");
                $docente = mysql_fetch_array ($docentestodos);
                echo "<b>" . $docente[apellido] . "</b>, " . $docente[nombre]; 
                ?>
            </td>
            <td align="center"><? echo $fecha; ?></td>
            <td align="center"><? echo $tipo; ?></td>
            <td align="center"><? echo $horario; ?></td>
        </tr>
    </table>
<br>    
<input type="button" onclick="alerta()" value="   Mostrar mensaje   " />    
<br>
<? 
include 'footer.php';
?>

</div>
</body>
</html>



<?
} //************ FIN BRACKET SESION *******************************************************************
?>