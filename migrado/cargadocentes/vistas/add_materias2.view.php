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
<title>SID</title>

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	cargar_paises();
	$("#pais").change(function(){dependencia_estado();});
	$("#estado").change(function(){dependencia_ciudad();});
	$("#estado").attr("disabled",true);
	$("#ciudad").attr("disabled",true);
});

function cargar_paises()
{
	$.get("scripts/cargar-paises.php", function(resultado){
		if(resultado == false)
		{
			alert("Error");
		}
		else
		{
			$('#pais').append(resultado);			
		}
	});	
}
function dependencia_estado()
{
	var code = $("#pais").val();
	$.get("scripts/dependencia-estado.php", { code: code },
		function(resultado)
		{
			if(resultado == false)
			{
				alert("Error");
			}
			else
			{
				$("#estado").attr("disabled",false);
				document.getElementById("estado").options.length=1;
				$('#estado').append(resultado);			
			}
		}

	);
}
function dependencia_ciudad()
{
	var code = $("#estado").val();
	$.get("scripts/dependencia-ciudades.php?", { code: code }, function(resultado){
		if(resultado == false)
		{
			alert("Error");
		}
		else
		{
			$("#ciudad").attr("disabled",false);
			document.getElementById("ciudad").options.length=1;
			$('#ciudad').append(resultado);			
		}
	});	
	
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
include 'conexion.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];



$dni = $_SESSION['docente']; 


$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente); 

$resultcurso = mysql_query ("SELECT * FROM curso2 order by descripcion"); 


$errordoc = 0;
  $hayerrores = 0;



  $flag = 0;
  if (isset($_POST["submitx"])) {


// controlo que el plan no sea 0 

	if ($_POST["pais"] == 0){ $errorplan = 1; $hayerrores = 1; };
	if (trim($_POST["estado"]) == ''){ $errorestado = 1; $hayerrores = 1; };
	if (trim($_POST["ciudad"]) == ''){ $errorciudad = 1; $hayerrores = 1; };





}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="add_materias2.php">
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
<?		
include 'menuppal2.php';

?>	
				<tr>
				

					<td>
					<br>
					<p align="left" class="text1b">Alta de Materias de: <?echo $filadocente[apellido];?>,&nbsp;<?echo $filadocente[nombre];?> </p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left"><br><br><? if($error) { echo "<h4><font color=red>Datos vacios o incompletos</font></h4>";} ?><br>
<b>Se deben cargar los siguiente datos la cantidad de veces por cada Materia que usted tenga. </b><br>

					<br><br>
		<?
	  		if ($errorplan==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
			<font color="<?echo $color;?>">Plan: </font><select size="1" id="pais" name="pais">
            		<option value="0">Selecciona un Plan</option>
			</select>
		<?
	  		if ($errorestado==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
			<font color="<?echo $color;?>">Curso: </font><select size="1" id="estado" name="estado">
            		<option value="0">Selecciona un Curso</option>
			</select>
		<?
	  		if ($errorciudad==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
			<font color="<?echo $color;?>">Materia que dicta: </font><select size="1" id="ciudad" name="ciudad">
            		<option value="0">Selecciona una materia</option>
			</select>
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
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>Turno Mañana</b></font></td>
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
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>

</table>


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
<input name="dni" type="hidden" value ="<?php echo $dni ?>"/>
	</form>
</div>
</body>
<?
}
else
{


	$plan=$_POST['pais'];
	$curso=$_POST['estado'];
	$materia=$_POST['ciudad'];

//------------------------------grabo mañana-----------------------------------------------------
foreach ($_POST["ml"] as $ml)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',1,'$ml','$curso',NOW())"))
		{	
				
		}
	}
foreach ($_POST["mm"] as $mm)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',2,'$mm','$curso',NOW())"))
		{	
				
		}
	}
foreach ($_POST["mmi"] as $mmi)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',3,'$mmi','$curso',NOW())"))
		{	
				
		}
	}
foreach ($_POST["mj"] as $mj)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',4,'$mj','$curso',NOW())"))
		{	
				
		}
	}
foreach ($_POST["mv"] as $mv)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',5,'$mv','$curso',NOW())"))
		{	
				
		}
	}
foreach ($_POST["ms"] as $ms)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',6,'$ms','$curso',NOW())"))
		{	
				
		}
	}


//------------------------------grabo tarde-----------------------------------------------------
foreach ($_POST["tl"] as $tl)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',1,'$tl','$curso',NOW())"))
		{	
				
		}
	}
foreach ($_POST["tm"] as $tm)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',2,'$tm','$curso',NOW())"))
		{	
				
		}
	}
foreach ($_POST["tmi"] as $tmi)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',3,'$tmi','$curso',NOW())"))
		{	
				
		}
	}
foreach ($_POST["tj"] as $tj)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',4,'$tj','$curso',NOW())"))
		{	
				
		}
	}
foreach ($_POST["tv"] as $tv)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',5,'$tv','$curso',NOW())"))
		{	
				
		}
	}
foreach ($_POST["ts"] as $ts)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',6,'$ts','$curso',NOW())"))
		{	
				
		}
	}
//------------------------------grabo vespertino-----------------------------------------------------
foreach ($_POST["vl"] as $vl)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',1,'$vl','$curso',NOW())"))
		{	
				
		}
	}
foreach ($_POST["vm"] as $vm)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',2,'$vm','$curso',NOW())"))
		{	
				
		}
	}
foreach ($_POST["vmi"] as $vmi)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',3,'$vmi','$curso',NOW())"))
		{	
				
		}
	}
foreach ($_POST["vj"] as $vj)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',4,'$vj','$curso',NOW())"))
		{	
				
		}
	}
foreach ($_POST["vv"] as $vv)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',5,'$vv','$curso',NOW())"))
		{	
				
		}
	}
foreach ($_POST["vs"] as $vs)
	{
		if (mysql_query ("INSERT INTO doc_mat VALUES ($dni,'$materia',6,'$vs','$curso',NOW())"))
		{	
				
		}
	}


	
?>
				<script>
				var answer=alert("Se grabo correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 

}
					
?>
</httl>
<? } ?>
