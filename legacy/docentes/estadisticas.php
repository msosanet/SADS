<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Administrador del SID</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;






?>

<body background="bgris.gif" >


<form method="GET" action="estadisticas.php">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			
			<div align="center">
			<table border="0" width="980">

<?if ($_SESSION['valor']==1)
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




$db2 = mysql_connect("localhost", "fgoicoechea", "sobral2011");
mysql_select_db("DBF2MYSQL",$db2);

$result77 = mysql_query ("SELECT * FROM docentes WHERE activo = 'T'",$db2);
$activos = mysql_num_rows($result77);

$result78 = mysql_query ("SELECT * FROM docentes WHERE activo = 'T' and sexo='Femenino'",$db2);
$femeninos = mysql_num_rows($result78);


$result79 = mysql_query ("SELECT * FROM docentes WHERE activo = 'T' and sexo='Masculino'",$db2);
$masculinos = mysql_num_rows($result79);

$result80 = mysql_query ("SELECT * FROM docentes WHERE activo = 'T' and tribu='Onas'",$db2);
$onas = mysql_num_rows($result80);

$result81 = mysql_query ("SELECT * FROM docentes WHERE activo = 'T' and tribu='Yamanas'",$db2);
$yamanas = mysql_num_rows($result81);


?>	
				<tr>
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Estadisticas</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
		<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<tr>
							<td width="200" bgcolor="#808080" align="center" height="36">Docentes Activos</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Masculinos</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Femeninos</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Onas</td>
							<td bgcolor="#808080" width="118" align="center"  height="36">Yamanas</td>							

							
						</tr>

 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $activos;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $masculinos;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $femeninos;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $onas;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $yamanas;?></td>
							
                  					
					
							
							
						</tr>

						</table>
					</div>
					<p align="center">

					</p>
					<p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p>
					<p align="left">
</font>
					<?
				if (isset($_GET['muestra2']))
{ 
	$descripcion=$_GET['descripcion'];

	$_pagi_sql="SELECT * FROM docentes WHERE apellido like'%$descripcion%'";



$_pagi_cuantos=5;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><?
echo"$_pagi_navegacion"; 
?>
<br><br>
</p><?

		?> <?
}
	?>					
					</p>
					<p align="center">&nbsp;</td>
				</tr>


			</table>
			</div>
			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>



</form>
 </td>

</div>

</body>

</html>
<? } ?>