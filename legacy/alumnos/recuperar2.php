<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
include 'conexioncalif.php';
//include 'conexionsobral.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta charset="UTF-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />

<title>Habilitación de usuarios</title>



</head>
<?
include 'header.php';
$conexion = conectar ();
$conexioncalif = conectarcalif ();
//$conexionsobral=conectarsobral ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
//$resultt = mysql_query("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
//$filatt = mysql_fetch_array($resultt) ;


?>
<body background="bgris.gif" >


<form method="GET" action="veruscal.php">

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
if ($_SESSION['valor']==4) 
{		
include 'menuppal4.php';
}

$result79 = mysql_query ("SELECT * FROM users ORDER by habilitado ASC,dni ASC");
$cantidad=mysql_num_rows($result79);
mysqli_select_db($conexioncalif,"calificadores");
$resulfaltan = mysql_query ("SELECT DISTINCT iddocente FROM matcur WHERE iddocente NOT IN (SELECT dni FROM users)");
$faltan=mysql_num_rows($resulfaltan);
			
?>
<br>
<tr><td><h1><p align="center">Alumnos.</h1></p></td></tr>
<tr><td><h1><p align="center"><?echo $cantidad; ?></h1></p> <p align="center"><a href="docfal2.php">Faltan (<?echo $faltan; ?> </a>)</p></td></tr>

</table>
</div></div>
<br><br>				
	<div align="center">			
		<table border="2" width="750" bgcolor="#FFFFFF">
			<tr>
				<td>DNI</td>
				<td>Correo Electronico</td>
				<td>Nombre y Apellido</td>
				<td>Habilitar</td>
				<td>Blanquear Pass (DNI)</td>
			</tr>	
<?
		while ($fila79 = mysql_fetch_array($result79))
			{echo "<tr>";
			
			if ($fila79['habilitado']==1)
				{
				$estado="Deshabilitar";
				$colorhab="FF0000";
				$hab=0;
				}
			else
			{
				$estado="Habilitar";
				$colorhab="00FF00";
				$hab=1;
				}
			mysql_select_db("sid");
			$resultdoc = mysql_query ("SELECT * FROM docentes WHERE dni='$fila79[dni]'");
			
			if (!$resultdoc) {
			die('Consulta no vÃ¡lida: ' . mysql_error());
						echo  mysql_error;}
			
			while ($filadoc = mysql_fetch_array($resultdoc))
			{
				if ($fila79['dni']==$filadoc['dni'])
					{$colordni='00FF00';}
				else
					{$colordni='FF0000';}
				
				if (trim($fila79['username'])==trim($filadoc['mail']))
					{$colormail='00FF00';}
				else
					{$colormail='FF0000';}
			
			/*echo trim($fila79['username']);
			echo trim($filadoc['mail']);*/		
			/*echo $colordni;
			echo $colormail;*/
			
			}
?>
			
			<td bgcolor="<?echo $colordni; ?>"><?echo $fila79['dni']; ?></td>
			<td bgcolor="<?echo $colormail; ?>"><?echo $fila79['username']; ?></td>
			<td><?echo $fila79['nya']; ?></td>
			<td bgcolor="<?echo $colorhab; ?>"><a href = "veruscal.php?usuario=<?echo $fila79['username'];?>&hab=<?echo $hab;?>"><?echo $estado;?></a></td>
			<td><a href ="https://calificadores.colegiosobral.edu.ar/blanq.php?blanquear=<?echo $fila79[dni];?>" target="_blank" onclick="return  confirm('Esta seguro que desea blanquear la clave?')">Blanquear</a></td>
			
			
			
<?			
	echo "</tr>";		}
?>


</table>
</div>



<?} ?>