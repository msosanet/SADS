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


<form method="GET" action="enviadas.php">

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

$anio= date("Y");


$result = mysql_query ("SELECT * FROM notas WHERE not exists (select 1 from mesasalidas where mesasalidas.numero = notas.codigo and mesasalidas.anio=$anio)");



?>	
				<tr>
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Notas creadas pero no enviadas año <?php echo $anio ?></p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
		<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<tr>
							<td width="200" bgcolor="#808080" align="center" height="36">Numero</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Descripcion</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Creador</td>
							

							
						</tr>

 		<?php while ($fila2 = mysql_fetch_array($result))
		{	
		?> 


						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[codigo];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[descripcion];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[agente];?></td>

							
                  					
					
							
							
						</tr>
						<?
						}
						?>

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
