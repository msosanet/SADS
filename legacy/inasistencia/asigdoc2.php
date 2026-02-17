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
<link rel="stylesheet" type="text/css" href="style.css" />
<title>SIDOS</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>
<?
include 'header.php';

 if (isset($_GET["submitx"])) 
{
 // verifico los errores en los campos
$conexion = conectar ();
$curso=$_GET['curso'];

$i=0;
foreach ($_GET['asigna'] as $d) 
	{	$es=$_GET['matmat'];
		$mate=$es[$i];
		$sql = "UPDATE matcur SET iddocente='$d' WHERE idmateria='$mate' AND idcurso='$curso'";
		$i++;
		mysql_query($sql);
	}

}












?>
<body >

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
$materia=$_GET['materia'];
$cursox=$_GET['curso'];
//echo $cursox;

$rr = mysql_query ("SELECT * FROM curso2 where idcurso='$cursox'");
$rr = mysql_fetch_array($rr);

$cursillo=$rr['descripcion'];

$cursotext = mysql_query ("SELECT * FROM materiax where curso='$cursillo'");
$cursotext = mysql_fetch_array($resulturno);





?>

<form method="GET" action="asigdoc.php">

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
					<p align="left" class="text1b">Asignar Docentes a:  <?echo $rr['descripcion']; ?></p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<br><br>
  
 <div align="center">
					
					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
		
	<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Materia</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Docente</b></td>
		
		
	</tr>
	
<?php 		
		
			//echo "<td bgcolor='#EAEAEA' align='center'>";
			
			$result79 = mysql_query ("SELECT m.descripcion,mc.idcurso,mc.idmateria,mc.iddocente FROM matcur mc, materias m WHERE mc.idmateria=m.idmateria AND mc.idcurso='$cursox' AND mc.idmateria!=65");
			
				while ($fila79 = mysql_fetch_array($result79))
				{ echo "<tr>";	
					$descri=$fila79['descripcion'];
					$materia=$fila79['idmateria'];
					$docente=$fila79['iddocente'];
					echo "<td bgcolor='#EAEAEA' align='center'><b>".$descri."</b></td>";
					echo "<td bgcolor='#EAEAEA' align='center'>";
					//que materia
					echo "<input name='matmat[]' type='hidden' value=$materia />";

					echo "<select name='asigna[".$materia."]' onchange='this.style.backgroundColor=\"tomato\"'>";				
							$listdocentex=mysql_query("SELECT DISTINCT (dni), CONCAT(apellido,  ' ', nombre) as nombredoc FROM docente WHERE identificacion='1' ORDER BY nombredoc ASC");
							
							while ($listdocentes = mysql_fetch_array($listdocentex))
							{	$docdoc=$listdocentes['dni'];
								$consulta=mysql_query("SELECT * FROM matcur where idcurso='$cursox' AND idmateria='$materia'");
								$elegido = mysql_num_rows($consulta);
								
								while ($consultax = mysql_fetch_array($consulta))
								{
									if ($listdocentes['dni']==$consultax['iddocente'])
									{
									echo "<option selected value=".$listdocentes['dni'].">".$listdocentes['nombredoc']."</option>";
									}
									else 
									{
									echo "<option value=".$listdocentes['dni'].">".$listdocentes['nombredoc']."</option>";
									}
								}
							}
					echo "</select>";
					echo "</td>";
					echo "</td>";
				
			
			//echo "</td>";
			echo "</tr>";
		}
		 }
		 //echo "</tr>";
		
		
	?>		


<input name="curso" type="hidden" value ="<?php echo $_GET['curso'] ?>"/>


						
						<tr>
							<td width="895" height="100" bgcolor="#EAEAEA" align="center" colspan="7">
							<br>
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #ff0000; font-weight:1000; float:center width:500px; height:125px; " /></td>
				
						</tr>
							
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							<br><br>
							<a href="ORIGINALV.php?curso=<?php echo $_GET['curso'] ?>&submitcurso=Grabar">Ver Horario del Curso</a>
							<p align="center">&nbsp;</td>
						
						</tr>
						
						
						
						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							<br><br>
							<a href="http://docentes.colegiosobral.edu.ar/selcursodoc.php">Volver</a>
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


  
  
  
  
  ?>


</html>
