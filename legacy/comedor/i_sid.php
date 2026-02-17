<?PHP
session_start();

include 'conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Expires" content="Mon, 26 Jul 1997 05:00:00 GMT";?>
<meta http-equiv="Last-Modified" content="&lt;?echo gmdate(;D, d M Y H;)"
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="../csjs/style.css" />
<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Sistema de Comedor</title>
</head>
<?
include 'header.php';

$_SESSION['estado']=1;
?>

<body >



<div align="center">
	<table border="0" width="980" cellspacing="0" cellpadding="0" height="440" background="todo.jpg">
		<tr>
			<td>&nbsp;<div align="center">
				<table border="0" width="36%">
					<tr>
						<td align="center">&nbsp;<p>
						<a target="_self" href="ingreso.php"><img border="0" src="izq.png" width="100" height="89"></a></p>
						<p>&nbsp;</td>
						<td align="center">
						<a target="_self" href="egreso.php"><img border="0" src="der.png" width="100" height="85"></a></td>
<td align="center">
						<a target="_self" href="constancia.php"><img border="0" src="constancias.png" width="100" height="85"></a></td>
					</tr>
				</table>
			</div>
			</td>
		</tr>
	</table>
</div>








</body>

</html>