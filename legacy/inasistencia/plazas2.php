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

?>

<body background="bgris.gif" >


<form method="POST" action="plazas.php">

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
?>	


			</table>
			</div>
			

			</td>
		</tr>
	</table>
</div>
<br>
<h2>PLAZAS</h2>
<br><br>
	<div align="center">
		<table border="1" width="980" bgcolor="#FFFFFF">
			<tr>
	<?	
	$sqlCar = "SELECT * FROM caracter ORDER BY codigo ASC";
	$resultCar = mysql_query($sqlCar);	
	while ($rowCar = mysql_fetch_assoc($resultCar))
	{	
	if ($rowCar['codigo']==1) $color="style='background-color: green;'";
	if ($rowCar['codigo']==2) $color="style='background-color: blue;'";
	if ($rowCar['codigo']==3) $color="style='background-color: yellow;'";
	if ($rowCar['codigo']==4) $color="style='background-color: orange;'";
	if ($rowCar['codigo']==10) $color="style='background-color: grey;'";
	
	
	
	echo "<td align=center ".$color.">";
	echo $rowCar['descripcion'];
	echo "</td>";
	}
			echo "<tr>";
		echo "</table>";
	echo "</div>";
echo "<br>";
$orden="id";
$columna="ordena";
if (isset($_GET['ordena']))
{	$orden=$_GET['ordena']." ASC";
	$columna="ordend";
 }
 
 if (isset($_GET['ordend']))
{	$orden=$_GET['ordend']." DESC";
	$columna="ordena";

 }



?>
<div align="center">
	<table border="1" width="980" bgcolor="#FFFFFF">
		<tr>
			<td align="center"><a href="plazas.php?<?=$columna?>=id">N&deg;</a></td>
			<td align="center"><a href="plazas.php?<?=$columna?>=plaza">Plaza</a></td>
			<td align="center"><a href="plazas.php?<?=$columna?>=turno">Turno</a></td>
			<td align="center"><a href="plazas.php?<?=$columna?>=curso">Curso</a></td>
			<td align="center"><a href="plazas.php?<?=$columna?>=division">Division</a></td>
			<td align="center"><a href="plazas.php?<?=$columna?>=codigo">Codigo</a></td>
			<td align="center"><a href="plazas.php?<?=$columna?>=cant_hs">Q hs</a></td>
			<td align="center"><a href="plazas.php">Cubierto</a></td>
			
			
			
		</tr>
<?	

$sql = "SELECT * FROM materia_cargo mc WHERE plaza!='0' ORDER BY mc.$orden";
$result = mysql_query($sql);	
while ($row = mysql_fetch_assoc($result))
            {	
			//CHEQUEAMOS SI ESTA OCUPADA LA PLAZA O NO
				$sqlM = "SELECT * FROM alta_baja ab WHERE materia='$row[id]' AND ab.activa='1'";
				//echo $sqlM;
				$resultM = mysql_query($sqlM);	
				$libre="";
				$q=0;
				$q=mysql_num_rows($resultM);
				//echo $q;
				$doc="";
				$enlace="";
				if ($q>0)
					{
					//echo $sqlM;
					
					//$libre="CUBIERTO";
					$color="style='background-color: green;'";
					$sqlDOCR = "SELECT * FROM alta_baja ab,docentes d WHERE ab.materia='$row[id]' AND ab.activa='1' AND ab.docente=d.dni";
				//	echo $sqlDOCR;
					$resultDOC = mysql_query($sqlDOCR);	
					$docenteresp = mysql_fetch_assoc($resultDOC);
					$libre=$docenteresp['apellido'].",".$docenteresp['nombre'];
					$enlace=1;
					$dnidoc=$docenteresp['dni'];
					if ($docenteresp['sit_revista']==1) $color="style='background-color: green;'";
					if ($docenteresp['sit_revista']==2) $color="style='background-color: blue;'";
					if ($docenteresp['sit_revista']==3) $color="style='background-color: yellow;'";
					if ($docenteresp['sit_revista']==4) $color="style='background-color: orange;'";
					if ($docenteresp['sit_revista']==10) $color="style='background-color: grey;'";



					}
				else
					{
					$libre="SIN CUBRIR";
					$color="style='background-color: red;'";
					
					}
				
						$url="vermovplaza.php?id=$row[plaza]";
						echo "<td align='center'><a href='vermovplaza.php?id=".$row['id']."' target='_blank''>".$row['plaza']."</a></td>";
						echo "<td nowrap><a href='vermovplaza.php?id=".$row['id']."' target='_blank'>".$row['nombre']."</td>";
						echo "<td align='center'>".$row['turno']."</td>";
						echo "<td align='center'>".$row['curso']."</td>";
						echo "<td align='center'>".$row['division']."</td>";
						echo "<td align='center'>".$row['codigo']."</td>";
						echo "<td align='center'>".$row['cant_hs']."</td>";
						if ($enlace==1) { echo "<td align='center'".$color." ><a href=leg_unif.php?actor=$dnidoc target='_blank'>".$libre."</a></td></tr>";}
						else { echo "<td align='center'".$color." >".$libre."</td></tr>";}
						
				

                              
            }	
?>	
	
	
	
	
	
	</table>
</div>






</form>
 </td>

</div>

</body>
<footer>
      <br><br><br>
	  <?	include 'footer.php';?>
    </footer>
</html>

<? } ?>