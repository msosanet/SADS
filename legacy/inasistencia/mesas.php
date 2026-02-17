<?PHP
session_start();
if ($_SESSION['estado']==1) { 


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


$resultdocente = mysql_query ("SELECT * FROM docentes where identificacion=1 order by apellido");
$resultdocente2 = mysql_query ("SELECT * FROM docentes where identificacion=1 order by apellido");
$resultdocente3 = mysql_query ("SELECT * FROM docentes where identificacion=1 order by apellido");
$resultdocente4 = mysql_query ("SELECT * FROM docentes where identificacion=1 order by apellido");

$resultcurso = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1'order by curso,division ASC"); 
$resultmateria = mysql_query ("SELECT * FROM materias_mesas order by materia"); 


$errordoc = 0;
  $hayerrores = 0;



  $flag = 0;
  if (isset($_POST["submitx"])) {


// controlo que el plan no sea 0 




}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="mesas.php">
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
					<p align="left" class="text1b">Seleccione los siguientes datos para crear las mesas de examen </p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left"><br><br><? if($error) { echo "<h4><font color=red>Datos vacios o incompletos</font></h4>";} ?><br>
<br>

			Materia:<select size="1" name="materia">
			<?	WHILE ($myrow6 = mysql_fetch_array($resultmateria))
				{			
					if($_POST['materia']==$myrow6[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
					echo "<option value=$myrow6[codigo] $seleccionado> $myrow6[materia] $myrow6[anio] $myrow6[plan] </option>";
				}?>
</select>				
		
<br><br>

<div align="center">
	<table border="0" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="8" cellspacing="8">

	<tr>

		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Presidente:<select size="1" name="presidente">
			<?	WHILE ($myrow6 = mysql_fetch_array($resultdocente))
				{			
					if($_POST['presidente']==$myrow6[dni]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
					echo "<option value=$myrow6[dni] $seleccionado> $myrow6[apellido] $myrow6[nombre] </option>";
				}
		?></select></font></td>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Vocal 1:<select size="1" name="vocal1">
			<?	WHILE ($myrow6 = mysql_fetch_array($resultdocente2))
				{			
					if($_POST['vocal1']==$myrow6[dni]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
					echo "<option value=$myrow6[dni] $seleccionado> $myrow6[apellido] $myrow6[nombre] </option>";
				}
		?></select></font></td>

</tr>
<tr>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Vocal 2:<select size="1" name="vocal2">
			<?	WHILE ($myrow6 = mysql_fetch_array($resultdocente3))
				{			
					if($_POST['vocal2']==$myrow6[dni]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
					echo "<option value=$myrow6[dni] $seleccionado> $myrow6[apellido] $myrow6[nombre] </option>";
				}
		?></select></font></td>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Suplente:<select size="1" name="suplente">
			<?	WHILE ($myrow6 = mysql_fetch_array($resultdocente4))
				{			
					if($_POST['suplente']==$myrow6[dni]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
					echo "<option value=$myrow6[dni] $seleccionado> $myrow6[apellido] $myrow6[nombre] </option>";
				}
		?></select></font></td>
</tr>
	<tr>
		<?
	  		if ($errorl2==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Fecha Mesa (DD/MM/AAAA):<input type="text" name="fecha" size="10" maxlength="10" value="<?echo $_POST['fecha']; ?>" /></font></td>
				<?
	  		if ($errorm2==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Mesa (HH:MM):<input type="text" name="hh" size="2" maxlength="2" value="<?echo $_POST['hh']; ?>" />:<input type="text" name="mm" size="2" maxlength="2" value="<?echo $_POST['mm']; ?>" /></font></td>
				<?
	  		if ($errormi2==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>"></font></td>
				<?
	  		if ($errorj2==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>"></font></td>
</tr>

	<tr>
		<td width="834" bgcolor="#EAEAEA" align="center" colspan="5">&nbsp;</td>
	</tr>
						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="5">
							<p align="center"><input type="submit" value="     Crear     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
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

$matt=$_POST['materia'];
$buscar2 = mysql_query ("SELECT * FROM materias_mesas where codigo=$matt"); 
$buscarx = mysql_fetch_array($buscar2);

	$invert = explode("/",$_POST['fecha']); 
	$fechas = $invert[2]."-".$invert[1]."-".$invert[0]; 
	$plan=$buscarx[plan];
	$curso=$buscarx[anio];
	$materia=$buscarx[materia];
	$anio=date ("Y");
	$hora=$_POST['hh'];
	$minuto=$_POST['mm'];
	$horario=$hora.":".$minuto.":00";
	$dni1=$_POST['presidente'];
	$dni2=$_POST['vocal1'];
	$dni3=$_POST['vocal2'];
	$dni4=$_POST['suplente'];

//------------------------------grabo ma�ana-----------------------------------------------------

		if (mysql_query ("INSERT INTO docentes_mesas VALUES (0,'$plan','$curso','$materia','$fechas','$horario','$anio','$dni1','$dni2','$dni3','$dni4')"))
		{	
?>
				<script>
				var answer=alert("Se creo correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=mesas.php?'>
				<? 
				
		}
	else {
?>

	<script>
				var answer=alert("Error!, no se pudo crear")
				</script> 
				<meta http-equiv='refresh' content='0; URL=mesas.php?'>
				<? 

}
	


}
					
?>
</httl>
<? } ?>