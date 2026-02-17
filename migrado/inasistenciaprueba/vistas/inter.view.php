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






?>

<body background="bgris.gif" >


<form method="POST" action="exportar.php?descripcion=<?php echo $descripcion;?>">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Consultar C.V. por puesto para exportar.</p>
						</p>
					<p align="center">&nbsp;

					</p>

					<div align="left">

					<table border="0" width="62%">
						<tr>
							<td align="right" width="36%">Ingrese el puesto o parte de el:</td>
							<td align="right">&nbsp;<input type="text" name="descripcion" id="descripcion" size="28" maxlength="40" value="" /></td>
							<td align="right" rowspan="4" width="389" background="teclado.jpg">
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>



						<tr>
							<td align="right" colspan="2">
							<p align="center">
									<input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
					</table>
					</div>



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
