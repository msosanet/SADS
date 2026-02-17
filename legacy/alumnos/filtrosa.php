<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
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

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Administrador de Alumnos</title>



</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
$resultmotivo = mysql_query ("SELECT * FROM motivo_dec"); 

$anoz=$_GET[ano];
$cursoz=$_GET[curso];
$pasez=$_GET[pase];
$fechaz=$_GET[fecha];

?>

<body background="bgris.gif" >


<form method="GET" action="filtrosa.php">

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
<tr><td><p align="left">Filtros Alumnos.</p></td></tr>
</table>
</div></div>
				
				<p align="left">
					<table border="0" width="250" bgcolor="#FFFFFF">
						<tr><td><input type="checkbox" value="ano" name="ano" <? if (isset($anoz)){echo "checked";}?>/><label>A&ntilde;o Ingreso   </label>
							<td><input type="text" name="anox" <? ?> size="8" maxlength="4" value="<? echo $_GET[anox];?>" autofocus/></td></td>
						</tr>
						<tr>
							<td><input type="checkbox" value="fecha" name="fecha" <? if (isset($fechaz)){echo "checked";}?>/><label>Fecha Ingreso</label></td>
							<td><font color="<?echo $color;?>">Desde:</td>
							</font>
							<td>
								<td><input type="text" name="diad" size="2" maxlength="2" value="<?echo $_GET['diad']; ?>" /></td>
								<td><input type="text" name="md" size="2" maxlength="2" value="<?echo $_GET['md']; ?>" /></td>
								<td><input type="text" name="ad" size="4" maxlength="4" value="<?echo $_GET['ad']; ?>" /></td> 
							</td>
							<td><font color="<?echo $color;?>">Hasta:</td></font>
							<td>
								<td><input type="text" name="dh" size="2" maxlength="2" value="<?echo $_GET['dh']; ?>" /></td>
								<td><input type="text" name="mh" size="2" maxlength="2" value="<?echo $_GET['mh']; ?>" /></td>
								<td><input type="text" name="ah" size="4" maxlength="4" value="<?echo $_GET['ah']; ?>" /> </td>
							</td>
						</tr>


						
						<tr>
						<td>
						<input type="checkbox" value="curso" <? if (isset($cursoz)){echo "checked";}?> name="curso" /><label>Curso/Division</label>
						</td>
						<td>
						<?
						
						$result79 = mysql_query ("SELECT curso,divi FROM cursa WHERE control=1 GROUP BY curso,divi ORDER BY curso,divi ASC");
						echo "<select name=cursos>";
							
							while ($fila79 = mysql_fetch_array($result79))
							{ 	$cx=$fila79['curso']."|".$fila79['divi'];
								if ($_GET[cursos]==$cx)
									{echo "<option value=".$fila79['curso']."|".$fila79['divi']." selected>".$fila79['curso']."/".$fila79['divi']."</option>";}
								else
									{echo "<option value=".$fila79['curso']."|".$fila79['divi']." >".$fila79['curso']."/".$fila79['divi']."</option>";}
							}	
						echo "</select>";
						 ?></td>
						
						</tr>
						
						<tr><td><input type="submit" name="enviar" value="Ver" /></td></tr>

					</p>
					
					
				</table>


</form>




</body>

</html>
<? 
if (isset($_GET[enviar])) 
{ 
$curx=strtok($_GET['cursos'], '|');
$divx = substr($_GET['cursos'], strpos($_GET['cursos'], "|")+1);
//echo "curso $curx y division $divx";
	
	if (isset($_GET[ano])) 
	{ $ano=" AND YEAR(a.f_ingreso)=$_GET[anox]";
	  $ordena=" a.f_ingreso ASC,a.dni ASC";}
	else
	{$ano="";
	 }

	if (isset($_GET[fecha])) 
	{	if(isset($_GET[diad]) AND isset($_GET[md]) AND isset($_GET[ad]) AND isset($_GET[dh]) AND isset($_GET[mh]) AND isset($_GET[ah])) 
		{
			$fecha_desde=$_GET['ad']."-".$_GET['md']."-".$_GET['diad'];	
			$fecha_hasta=$_GET['ah']."-".$_GET['mh']."-".$_GET['dh'];
			$fecha=" AND a.f_ingreso BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
			$ordena=" a.f_ingreso ASC,a.dni ASC";
		}
	}
	else
	{$fecha="";
	 }
		
	if (isset($_GET[curso])) 
	{$curso=" AND c.curso=$curx AND c.divi=$divx";
	 $ordena="c.curso ASC,c.divi ASC";}
	else
	{$curso="";
	 }
	

	

$consulta="SELECT a.dni,a.apellido,a.nombre,c.curso,c.divi,c.fecha,a.f_ingreso FROM cursa c, alumno a WHERE c.alumno=a.dni AND c.control=1 ".$ano.$curso.$fecha." ORDER BY ".$ordena."";

//$consulta="SELECT * FROM alumno,pase where dni=alumno ORDER BY dni ASC";
$consultax = mysql_query ($consulta);
$cantidat=mysql_num_rows($consultax);
//echo $consulta;

//echo "HOLA";
?>

<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
	<tr>
		<td class="text1b" colspan="6" height="40" align="left">
		&nbsp;Resultado de la B&uacute;squeda <? echo $cantidat; ?></td>
	</tr>
	<tr bgcolor="#CCCCCC">
		<td width="20" align="center" height="36">DNI</td>
		<td width="200" align="center" height="36">Alumno</td>
		<td width="118" align="center"  height="36">Fecha Ingreso</td>
		<td width="118" align="center"  height="36">Curso|Division</td>
		
									
	</tr>


<? 
while ($fila2 = mysql_fetch_array($consultax)) 
{	
$fe = date("d-m-Y", strtotime($fila2[f_ingreso]));
?>
	<tr bgcolor="">
		<td width="20" align="center" height="36"><a href='alumno.php?dni=<? echo $fila2[dni]; ?>'><? echo $fila2[dni]; ?></a></td>
		<td width="200" align="center" height="36"><a href='alumno.php?dni=<? echo $fila2[dni]; ?>'><? echo $fila2[apellido]." ".$fila2[nombre]; ?></a></td>
		<td width="118" align="center"  height="36"><? echo $fe; ?></td>
		<td width="118" align="center"  height="36"><? echo $fila2[curso]." | ".$fila2[divi]; ?></td>
		
									
	</tr>
<?

}








?>
</table>
<?}} ?>