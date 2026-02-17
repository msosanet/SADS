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
<title>Alumnos</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
$resultmotivo = mysql_query ("SELECT * FROM motivo_dec"); 



//$ye3 = mysql_query ("SELECT materia FROM materias ");
//$data3=mysql_fetch_array($ye3);


function menu2($ssql,$valor,$nombre){ 
  	echo "<select name='$nombre'>"; 
  	$resultado=mysql_query($ssql); 
  	while ($fila=mysql_fetch_row($resultado)){ 
    	if ($fila[0]==$valor){ 
      	echo "<option selected value='$fila[0]'>$fila[1]";	
    	} 
    	else{ 
      	echo "<option value='$fila[0]'>$fila[1]";	
    	} 
  } 
  	echo "</select>";	
}



?>

<body background="bgris.gif" >


<form method="GET" action="calificador.php">

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
if ($_SESSION['valor']==4) 
{		
include 'menuppal4.php';
}
?>
	
				<tr>
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Listar materias.</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
					<table border="0" width="62%">
						<tr>
							<td align="right" width="36%">Seleccione la asignatura:</td>
							<td align="right"><? $valor3="SELECT * FROM materias order by id";
							menu2($valor3,$data3['materia'],'materia'); ?></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>

						
						<tr>
							<td align="right" colspan="2">
							<p align="center">
									<input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
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

	$materia=$_GET['materia'];


	$anio=date("Y");

$_pagi_sql="SELECT * FROM materias WHERE id = '$materia' order by id";




$_pagi_cuantos=50;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><?
echo"$_pagi_navegacion"; 
?>
<br><br>
</p><?

		?> <table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">





						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">MATERIA</td>							
							<td width="20" bgcolor="#808080" align="center" height="36">AÑO</td>
							<td width="100" bgcolor="#808080" align="center" height="36">PLAN</td>
							<td bgcolor="#808080" width="100" align="center" height="36">ACCIONES</td>

						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{

		

	
		?> 

						<tr>

							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[materia];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[anio];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[plan];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><a href="calificador2.php?materia=<? echo $fila2[id]; ?>" target="_self">Poner notas</a></td>

						
                					
					
							
							
						</tr>
						<?
						}
						?>
						</table>
<?
}
$fechaDMA = date('d/m/Y');

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