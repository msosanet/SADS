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

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Bolsa de Trabajo</title>

<script language=javascript> 
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO")
}


function seleccionar_todo(){
for (i=0;i<document.f1.elements.length;i++)
if(document.f1.elements[i].type == "checkbox")
document.f1.elements[i].checked=1
}
function deseleccionar_todo(){
for (i=0;i<document.f1.elements.length;i++)
if(document.f1.elements[i].type == "checkbox")
document.f1.elements[i].checked=0
}
</script>



</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;

$descripcion=$_POST['descripcion'];

?>
<body background="bgris.gif" >


<form method="POST" action="exportar.php?descripcion=<?echo $descripcion?>" name="f1">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Consultar C.V. por carrera para exportar.</p>
						</p>
					<p align="center">&nbsp;

					</p>

					<?


$result = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Puesto de trabajo para el que se postula:' and field_val like'%$descripcion%'");


?>
<br><br>
</p><?

		?> <table border="1" width="760" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="7" height="40" align="left">
							&nbsp;Listado</td>
						</tr>
						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">ID</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Apellido y Nombre</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Puesto</td>
							<td bgcolor="#808080" width="40" align="center"  height="36">Profesi&oacute;n</td>
							<td bgcolor="#808080" width="40" align="center"  height="36">Ciudad donde Reside</td>
							<td bgcolor="#808080" width="118" align="center"  height="36">Descargas</td>	
							<td bgcolor="#808080" width="90" align="center"  height="36"><a href="javascript:seleccionar_todo()">Marcar Todos</a> |
                            <a href="javascript:deseleccionar_todo()">Ninguno</a>

						</tr>

		<?php while ($fila2 = mysql_fetch_array($result))
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
			$result8 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Ingresá tu D.N.I.' and sub_id=$fila2[sub_id]");
			$fila9 = mysql_fetch_array($result8);
			$ext=$fila2[sub_id]."-";
			$adjunto="http://ministeriosalud.tierradelfuego.gov.ar/webapps/cv/".$ext.$fila3[field_val];
			$apeynom1=strtolower($fila4[field_val]." ".$fila5[field_val]);
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
							<td bgcolor="#EAEAEA" width="170" align="left">&nbsp;&nbsp;<?echo $fila8[field_val];?></td>
							<td bgcolor="#FFFFFF" width="40" align="center" bordercolor="#C0C0C0"><a href="<?echo $adjunto?>" target="_blank"><img border="0" src="form.png" width="35" height="35" alt="Descargar c.v."></a></td>
							<td bgcolor="#EAEAEA" width="90" align="center"><input type="checkbox" name="afectado[]"  value="<?php echo $fila2[sub_id]?>">
						</tr>
						<?
						}
						?>
						</table><?


	?>
					</p>

                        <p align="center"><br>
					    <input type="submit" value="   Exportar (xls)   " name="xls" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" />

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


<?
if (isset($_POST['xls'])) {

foreach ($_POST['afectado'] as $afectado)
	{
			$_SESSION['array'][]=$afectado;
    }

                       ?>

						<meta http-equiv='refresh' content='0; URL=genxls.php?'>
						<?

                        }
?>
 </td>

</div>

</body>

</html>
<? } ?>