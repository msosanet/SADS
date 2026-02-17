<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

//Calcula el numero de dias entre dos fechas.
// Da igual el formato de las fechas (dd-mm-aaaa o aaaa-mm-dd),
// pero el caracter separador debe ser un gui�n.
function diasEntreFechas($fechainicio, $fechafin){
    return (((strtotime($fechafin)-strtotime($fechainicio))/86400)+1);
}

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
$dni=$_GET['actor'];
$identificacion=$_GET['ident'];

$resultdocente2 = mysql_query ("SELECT * FROM docentes where identificacion=1 order by apellido");


$hora=date("H:i:s");

$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente); 

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario); 

if ($identificacion==1)
{
$resultmotivo = mysql_query ("SELECT * FROM motivos order by descripcion"); 
}
if ($identificacion==2)
{
$resultmotivo = mysql_query ("SELECT * FROM motivos2 order by descripcion"); 
}

$errordoc = 0;
  $hayerrores = 0;


  if (!isset($_POST["submitx"])) {
$_POST['d']=date("d");
$_POST['m']=date("m");
$_POST['a']=date("Y");
$_POST['d2']=date("d");
$_POST['m2']=date("m");
$_POST['a2']=date("Y");
$_POST['hora']=$hora;


}




  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos


     if (trim($_POST["d2"]) == '') { $errorfecha2 = 1; $hayerrores = 1; };
     if (trim($_POST["m2"]) == '') { $errorfecha2 = 1; $hayerrores = 1; };
     if (trim($_POST["a2"]) == '') { $errorfecha2 = 1; $hayerrores = 1; };
     if (trim($_POST["hora"]) == '') { $errorhora = 1; $hayerrores = 1; };

}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="cargar_nov2.php">
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
					
					<p align="left" class="text1b">Cargar Novedad de toma de docentes</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="4" height="40" align="left"></td>
						</tr>
						
						
						<tr>
					<td width="74" bgcolor="#EAEAEA" align="right">Docente </td>
					<td><select size="1" name="docente">

					
				<?	WHILE ($myrow6 = mysql_fetch_array($resultdocente2))
				{			
					if($_POST['descripcion']==$myrow6[dni]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
					echo "<option value=$myrow6[dni] $seleccionado> $myrow6[apellido] $myrow6[nombre] </option>";
				}
		?></select></td>
						
							


							<td width="190" bgcolor="#EAEAEA" align="right">
							Materia</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="materia" size="30" maxlength="30" value="" /></td>
							</td>
							
	
						</tr>
						<tr>

							<td width="190" bgcolor="#EAEAEA" align="right">
							Curso:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="curso" size="2" maxlength="2" value="" /></td>
							</td>
							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Div:
							</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="div" size="2" maxlength="2" value="" />
							</td>
						</tr>

						<tr>

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<?echo $_POST['d']; ?>
							-
							<?echo $_POST['m']; ?>
							-
							<?echo $_POST['a']; ?> 
							</td>
							
					
					
					<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha de comienzo del profe:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="d2" size="2" maxlength="2" value="<?echo $_POST['d2']; ?>" />
							-
							<input type="text" name="m2" size="2" maxlength="2" value="<?echo $_POST['m2']; ?>" />
							-
							<input type="text" name="a2" size="4" maxlength="4" value="<?echo $_POST['a2']; ?>" /> 
							(DD-MM-AAAA)</td>

						</tr>

			
						<tr>

							<td width="190" bgcolor="#EAEAEA" align="right">
							Hora:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="hora" size="10" maxlength="10" value="<?echo $_POST['hora'];?>" />(HH:MM:SS)</td>
							</td>
							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Notific&oacute;:
							</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><b><? echo $filausuario['apellido']  ?>&nbsp;<? echo $filausuario['nombre']  ?></b>
							</td>
						</tr>
						<input type="hidden" name="identificacion" id="identificacion" value="<? echo $identificacion;?>"/>

						
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
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
<input name="identificacion" type="hidden" value ="<?php echo $identificacion ?>"/>
	</form>
</div>
</body>
<?
}
else
{




	$fecha1=$_POST['a']."-".$_POST['m']."-".$_POST['d'];
	$fecha2=$_POST['a2']."-".$_POST['m2']."-".$_POST['d2'];
	$materia=$_POST['materia'];
	$hora=$_POST['hora'];
	$docente=$_POST['docente'];
	$curso=$_POST['curso'];
	$div=$_POST['div'];
	$dni=$_POST['dni'];
	$now=date("Y-m-d");
	$graba=$filausuario["nombre"];







	

if (mysql_query ("INSERT INTO novedades2 VALUES (0,$docente,'$materia','$curso','$div','$now','$fecha2','$hora','$graba',1)"))
	{		


				
	}
				else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 
				}					

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=cargar_nov2.php?actor=<?php echo $dni ?>&ident=<?php echo $identificacion ?>'>
				<? 

}

?>
</html>
<? } ?>