<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style2.css" />

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Agregar curso y división a alumnos</title>
</head>

<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
?>

<div id="marco980" align="center"><!-- ***** DIV PRINCIPAL *** -->

<form method="GET" action="alta_curso.php">

<?
include 'snipet_barramenu.php'; //COMPRUEBA EL TIPO DE USUARIO Y DESPLIEGA MENÚ DE FUNCIONES ACORDE
?>	
<br>
<p align="left" class="titulo">Buscar Alumno por Apellido para asignarle un curso/div.</p>
<br>
	
<div align="left">
		
<table border="0">
	<tr>
        <td class="titulo2">Ingrese el Apellido, D.N.I. o parte de él:</td>
        <td align="right">&nbsp;<input type="text" name="descripcion" id="descripcion" size="35" maxlength="40" value="" autofocus/></td>
        <td><input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
	</tr>
</table>
</div>
<br>

</font>
<?

$anio=date("Y");

if (isset($_GET['muestra2'])) { 
	$descripcion = $_GET['descripcion'];
    $_pagi_sql = "SELECT * FROM alumno WHERE apellido like'%$descripcion%' or dni like'%$descripcion%' order by apellido";
    $_pagi_cuantos = 20;
    $_pagi_conteo_alternativo = true;
    $_pagi_nav_num_enlaces = 10;
    include("paginator.inc.php"); 
?>
<p align="left">
<?
echo "$_pagi_navegacion"; 
?>
<br><br>
</p>
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
	<tr>
		<td class="text1b" colspan="5" height="40" align="left">
		&nbsp;Resultado de la B&uacute;squeda</td>
	</tr>
	<tr bgcolor="#CCCCCC">
		<td width="20" align="center" height="36">DNI</td>
		<td width="200" align="center" height="36">Apellido</td>
		<td width="200" align="center" height="36">Nombre</td>
		<td width="100" align="center" height="36">Curso/div</td>
		<td width="118" align="center"  height="36">Acciones</td>							
	</tr>

<? 




while ($fila2 = mysql_fetch_array($_pagi_result)) {

$docu = mysql_query ("SELECT * FROM cursa where alumno=$fila2[dni] and anio='$anio' and control=1");
$docum = mysql_fetch_array($docu);	
?> 

	<tr bgcolor="#EEEEEE">
		<td width="20" align="center"><? echo $fila2[dni]; ?></td>
		<td width="20" align="center"><? echo $fila2[apellido]; ?></td>
		<td width="20" align="center"><? echo $fila2[nombre]; ?></td>
		<td width="20" align="center"><? echo $docum[curso]; ?>º / <? echo $docum[divi]; ?>º</td>


		<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="alta_curso2.php?dni=<? echo $fila2[dni]; ?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Asignar un Curso/div"></a></td>
    </tr>
<?
    }
?>    
</table>
<?
    }
    
?>					
					
<br>					
<?
include 'footer.php';
?>

</form>

</div>

</body>

</html>
<? 
    } //************ FIN COMPRUEBA SESIÓN *******************
?>
