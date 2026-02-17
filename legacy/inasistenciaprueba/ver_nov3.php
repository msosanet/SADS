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
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

<link rel="shortcut icon" href="../imag/favicon.ico">
<title></title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;



    function invertirFecha( $fechaz ){
      return implode( "-", array_reverse( preg_split( "/\D/", $fechaz ) ) );
    }


?>

<body background="bgris.gif" >


<?
	$errordoc = 0;
	$hayerrores = 0;

  $flag = 0;
  if (isset($_GET["submitx"])) {
    

	
}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {



?>



<form method="GET" action="ver_nov3.php">

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
				<tr>
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Listado de novedades de tomas docentes</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
	
					</div>
					<p align="center">

					</p>
					<p align="center">&nbsp;</p>

					<p align="left">
</font>
 
<?






	$_pagi_sql="SELECT * FROM novedades2,docentes where novedades2.docente = docentes.dni and borrado=1 order by fecha1 DESC,docente";



$_pagi_cuantos=20000;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><?
echo"$_pagi_navegacion"; 
?>
<br><br>
</p><?

		?> <table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="8" height="40" align="left">
							&nbsp;Resultado del Filtro</td>
						</tr>
						<tr>
							<td bgcolor="#808080" width="20" align="center" height="36">Id</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Docente</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Materia</td>
							<td bgcolor="#808080" width="80" align="center"  height="36">Curso / Div</td>
							<td bgcolor="#808080" width="20" align="center"  height="36">Fecha de carga</td>
							<td bgcolor="#808080" width="20" align="center"  height="36">Fecha de comienzo</td>
							<td bgcolor="#808080" width="20" align="center"  height="36">Hora de carga</td>
							<td bgcolor="#808080" width="40" align="center"  height="36">Notific&oacute;</td>
								

							
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{	


		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[id];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[apellido];?>, <?echo $fila2[nombre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[materia];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[curso];?>°<?echo $fila2[div];?>ª</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo invertirFecha($fila2[fecha1]);?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo invertirFecha($fila2[fecha2]);?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[hora];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[grabo];?></td>						

					
														
						</tr>
						<?
						}
						?>
					<tr>
						<td align="center" width="752" colspan="9">
						<p align="left" style="margin-top: 0; margin-bottom: 0">&nbsp;</td>
					</tr>
						</table>
				<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
				<table border="0" width="100%" id="table10" cellspacing="0" cellpadding="0">
					<tr>
						<td>
						</table>
				<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
			</div>
					<hr>
					</td>
				</tr>
				<?
include 'footer.php';
?>
			</table>
			</div>
		</tr>
<input name="actor" type="hidden" value ="<?php echo $dni ?>"/>
	</table>
	</form>
</div>
</body>
<?
}
else
{

}

?>


</html>
<? } ?>



