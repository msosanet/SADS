<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

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
$materia=$_GET['materia'];
$rr = mysql_query ("SELECT * FROM materia where codigo=$materia");
$rr = mysql_fetch_array($rr);


$resulturno = mysql_query ("SELECT * FROM turno where codigo=$rr[turno]");
$turno = mysql_fetch_array($resulturno);

$resultplan = mysql_query ("SELECT * FROM plan where codigo=$rr[plan]");
$plan = mysql_fetch_array($resultplan);


$errordoc = 0;
  $hayerrores = 0;



  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos




}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="ahc.php?curso=<?php echo $materia?>">

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
					<p align="left" class="text1b">Cargar HS de <?echo $rr['nombre']; ?></p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nombre:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<?echo $rr['nombre']; ?>
							</td>
					
							

							<td width="190" bgcolor="#EAEAEA" align="right">Turno:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<?echo $turno['descripcion']; ?>
							</td>
							
						</tr>

						
							

								<td width="74" bgcolor="#EAEAEA" align="right">Curso:</td>
							
							<td bgcolor="#EAEAEA" width="425" align="left">

							<?echo $rr['curso']; ?>
							</td>												

							

								<td width="74" bgcolor="#EAEAEA" align="right">Div:</td>
						
							<td bgcolor="#EAEAEA" width="425" align="left">

							<?echo $rr['divi']; ?>
							</td>


						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">
							Hs consume:</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><?echo $rr['hs_consume']; ?></td>
							</td>
							
					
		

							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">
							C&oacute;digo:</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><?echo $rr['codigo_cargo']; ?></td>
							</td>
							
						</tr>

						<tr>

							<td width="174" bgcolor="#EAEAEA" align="right"></td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							</td>
					
							

							<td width="190" bgcolor="#EAEAEA" align="right">Plan:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<?echo $plan['descripcion']; ?>
							</td>
							
						</tr>


		
						<tr>
							
						</tr>

						</table>


<br><br>

<div align="center">
					
					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Horarios</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Lunes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Martes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Miercoles</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Jueves</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Viernes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Sabado</b></td>
	</tr>
	<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>Turno Ma�ana</b></font></td>
	</tr>	
<?php 		$turno='M';
		$result77 = mysql_query ("SELECT * FROM horas where turno='M' order by desde");
		while ($fila77 = mysql_fetch_array($result77))
		{ 
		?>
	<tr>
			<td bgcolor="#EAEAEA" align="center"><? echo $fila77[desde]; ?> a <? echo $fila77[hasta]; ?></td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="ml[]" value="<?php echo $fila77['codigo']?>"> </td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="mm[]" value="<?php echo $fila77['codigo']?>"> </td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="mmi[]" value="<?php echo $fila77['codigo']?>"> </td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="mj[]" value="<?php echo $fila77['codigo']?>"> </td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="mv[]" value="<?php echo $fila77['codigo']?>"> </td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="ms[]" value="<?php echo $fila77['codigo']?>"> </td>
		
	</tr><?}?>



</table>
<br>
<div align="center">
					
					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Horarios</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Lunes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Martes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Miercoles</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Jueves</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Viernes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Sabado</b></td>
	</tr>
	<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>Turno Tarde</b></font></td>
	</tr>	
<?php 		$turno='M';
		$result78 = mysql_query ("SELECT * FROM horas where turno='T' order by desde");
		while ($fila78 = mysql_fetch_array($result78))
		{ 
		?>
	<tr>
			<td bgcolor="#EAEAEA" align="center"><? echo $fila78[desde]; ?> a <? echo $fila78[hasta]; ?></td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="tl[]" value="<?php echo $fila78['codigo']?>"> </td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="tm[]" value="<?php echo $fila78['codigo']?>"> </td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="tmi[]" value="<?php echo $fila78['codigo']?>"> </td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="tj[]" value="<?php echo $fila78['codigo']?>"> </td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="tv[]" value="<?php echo $fila78['codigo']?>"> </td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="ts[]" value="<?php echo $fila78['codigo']?>"> </td>
		
	</tr><?}?>


</table>
<br>
					
<div align="center">
					
					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Horarios</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Lunes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Martes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Miercoles</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Jueves</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Viernes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Sabado</b></td>
	</tr>
	<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>Turno Vespertino</b></font></td>
	</tr>	
<?php 		$turno='M';
		$result79 = mysql_query ("SELECT * FROM horas where turno='V' order by desde");
		while ($fila79 = mysql_fetch_array($result79))
		{ 
		?>
	<tr>
			<td bgcolor="#EAEAEA" align="center"><? echo $fila79[desde]; ?> a <? echo $fila79[hasta]; ?></td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="vl[]" value="<?php echo $fila79['codigo']?>"> </td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="vm[]" value="<?php echo $fila79['codigo']?>"> </td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="vmi[]" value="<?php echo $fila79['codigo']?>"> </td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="vj[]" value="<?php echo $fila79['codigo']?>"> </td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="vv[]" value="<?php echo $fila79['codigo']?>"> </td>
			<td bgcolor="#EAEAEA" align="center"><input type="checkbox" name="vs[]" value="<?php echo $fila79['codigo']?>"> </td>
		
	</tr><?}?>

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
<input name="materia" type="hidden" value ="<?php echo $_GET['materia'] ?>"/>
	</form>
</div>
</body>
<?
}
else
{



if (1)
	{

printf("codigo:".$_GET['materia']);
$codi=$materia;
$baja="0000-00-00";


//------------------------------grabo ma�ana-----------------------------------------------------
foreach ($_POST["ml"] as $ml)
	{

		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,1,'$ml','$baja')"))
		{	
	
		}

	}
foreach ($_POST["mm"] as $mm)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,2,'$mm','$baja')"))
		{	
				
		}
	}
foreach ($_POST["mmi"] as $mmi)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,3,'$mmi','$baja')"))
		{	
				
		}
	}
foreach ($_POST["mj"] as $mj)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,4,'$mj','$baja')"))
		{	
				
		}
	}
foreach ($_POST["mv"] as $mv)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,5,'$mv','$baja')"))
		{	
				
		}
	}
foreach ($_POST["ms"] as $ms)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,6,'$ms','$baja')"))
		{	
				
		}
	}


//------------------------------grabo tarde-----------------------------------------------------
foreach ($_POST["tl"] as $tl)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,1,'$tl','$baja')"))
		{	
				
		}
	}
foreach ($_POST["tm"] as $tm)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,2,'$tm','$baja')"))
		{	
				
		}
	}
foreach ($_POST["tmi"] as $tmi)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,3,'$tmi','$baja')"))
		{	
				
		}
	}
foreach ($_POST["tj"] as $tj)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,4,'$tj','$baja')"))
		{	
				
		}
	}
foreach ($_POST["tv"] as $tv)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,5,'$tv','$baja')"))
		{	
				
		}
	}
foreach ($_POST["ts"] as $ts)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,6,'$ts','$baja')"))
		{	
				
		}
	}
//------------------------------grabo vespertino-----------------------------------------------------
foreach ($_POST["vl"] as $vl)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,1,'$vl','$baja')"))
		{	
				
		}
	}
foreach ($_POST["vm"] as $vm)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,2,'$vm','$baja')"))
		{	
				
		}
	}
foreach ($_POST["vmi"] as $vmi)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,3,'$vmi','$baja')"))
		{	
				
		}
	}
foreach ($_POST["vj"] as $vj)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,4,'$vj','$baja')"))
		{	
				
		}
	}
foreach ($_POST["vv"] as $vv)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,5,'$vv','$baja')"))
		{	
				
		}
	}
foreach ($_POST["vs"] as $vs)
	{
		if (mysql_query ("INSERT INTO materia_horario VALUES (0,$codi,6,'$vs','$baja')"))
		{	
				
		}
	}






		

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=curso_consul.php?descripcion=<?php $rr[curso]?>&descripcion2=<?php $rr[divi] ?>&descripcion3=<?php $rr[turno] ?>&descripcion4=<?php $rr[plan] ?>&muestra2=+++Buscar+++?'>
				<? 			
	}
	else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 
		}
}
			


?>
</html>
<? } ?>