<?PHP
session_start();
if ($_SESSION['estado']==1) { 

//include 'conexion.php';
include 'conexioncalif.php';

		if(isset($_GET["curso"]))
		{
		$curso=$_GET["curso"];
		}
		else
		{
		$curso=$_POST['curso'];
		}
		
		echo $curso;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta charset="UTF-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="tablacalif.css" />

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Administrador de Alumnos</title>



</head>
<?
include 'header.php';
$conexion = conectarcalif ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
$resultmotivo = mysql_query ("SELECT * FROM motivo_dec"); 

//$curso=$_GET["curso"];
/*$anoz=$_GET[ano];
$cursoz=$_GET[curso];
$pasez=$_GET[pase];
$fechaz=$_GET[fecha];*/

?>

<body background="bgris.gif" >




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
<tr><td><p align="center"><h2>Administrar orden de las materias para calificador.</h2></p></td></tr>
</table>
</div></div>

	<div align="center">		
	<?PHP
	echo "<form method='POST' action=" . $_SERVER['PHP_SELF'] . " >	";
		echo "<br><br>";
				$result79 = mysql_query ("SELECT DISTINCT c.idcurso,c.descripcion FROM curso2 c,calificador cc WHERE c.habilitado='1' AND c.idcurso=cc.curso order by c.descripcion ASC,c.curso ASC,c.division ASC");
								
				
				echo "<select name=curso>";
					while ($fila79 = mysql_fetch_array($result79))
					{ 	
						if (isset($_POST['curso']) && $_POST['curso']==$fila79['idcurso'])
						{echo "<option value=".$fila79['idcurso']." selected>".$fila79['descripcion']."</option>\n";}
						else
						{echo "<option value=".$fila79['idcurso'].">".$fila79['descripcion']."</option>\n";}
						
					}	
					
				echo "</select>";
		echo "<br>";
		
			
			
			echo "<input type='submit' value='Ver' name='submitcurso' />";
			echo "<br><br>";
	echo "</form>";
			

	echo "</div>";

	if(isset($_POST["submitcurso"]))
	{
		//$curso=$_POST['curso'];
		$sqlcurso = "SELECT * FROM curso2 WHERE idcurso='$curso' AND habilitado='1'";
		
		$resultcurso = mysql_query ($sqlcurso);
		$curdesc = mysql_fetch_array($resultcurso);
		$cursod=$curdesc['descripcion'];
		//MOSTRAMOS INFO DEL CURSO
		
		
		echo "<br><br>";
		
		echo "<form method='POST' action='ordenmat.php?curso=$curso' >	";
			echo "<div align='center'>";
				echo "<table border=3 id='customers' style='width:50%;'>";
					echo "<tr>";
						echo "<td colspan='2' align='center'><h1>".$cursod."</h1></td>";
					echo "</tr>";
					
					echo "<tr>";
						echo "<td style='width:25%;'><h3>Orden</h3></td>";
						echo "<td><h3>Materia</h3></td>";
					echo "</tr>";
			
			for ($i=1;$i<=15;$i++)
			{		//echo $i;
					echo "<tr>";
						echo "<td align='center'>".$i."</td>";
						echo "<td align='center'>";
							$sqlmat="SELECT * FROM matcur mc,materias m WHERE mc.idcurso='$curso' AND mc.idmateria=m.idmateria";
							//echo $sqlmat;
							$resultmat = mysql_query ($sqlmat);
							//echo $sqlmat;
							echo "<select name='asigna[".$i."]'>";				
															
								while ($mat = mysql_fetch_array($resultmat))
								{	
									
									//$cons="SELECT * FROM ordenmat o, materias m WHERE m.idmateria=o.materia AND o.curso='$curso' AND o.materia='$mat[idmateria]' and o.orden='$i'";
									$cons="SELECT * FROM ordenmat o, materias m WHERE m.idmateria=o.materia AND o.curso='$curso' AND o.orden='$i'";
									$consulta=mysql_query($cons);
									$materiaseleccionada = mysql_fetch_array($consulta);
									$elegido = mysql_num_rows($consulta);
									//echo $elegido;
									if ($materiaseleccionada['idmateria']==$mat['idmateria'])
									{
									echo "<option selected value=".$mat['idmateria'].">".$mat['descripcion']."</option>";
									}
									else 
									{
									echo "<option value=".$mat['idmateria'].">".$mat['descripcion']."</option>";
									}
								}
							echo "</select>";
									//echo $cons;
							
						echo "</td>";
						
					echo "</tr>";
			}//FIN FOR
			echo "<input name='cur' type='hidden' value=$curso />";
			echo "<tr><td colspan=2 align='center'>";
			echo "<input type='submit' value='Grabar' name='submitcurso' />";
			echo "</td></tr>";
		


				echo "</table>";
			echo "</form>";
			echo "</div>";
	
		if(isset($_GET["curso"])) //SUBMIT ORDEN
		{	
					/*$sqlcurx="SELECT DISTINCT idcurso FROM curso2 WHERE habilitado='1' ORDER BY idcurso ASC";
					$resultcurx = mysql_query ($sqlcurx);
					//$i=1;
					while ($curx = mysql_fetch_array($resultcurx))
					{	
						for ($i=1;$i<=15;$i++)
						{
							$sql="INSERT IGNORE INTO ordenmat VALUES ('$curx[idcurso]','65','$i');";
							echo $sql."<br>";
							//$i++;	
						}
					}*/
						$i=1;
						foreach ($_POST['asigna'] as $d) 
						{
							$sql="UPDATE ordenmat SET materia='$d' WHERE curso='$_GET[curso]' AND orden='$i'";
							mysql_query($sql);
							echo $sql.";<br>";
							$i++;
						}	
		
			/*?>
				<meta http-equiv='refresh' content='0; URL=ordenmat.php?curso=<?$_GET[curso];?>'>

				<? 	*/
		}
		
	}// FIN SUBMIT CURSO 
	
	
				
	
} 