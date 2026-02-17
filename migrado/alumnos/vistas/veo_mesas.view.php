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
$resultdocente2 = mysql_query ("SELECT * FROM docentes where identificacion=1 order by apellido");
$resultdocente3 = mysql_query ("SELECT * FROM alumno order by apellido");

?>

<body background="bgris.gif" >


<form method="GET" action="veo_mesas.php">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Buscar Mesas.</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
					<table border="0" width="62%">
						<tr>
							<td align="right" width="50%">DOCENTE:</td>
							<td align="right">&nbsp;<select size="1" name="descripcion">
			<? /*	WHILE ($myrow6 = mysql_fetch_array($resultdocente2))
				{			
					if($_POST['descripcion']==$myrow6[dni]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
					echo "<option value=$myrow6[dni] $seleccionado> $myrow6[apellido] $myrow6[nombre] </option>";
				}
		*/ ?></select></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						<tr>
							<td align="right" width="50%">ALUMNO:</td>
							<td align="right"><select size="1" name="descripcion2">
			<? /*	WHILE ($myrow6 = mysql_fetch_array($resultdocente3))
				{			
					if($_POST['descripcion2']==$myrow6[dni]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
					echo "<option value=$myrow6[dni] $seleccionado> $myrow6[apellido] $myrow6[nombre] </option>";
				}
		*/ ?></select></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						<tr>
							<td align="right" width="60%">MATERIA: Ingrese el nombre de la materia o parte de ella:</td>
							<td align="right">&nbsp;<input type="text" name="descripcion3" id="descripcion3" size="28" maxlength="40" value="" /></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						<tr>
							<td align="right" width="60%">Fecha de la mesa:</td>
							<td align="right"><input type="text" name="fecha_desde" id="fecha_desde" value="<?echo $_GET["fecha_desde"]?>" maxlength="10"/>
    							<img src="calendario.png" width="16" height="16" border="0" title="Fecha Desde" id="fechas1"></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						<!-- script que define y configura el calendario-->
    						<script type="text/javascript"> 
	   					Calendar.setup({ 
	    					inputField:"fecha_desde",       // id del campo de texto 
	    					ifFormat:"%Y-%m-%d",            // formato de la fecha que se escriba en el campo de texto 
						button:"fechas1"             // el id del bot&oacute;n que lanzar&aacute; el calendario 
								}); 
						</script>
						</tr>
						
						<tr>
							<td align="right" colspan="2">
							<p align="center">
									<input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>


					</table>
					</div>
					<p align="center">

					</p>
					<p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p>
					<p align="left">
</font>
					<?
				if (isset($_GET['muestra2']))
{ 
	$descripcion=$_GET['descripcion'];
	$descripcion2=$_GET['descripcion2'];
	$descripcion3=$_GET['descripcion3'];
	$descripcion4=$_GET['fecha_desde'];

/*$_pagi_sql="SELECT * FROM docentes_mesas order by fecha";*/


if ($descripcion3=="" and $descripcion4=="" ){	$_pagi_sql="SELECT * FROM docentes_mesas order by fecha";}
if ($descripcion3=="" and $descripcion4!="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE fecha = '$descripcion4'";}
if ($descripcion3!="" and $descripcion4=="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE materia like'%$descripcion3%'";}
if ($descripcion3!="" and $descripcion4!="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE materia like'%$descripcion3%' and fecha='$descripcion4'";}




	
/*if ($descripcion=="00000000"){$descripcion="";}
if ($descripcion2=="00000000"){$descripcion2="";}
if ($descripcion=="" and $descripcion2=="" and $descripcion3=="" and $descripcion4=="" ){	$_pagi_sql="SELECT * FROM docentes_mesas order by fecha";}
if ($descripcion=="" and $descripcion2=="" and $descripcion3=="" and $descripcion4!="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE fecha='$descripcion4'";}
if ($descripcion=="" and $descripcion2=="" and $descripcion3!="" and $descripcion4=="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE materia like'%$descripcion3%' order by fecha";}
if ($descripcion=="" and $descripcion2=="" and $descripcion3!="" and $descripcion4!="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE fecha='$descripcion4' and materia like'%$descripcion3%' order by fecha";}
if ($descripcion=="" and $descripcion2!="" and $descripcion3=="" and $descripcion4=="" ){	$_pagi_sql="SELECT * FROM docentes_mesas,mesas WHERE mesas.dni='$descripcion2' and mesas.codigo=docentes_mesas.codigo";}
if ($descripcion=="" and $descripcion2!="" and $descripcion3=="" and $descripcion4!="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE fecha='$descripcion4' and apellido like'%$descripcion%' and identificacion=1";}
if ($descripcion=="" and $descripcion2!="" and $descripcion3!="" and $descripcion4=="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE materia like'%$descripcion3%' order by fecha";}
if ($descripcion=="" and $descripcion2!="" and $descripcion3!="" and $descripcion4!="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE fecha='$descripcion4' and materia like'%$descripcion3%' order by fecha";}
if ($descripcion!="" and $descripcion2=="" and $descripcion3=="" and $descripcion4=="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE dni1='$descripcion' or dni2='$descripcion' or dni3='$descripcion' or dni4='$descripcion' order by fecha";}
if ($descripcion!="" and $descripcion2=="" and $descripcion3=="" and $descripcion4!="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE fecha='$descripcion4' and (dni1='$descripcion' or dni2='$descripcion' or dni3='$descripcion' or dni4='$descripcion') order by fecha";}
if ($descripcion!="" and $descripcion2=="" and $descripcion3!="" and $descripcion4=="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE materia like'%$descripcion3%' and fecha='$descripcion4' and (dni1='$descripcion' or dni2='$descripcion' or dni3='$descripcion' or dni4='$descripcion') order by fecha";}
if ($descripcion!="" and $descripcion2=="" and $descripcion3!="" and $descripcion4!="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE materia like'%$descripcion3%' and fecha='$descripcion4' and (dni1='$descripcion' or dni2='$descripcion' or dni3='$descripcion' or dni4='$descripcion') order by fecha";}
if ($descripcion!="" and $descripcion2!="" and $descripcion3=="" and $descripcion4=="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE fecha='$descripcion4' and apellido like'%$descripcion%' and identificacion=1";}
if ($descripcion!="" and $descripcion2!="" and $descripcion3=="" and $descripcion4!="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE materia like'%$descripcion3%' order by fecha";}
if ($descripcion!="" and $descripcion2!="" and $descripcion3!="" and $descripcion4=="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE materia like'%$descripcion3%' and fecha='$descripcion4' and (dni1='$descripcion' or dni2='$descripcion' or dni3='$descripcion' or dni4='$descripcion') order by fecha";}
if ($descripcion!="" and $descripcion2!="" and $descripcion3!="" and $descripcion4!="" ){	$_pagi_sql="SELECT * FROM docentes_mesas WHERE materia like'%$descripcion3%' and fecha='$descripcion4' and (dni1='$descripcion' or dni2='$descripcion' or dni3='$descripcion' or dni4='$descripcion') order by fecha";}
*/
$_pagi_cuantos=10;
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
							<td class="text1b"background="../imag/bar07.gif"  colspan="7" height="40" align="left">
							&nbsp;Resultado de la B&uacute;squeda</td>
						</tr>
						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">Fecha</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Materia</td>
							<td bgcolor="#808080" width="50" align="center" height="36">Año</td>
							<td bgcolor="#808080" width="50" align="center" height="36">Curso</td>
							<td bgcolor="#808080" width="50" align="center" height="36">Plan</td>
							<td bgcolor="#808080" width="20" align="center"  height="36">HS</td>	
							<td bgcolor="#808080" width="50" align="center"  height="36">Acciones</td>							

							
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{

						$fechas=explode("-",$fila2[fecha]);
						$fechas=$fechas[2]."/".$fechas[1]."/".$fechas[0];
	
		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fechas;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><a href="mesas1.php?mesa=<?php echo $fila2[codigo]?>" target="_blank"><?echo $fila2[materia];?></a></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[anio];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[curso];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[plan];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[hs];?></td>
							<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="ver_mesa.php?mesa=<?php echo $fila2[codigo]?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Ver mesa completa"></a></td>

							
						</tr>
						<?
						}
						?>
						</table><?
}
	?>					
					</p>
					<p align="center">&nbsp;</td>
				</tr>


			</table>
			</div>
			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>



</form>
 </td>

</div>

</body>

</html>
<? } ?>
