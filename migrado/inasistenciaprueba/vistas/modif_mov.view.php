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
$id=$_GET["id"];

$resultt = mysql_query ("SELECT * FROM alta_baja WHERE id = $id");
$filatt = mysql_fetch_array($resultt);

$docen=$filatt['docente'];

$resulttv = mysql_query ("SELECT * FROM docentes WHERE dni = '$docen'");
$filattv = mysql_fetch_array($resulttv);

$mate=$filatt[materia];

$resulttx = mysql_query ("SELECT * FROM materia_cargo WHERE id = $mate");
$filattx = mysql_fetch_array($resulttx);

$check1="";
$check2="";

if ($filatt[activa] ==1) $check1="checked";
if ($filatt[enviado] ==1) $check2="checked";


$errordoc = 0;
$hayerrores = 0;


  $flag = 0;
  if (isset($_GET["submitx"])) {
     // verifico los errores en los campos
     if (trim($_POST["caracter"]) == 4) { $errorsrevi = 1; $hayerrores = 1; };

}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="_GET" action="modif_mov.php?docen=<? echo $docen; ?>&id=<? echo $id; ?>">
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
					
					<p align="left" class="text1b">Modificar Altas</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">ID.:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<?echo $id; ?>
							</td>
					
							

							<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Materia:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

						<? 	$valor2="SELECT * FROM materia_cargo order by id";
							menu($valor2,$filatt[materia],'materia'); ?></td>	
							
						</tr>

						
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Docente:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<?echo $filattv['apellido']; ?>, <?echo $filattv['nombre']; ?>

							</td>												

							

						
										<td width="190" bgcolor="#EAEAEA" align="right">
							Fecha inicio:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="fecha3" size="10" maxlength="10" value="<?echo $filatt['finicio']; ?>"/></td>
							</td>

						<tr>
							<td width="190" bgcolor="#EAEAEA" align="right">
							Fecha Alta:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="fecha1" size="10" maxlength="10" value="<?echo $filatt['fdesde']; ?>"/></td>
							</td>

						
							
					
					


						<td width="190" bgcolor="#EAEAEA" align="right">
							Fecha Baja:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="fecha2" size="10" maxlength="10" value="<?echo $filatt['fhasta']; ?>"/></td>
							</td>

							
						</tr>
						<?
	  					if ($errorsrevi==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>

									<tr>

							 <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Sit. Revi:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left">
                          
                        			<? 	$valor="SELECT * FROM caracter order by codigo";
							menu2($valor,$filatt[sit_revista],'sit_revista'); ?>

                          
						
						</td>
						
					

							<td width="190" bgcolor="#EAEAEA" align="right">
							Observaciones:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="obs" size="50" maxlength="100" value="<?echo $filatt['obs'];?>" /></td>
							</td>
							
						</tr>
									

									
						<tr>

							<td width="190" bgcolor="#EAEAEA" align="right">
							Activo:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="checkbox" name="activo" value="1"<? echo $check1 ?>></td>
						</td>


							<td width="190" bgcolor="#EAEAEA" align="right">Mov Enviado
							</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="checkbox" name="enviado" value="1"<? echo $check2 ?>></td>
							

							</td>

						
					

							
						</tr>

			
						<tr>
							
						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Actualizar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
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
<input type="hidden" name="docen" value="<?echo $docen;?>">
<input type="hidden" name="id" value="<?echo $id;?>">

	</form>
</div>
</body>
<?
}
else
{
	$fecha_desde=$_GET['fecha1'];
	$fecha_hasta=$_GET['fecha2'];
	$fecha_inicio=$_GET['fecha3'];
	$materia=$_GET['materia'];
	$caracter=$_GET['sit_revista'];
	$observaciones=$_GET['obs'];
	$graba=$filausuario["nombre"]."-".date("Y-m-d");
	$enviado=$_GET[enviado];
	$activo=$_GET[activo];

	$docen=$_GET['docen'];


	if ($enviado <> 1) $enviado=0;
	if ($activo <> 1) $activo=0;



if (mysql_query ("UPDATE alta_baja SET materia=$materia, fdesde='$fecha_desde', fhasta='$fecha_hasta', finicio='$fecha_inicio', obs='$observaciones', sit_revista=$caracter, enviado=$enviado, activa=$activo where docente=$docen and id=$id"))
	{		

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=leg_unif.php?actor=<? echo $docen; ?>'>

				<? 			
	}
	else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=leg_unif.php?actor=<? echo $docen; ?>'>

				<? 
		}

				
}

?>
</html>
<? } ?>
