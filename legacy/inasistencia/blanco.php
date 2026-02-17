<?PHP

session_start();

include 'conexion.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt);
if (!mysql_num_rows($resultt)) {
	$ref = base64_encode($_SERVER['REQUEST_URI']);
	$ref = 'Location: i_admin.php?ref=' . $ref;
	header($ref);
	exit;
}

include 'conexion3.php';
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
<title>Administrador del SID</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
/*$resultt = mysql_query ("SELECT DISTINCT idcurso FROM edfisica WHERE idcurso NOT IN (SELECT idcurso FROM matcur WHERE idmateria='71')");
$filatt = mysql_fetch_array($resultt) ;*/
/*
//SELECT DISTINCT idcurso FROM edfisica WHERE idcurso NOT IN (SELECT idcurso FROM matcur WHERE idmateria='71') 
$result79 = mysql_query ("SELECT DISTINCT idcurso FROM edfisica WHERE idcurso NOT IN (SELECT idcurso FROM matcur WHERE idmateria='71')");
while ($fila79 = mysql_fetch_array($result79))
{ 	$curso=$fila79['idcurso'];
	$sql = "INSERT INTO matcur VALUES ($curso,'71',0)";
	mysql_query($sql);
	echo $sql;
}
*/
?>

<body background="bgris.gif" >


<form method="GET" action="blanco.php">

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
 

</body>

</html>
