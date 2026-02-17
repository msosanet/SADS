<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion3.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="tablacalif.css" />
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
<?			
				//CARGA O MODIFICACION DE MATERIAS
	if(isset($_GET["nuevo"]) OR isset($_GET["id"]) )
		{
			if (isset($_GET["id"]))
			{
			$id=$_GET[id];
			$sqlmat="SELECT * FROM materias WHERE idmateria='$id' ORDER BY descripcion ASC";
			$resultmat = mysql_query ($sqlmat);
			$mat = mysql_fetch_array($resultmat);
			}
			else
			{$id=0;			}
		?>	
		<br><br><br>
		<table border="3" id='customers' style="width:50%">
			<form method='POST' action='gestionmaterias.php'>
			<tr>
				<td width="190" bgcolor="#EAEAEA" align="right">Descripcion:</td>
				<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="descripcion" size="50" maxlength="50" value="<?echo $mat[descripcion]; ?>" /></td>
				<td width="190" bgcolor="#EAEAEA" align="right">Abreviatura:</td>
				<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="abrev" size="25" maxlength="25" value="<?echo $mat[abrev]; ?>" /></td>
				<td bgcolor="#EAEAEA" width="265" align="center"><input type='submit' value='Guardar' name='submitmateria' /></td>
			</tr>
		<input name="tipo" type="hidden" value ="<?php echo $id; ?>"/>
		</table>
			</FORM>
		<?
		}

	if(isset($_POST["submitmateria"]))//actualiza o agrega
		{
			$descripcion=$_POST['descripcion'];
			$abrev=$_POST['abrev'];
			$tipo=$_POST['tipo'];
			if ($tipo!=0)
			{$sql="UPDATE materias SET descripcion='descripcion',abrev='$abrev' WHERE idmateria='$tipo'"; }
			else
			{$sql="INSERT INTO materias VALUES ('','$descripcion','$abrev')";}
		
			if (mysql_query ($sql))
				{
					?>
				<script>
				var answer=alert("Materia Guardada")
				</script> 
				<meta http-equiv='refresh' content='0; URL=gestionmaterias.php'>
					<? 
				}
		}

//-------------------------------------tabla de datos---------------------------------------------
?>		
			<br><br><br>
			<div align="center">
				
				<table border="3" id='customers' style="width:50%">

					<tr>
						<td align="center" colspan=4><h1>Materias</h1></td>
					</tr>
					<tr>
						<td align="center" colspan=4><h2><a href="gestionmaterias.php?nuevo=0">+</a></h2></td>
					</tr>
					<tr>
						<td align="center">Materia</td>
						<td align="center">Abrev.</td>
						<td align="center">Cursos</td>
						<td align="center">Acciones</td>
					</tr>


				
<?			
					$sqlmat="SELECT * FROM materias ORDER BY descripcion ASC";
					$resultmat = mysql_query ($sqlmat);
					while ($mat = mysql_fetch_array($resultmat))
						{	echo "<tr>";
							echo "<td bgcolor='$colormat'style='padding: 10px;  text-align: center;'><span title=''>".$mat[descripcion]."</span></td>";
							echo "<td bgcolor='$colormat'style='padding: 10px;  text-align: center;'><span title=''>".$mat[abrev]."</span></td>";
							echo "<td bgcolor='$colormat'style='padding: 10px;  text-align: center;'><span title=''>";
								$sqlcur="SELECT DISTINCT idcurso FROM matcur WHERE idmateria='$mat[idmateria]'";
								$resultcur = mysql_query ($sqlcur);
								while ($cur = mysql_fetch_array($resultcur))
									{echo " ".$cur[idcurso]." " ;}
							echo "</span></td>";
							echo "<td></td>";
							echo "</tr>";
						}
			
?>			
				</table>
			</div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			

			</td>
		</tr>
	</table>
</div>




 </td>

</div>
<br><br><br>
<?
			include 'footer.php';
			?>
</body>

</html>
<? } ?>