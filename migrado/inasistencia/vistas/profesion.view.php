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
<title>Administrador de Convocatorias</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;






?>

<body background="bgris.gif" >


<form method="GET" action="profesion.php">

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
else {		
include 'menuppal.php';
}
?>
				<tr>
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Consultar C.V. por Profesi&oacute;n.</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
					<table border="0" width="62%">
						<tr>
							<td align="right" width="36%">Ingrese la profesi&oacute;n o parte de ella:</td>
							<td align="right">&nbsp;<input type="text" name="descripcion" id="descripcion" size="28" maxlength="40" value="" /></td>
							<td align="right" rowspan="3" width="389" background="teclado.jpg">
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
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

	$_pagi_sql="SELECT * FROM m_salud_cformsdata WHERE field_name='ProfesiÃ³n' and field_val like'%$descripcion%'";



$_pagi_cuantos=5;
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
							<td class="text1b"background="../imag/bar07.gif"  colspan="6" height="40" align="left">
							&nbsp;Listado por profesi&oacute;n</td>
						</tr>
						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">ID</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Apellido y Nombre</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Puesto</td>
							<td bgcolor="#808080" width="40" align="center"  height="36">Profesi&oacute;n</td>
							<td bgcolor="#808080" width="40" align="center"  height="36">Ciudad donde Reside</td>
							<td bgcolor="#808080" width="118" align="center"  height="36">Descargas</td>							

							
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{	
			$result2 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Seleccione su C.V.[*3]' and sub_id=$fila2[sub_id]");
			$fila3 = mysql_fetch_array($result2);
			$result3 = mysql_query ("SELECT * FROM  m_salud_cformsdata WHERE field_name='Ingrese su Apellido y Nombre Completo' and sub_id=$fila2[sub_id]");
			$fila4 = mysql_fetch_array($result3);
			$result5 = mysql_query ("SELECT * FROM  m_salud_cformsdata WHERE field_name='Puesto de trabajo para el que se postula:' and sub_id=$fila2[sub_id]");
			$fila6 = mysql_fetch_array($result5);
			$result6 = mysql_query ("SELECT * FROM  m_salud_cformsdata WHERE field_name='ProfesiÃ³n' and sub_id=$fila2[sub_id]");
			$fila7 = mysql_fetch_array($result6);
			$result7 = mysql_query ("SELECT * FROM  m_salud_cformsdata WHERE field_name='Provincia donde Reside' and sub_id=$fila2[sub_id]");
			$fila8 = mysql_fetch_array($result7);



			$ext=$fila2[sub_id]."-";
			$adjunto="http://ministeriosalud.tierradelfuego.gov.ar/webapps/cv/".$ext.$fila3[field_val];
			$apeynom1=strtolower($fila4[field_val]); 
			$apeynom=ucwords($apeynom1);

		?> 

						<tr>
							<?
 							$adjunto=utf8_encode($adjunto);
							
							?>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[sub_id];?></td>
							<td bgcolor="#EAEAEA" width="150" align="left">&nbsp;&nbsp;<?echo $apeynom;?></td>
							<td bgcolor="#EAEAEA" width="200" align="left">&nbsp;&nbsp;<?echo ucwords(strtolower($fila6[field_val]));?></td>
							<td bgcolor="#EAEAEA" width="40" align="left">&nbsp;&nbsp;<?echo ucwords(strtolower($fila7[field_val]));?></td>
							<td bgcolor="#EAEAEA" width="150" align="left">&nbsp;&nbsp;<?echo $fila8[field_val];?></td>
							<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="<?echo $adjunto?>" target="_blank"><img border="0" src="form.png" width="35" height="35" alt="Descargar c.v."></a></td>
							
                  					
					
							
							
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
