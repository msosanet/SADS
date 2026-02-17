<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style2.css" />

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>BUSCA DOCENTE X APELL O DNI</title>
</head>

<body>

<div id="marco980"><!-- ***** DIV PRINCIPAL *** -->

<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
?>


<!-- **************** BARRA DE MENÚS *************** --> 
<?
if ($_SESSION['valor']==1)
{		
include 'menuppal2.php';
}
if ($_SESSION['valor']==0)
{		
include 'menuppal.php';
}
if ($_SESSION['valor']==3) 
{		
include 'menuppal3.php';
}
?>
<!-- **************** FIN BARRA DE MENÚS *************** -->	

<form method="GET" action="ver_ina2.php">
<br>
<p class="titulo" align="left">Buscar por Apellido</p>
<br>
					
<div align="center">
					
    <table border="0">
       <tr>
           <td width="200" align="right" bgcolor="#dddddd">Ingrese el apellido o parte de él:</td>
           <td width="170" bgcolor="#dddddd"><input type="text" name="descripcion" id="descripcion" size="28" maxlength="40" value="" autofocus/></td>
           <td align="center" width="100"><input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
       </tr>
    </table>
    
</div>

<p align="center">&nbsp;</p>

<?
if (isset($_GET['muestra2'])) { 
	$descripcion=$_GET['descripcion'];

	$_pagi_sql="SELECT * FROM docentes WHERE apellido like'%$descripcion%' and identificacion=1 order by apellido,nombre";
    $_pagi_cuantos=7;
    $_pagi_conteo_alternativo = true;
    $_pagi_nav_num_enlaces=10;
    include("paginator.inc.php"); 
?>

<p align="left"><? echo"$_pagi_navegacion"; ?></p>
<br>
<br>


<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="4" height="40" align="left">
							&nbsp;Resultado de la B&uacute;squeda</td>
						</tr>
						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">DNI</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Apellido</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Nombre</td>
							<td bgcolor="#808080" width="118" align="center"  height="36">Acciones</td>							

							
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{	
		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[dni];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[apellido];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[nombre];?></td>
							<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="ver_ina3.php?actor=<? echo $fila2[dni]; ?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Cargar Inasistencia"></a></td>
							
                  					
					
							
							
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
<? } ?>