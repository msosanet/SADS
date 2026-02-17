<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion3.php';

//esto pasa las mayusculas acentuadas a minusculas acentuadas
function strtolowerExtended($str)
{
        $low = array(chr(193) => chr(225), //á
                    chr(201) => chr(233), //é
                    chr(205) => chr(237), //í­
                   chr(211) => chr(243), //ó
                   chr(218) => chr(250), //ú
                  chr(220) => chr(252), //ü
                    chr(209) => chr(241)  //ñ
                    );
 
      return strtolower(strtr($str,$low)); 
} 


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
<title>SIDOS</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>
<?
include 'header.php';

 if (isset($_GET["submitx"])) {
     // verifico los errores en los campos
$conexion = conectar ();
$curso=$_GET['curso'];
echo "Curso: ".$curso;
//BORRO LAS MATERIAS EN MATCUR QUE NO ESTEN EN HORARIOS PARA QUE DESAPAREZCAN EN LA ASIGNACION DEL DOCENTE

$sql2 = ("DELETE FROM matcurVIRTUAL  WHERE idmateria NOT IN (SELECT h.idmateria FROM horarioxVIRTUAL h WHERE h.idcurso=$curso) AND idcurso=$curso");
//echo $sql2;
mysql_query($sql2);

//for($hora=1;$hora<10;$hora++)
for($dia=1;$dia<6;$dia++)
	{
		for($hora=0;$hora<=10;$hora++)
			//for($dia=1;$dia<7;$dia++)
			{ 
			$cual[$hora]=$_GET[$hora][$dia];
			
			
//if 	($cual[$hora]!='65')		
//{	
$consulta=mysql_query("SELECT * FROM horarioxVIRTUAL WHERE idcurso=$curso AND dia=$dia AND hora=$hora");
//echo "SELECT COUNT(*) FROM horarioxVIRTUAL WHERE idcurso=$curso AND dia=$dia AND hora=$hora";
$actualiza = mysql_num_rows($consulta);
echo $actualiza;

//INSERTA O ACTUALIZA LOS HORARIOS
if ($actualiza=='0')
{
	
$sql = "INSERT INTO horarioxVIRTUAL VALUES ('$curso','$dia','$hora',$cual[$hora])";
echo $sql;
mysql_query($sql);
}

if ($actualiza=='1')
{	
$sql = "UPDATE horarioxVIRTUAL SET idmateria='$cual[$hora]' WHERE idcurso='$curso' AND dia='$dia' AND hora='$hora'";
//echo $sql;
mysql_query($sql);

}



$matx=$cual[$hora];
$consultax=mysql_query("SELECT * FROM matcurVIRTUAL where idcurso=$curso AND idmateria=$matx");
$actualizax = mysql_num_rows($consultax);


if ($actualizax==0)
{
	
$sql = "INSERT INTO matcurVIRTUAL VALUES ($curso,$matx,0)";
mysql_query($sql);

}

//}
}
	
	
	

	}






//BORRA LAS MATERIAS QUE TIENEN ASIGNADO UN PROFESOR Y YA NO PERTENECEN AL CURSO PORQUE EN EL HORARIO SE MODIFICO.
$sql = "DELETE mc FROM matcurVIRTUAL mc WHERE NOT EXISTS (SELECT H.idmateria FROM horarioxVIRTUAL H WHERE H.idcurso=$curso) AND mc.idcurso=$curso";
//echo $sql;
mysql_query($sql);

}




?>
<body background="bgris.gif" >

<p>


<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo6 {
	font-size: 16px;
	font-weight: bold;
}
.Estilo7 {font-size: 16px; font-weight: bold; color: #FF0000; }
-->
</style>

<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
//$materia=$_GET['materia'];
$cursox=$_GET['curso'];
//echo $cursox;

$rr = mysql_query ("SELECT * FROM curso2 where idcurso=$cursox");
$rr = mysql_fetch_array($rr);


$cursillo=$rr['descripcion'];
$turno=$rr['turno'];
/*$cursotext = mysql_query ("SELECT * FROM materiax where curso=$cursillo");
$cursotext = mysql_fetch_array($resulturno);*/





?>

<form method="GET" action="ORIGINALVIRTUAL.php">

</p>
<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
				<table border="0" width="980" cellspacing="0" cellpadding="0">
					<tr>
						
					</tr>
				</table>
				
				<p></div>
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

<tr>
				

					<td>
					<br>
					<p align="left" class="text1b">Horario de  <?echo $rr['descripcion']; ?></p><br>
					<div align="left">
					
					<div align="center">
					
					<br><br>
  
 <div align="center">
					
					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>HORARIO PARA EL CURSO</b></font></td>
	</tr>	
	<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Hora</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Lunes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Martes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Miercoles</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Jueves</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Viernes</b></td>
		
	</tr>
	
<?php 		
		$hora='0';
		for($hora=0;$hora<=10;$hora++)
		
		{
				
		echo "<tr>";
		
		$cons=("SELECT * FROM horax where turno='$turno' AND hora='$hora'");
		$hor = mysql_query ("$cons");
		$hor = mysql_fetch_array($hor);
		$desde = $hor['desde'];
		$hasta = $hor['hasta'];
		//echo $desde;
		//echo $hasta;
		$horax=$desde."-".$hasta;
		//echo $horax;
		/*if ($hora==0)
		{echo "<td bgcolor='#EAEAEA' align='center'><b>Pre-hora</b></td>";}
		else 
		{}*/
		echo "<td bgcolor='#EAEAEA' align='center'><b>".$horax."</b></td>";
		
		//echo "<td bgcolor='#EAEAEA' align='center'><b>".$hora."</b></td>";
		for($dia=1;$dia<6;$dia++)
		{ 	
			echo "<td bgcolor='#EAEAEA' align='center'>";
			
			$result79 = mysql_query ("SELECT * FROM materias ORDER BY descripcion DESC");
			echo $dia."[".$hora."]";
			
			echo "<select name='".$hora."[".$dia."]'>";
				while ($fila79 = mysql_fetch_array($result79))
				{ 	$horita=$fila79['idmateria'];
					//echo $horita;
					//echo $cursillo;
					//echo $cursox;
					$consulta=mysql_query("SELECT * FROM horarioxVIRTUAL where idcurso=$cursox AND idmateria=$horita AND dia=$dia AND hora=$hora");
					$elegido = mysql_num_rows($consulta);
					//echo $consulta;
					//echo $elegido;
									
					 	
							if ($elegido!='0')
							{
							echo "<option selected value=".$fila79['idmateria'].">".$fila79['descripcion']."</option>";
							}
							else 
							{
							echo "<option value=".$fila79['idmateria'].">".$fila79['descripcion']."</option>";
							}
							
				}
			echo "</select>";
			echo "</td>";
			
		 }
		 echo "</tr>";
		}
		
	?>		


<input name="curso" type="hidden" value ="<?php echo $_GET['curso'] ?>"/>
<input name="division" type="hidden" value ="<?php echo $_GET['division'] ?>"/>

						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							<p align="center">&nbsp;</td>
						</tr>

						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #ff0000; font-weight:700; float:center" /></td>
						</tr>
						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							<br><br>
							<a href="selcurso.php">Volver</a>
							<p align="center">&nbsp;</td>
						
						</tr>

					</div>
					<p align="right">&nbsp;</div>
					<hr>
					</td>
				</tr>
				<?
include 'footer.php';
?>
			</table>
			</div>
		</tr>
	</table>


	</form>
</div>
</body>
<?
}

  
  
  
  
  ?>


</html>
