<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="tablacalif.css" />

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Administrador del SID</title>

<style>
    select {
        width: 150px;
        margin: 10px;
    }
    select:focus {
        min-width: 150px;
        width: 300px;
    }
</style>


</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
//$divx=$_GET['div'];
$cursox=$_GET['curso'];
//$turnox=$_GET['turno'];

		$cons="SELECT * FROM curso3 WHERE idcurso='$cursox'";
		$qcurso = mysql_query ($cons);
		$totalc = mysql_fetch_array($qcurso);
		$descurso=$totalc['descripcion'];
		$cur = $totalc['curso'];
		$div= $totalc['division'];
		$turnox=$totalc['turno'];

//echo $cur." ".$div." ".$turnox;

?>

<body background="bgris.gif" >


<form method="GET" action="ORIGINAL2.php">

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

//$resultplazas = mysql_query ("SELECT * FROM materia_cargo ORDER BY nombre DESC");

		//necesitamos saber la tabla de cursos para ver si tiene el turno asignado para completar la consulta
		
		
		$cons=("SELECT COUNT(hora) as total FROM horax2 where turno='$turnox'");
		$qhoras = mysql_query ($cons);
		$totalh = mysql_fetch_array($qhoras);
		$q = $totalh['total'];
		//echo $q;

		



?>	
</table>
</div>
			
			</td>
		</tr>
	</table>
</div>
	<br><div align='center'><h2>HORARIO DEL CURSO <?php echo $descurso;?></h2></div><br>
		<div align='center'>
		<table border="3" width="980">
			<tr>
				<td bgcolor="#EAEAEA" align="center"><b>Hora</b></td>
				<td bgcolor="#EAEAEA" align="center"><b>Lunes</b></td>
				<td bgcolor="#EAEAEA" align="center"><b>Martes</b></td>
				<td bgcolor="#EAEAEA" align="center"><b>Miercoles</b></td>
				<td bgcolor="#EAEAEA" align="center"><b>Jueves</b></td>
				<td bgcolor="#EAEAEA" align="center"><b>Viernes</b></td>
			</tr>
		
		<?
		for($hora=1;$hora<=$q;$hora++)
			{//echo $hora;		
			echo "<tr>";
				$cons=("SELECT * FROM horax2 where turno='$turnox' AND hora='$hora'");
				//echo $cons;
				$hor = mysql_query ("$cons");
				$hor = mysql_fetch_array($hor);
				$desde = $hor['desde'];
				$hasta = $hor['hasta'];
				$horax=$desde."-".$hasta;
					
					echo "<td bgcolor='#EAEAEA' align='center'><b>".$horax."</b></td>";
					for($dia=1;$dia<=5;$dia++)
						{ 	
						echo "<td bgcolor='#EAEAEA' align='center'>";
						$mat="SELECT * FROM materia_cargo WHERE curso='$cur' AND division='$div' AND nombre!='EducaciÃ³n FÃ­sica' AND codigo='852' ORDER BY nombre ASC";
						$result79 = mysql_query ($mat);
						echo "<select name='".$hora."[".$dia."]' style=width: 50px;>";
						
						$flagm=0;
						while ($fila79 = mysql_fetch_array($result79))
						{ 	
							$materia=$fila79['id']; 
							$matcur="SELECT * FROM horariox2 WHERE idcurso='$cursox' AND dia='$dia' AND hora='$hora'";
							
							$consulta=mysql_query($matcur);
							$mate=mysql_fetch_array($consulta);
							
							//$elegido = mysql_num_rows($consulta);
									
									if ($mate['idmateria']=='0' && $flagm=='0')
									{
									echo "<option value='0' selected>VACIO</option>";									
									$flagm=1;
									}
									
									
										if (($fila79['id']==$mate['idmateria']) )
										{
											echo "<option value=".$fila79['id']." selected>".$fila79['nombre']."</option>";											
										}
										else 
										{
											echo "<option value=".$fila79['id'].">".$fila79['nombre']."</option>";
										}
								
									
									
						}
						echo "<option value='0'>VACIO</option>";
						echo "</select>";
						echo "</td>";
						}	
			echo "<tr>";
			
			}
		?>
		
						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #ff0000; font-weight:700; float:center" /></td>
						</tr>
					</table>
		</div>
<input name="curso" type="hidden" value ="<?php echo $cur.$div ?>"/>
<input name="cant" type="hidden" value ="<?php echo $q ?>"/>








</form>




</body>

</html>

<?
 if (isset($_GET["submitx"])) {
     
		$curso=$_GET['curso'];
		//echo "Curso:".$curso;

		$cons="SELECT * FROM curso3 c2, horax2 h WHERE c2.idcurso='$curso' AND c2.turno=h.turno ";
		$qcurso = mysql_query ($cons);
		
		//CANTIDAD DE HORAS CATEDRA DEL CURSO (PARA RECORRER LA TABLA)
		$qh = mysql_num_rows($qcurso);
		
		for($dia=1;$dia<=5;$dia++)
			{
			for($hora=1;$hora<=$qh;$hora++)
				{ 
					 $cual[$hora]=$_GET[$hora][$dia];
					
					$consulta=mysql_query("SELECT * FROM horariox2 WHERE idcurso='$curso' AND dia='$dia' AND hora='$hora'");
					$actualiza = mysql_num_rows($consulta);
					//echo $actualiza;

					//INSERTA O ACTUALIZA LOS HORARIOS
					if ($actualiza=='0')
					{
						$sql = "INSERT INTO horariox2 VALUES ('$curso','$dia','$hora',$cual[$hora])";
						mysql_query($sql);
					}
					else
					{	
						$sql = "UPDATE horariox2 SET idmateria='$cual[$hora]' WHERE idcurso='$curso' AND dia='$dia' AND hora='$hora'";
						mysql_query($sql);

					}
				//echo $sql;
				}


			}
	?>
				<script>
				var answer=alert("Guardado")
				</script> 
				<meta http-equiv='refresh' content='0; URL=ORIGINAL2.php?curso=<?php echo $curso ?>'>
	<?


}
}


