<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="../csjs/style.css" />
<link rel="stylesheet" href="menu_style.css" type="text/css" />
<link rel="shortcut icon" href="../imag/favicon.ico">
<title>SID</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 







</script> 
</head>
<body>

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
				<table border="0" width="980" cellspacing="0" cellpadding="0">
					<tr>
						
					</tr>
	</table>
				
    </div>
	<div align="center">





<div align="center">
<table border="0" width="60%">
<?


include 'header.php';
$conexion = conectar ();


$usuario=$_SESSION['usuario'];

if ($_SESSION['valor']==1)
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
if ($_SESSION['valor']==4) 
{		
include 'menuppal4.php';
}


$id=$_GET['id'];
$es=$_GET['es'];

	if ($es=='N') 
	{$tipo="notas";
	 $tabla="notasnuevo";
	}
	
	if ($es=='D') 
	{$tipo="dispo";
	 $tabla="disponueva";
	}
	
	if ($es=='NF') 
	{$tipo="notificaciones";
	 $tabla="notificaciones";
	}


$url="uploads/$tipo/$id.pdf";
//echo $url;

?>
<br>
<?php


echo "<iframe src=\"$url\" width=\"100%\" style=\"height:1000px\"></iframe>";

?>


</TABLE> 
</div>
<?
}
?>
</html>


