<?PHP
session_start();
if ($_SESSION['estado']==1) {

//include 'conexion.php';
include 'conexioncalif.php';
//include 'conexionsobral.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />

<title>Habilitaci�n de usuarios</title>

<style>
	thead th {
		background-color: white;
	}
</style>

</head>
<?
include 'header.php';
//$conexion = conectar ();
$conexioncalif = conectarcalif ();
//$conexionsobral=conectarsobral ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
//$resultt = mysql_query("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
//$filatt = mysql_fetch_array($resultt) ;

if (isset($_GET['usuario']))
{mysql_select_db("calificadores");
if ($_GET['hab']==1)
{$sql="UPDATE users SET habilitado=1 WHERE username='$_GET[usuario]'";}
else
{$sql="UPDATE users SET habilitado=0 WHERE username='$_GET[usuario]'";}

mysql_query ($sql) ;//or die('Consulta no válida: ' . mysql_error());

if (mysql_query ($sql))
	{

				?>
				<script>
				var answer=alert("Usuario habilitado!")
				</script>
				<meta http-equiv='refresh' content='0; URL=veruscal.php'>
				<?
	}
	else {
				?>
				<script>
				var answer=alert("No se pudo habilitar el usuario")
				</script>
				<meta http-equiv='refresh' content='0; URL=veruscal.php'>
				<?
		}







}

/*if (isset($_GET['blanquear']))
{
//$2y$10$
$salt= uniqid(mt_rand(), true);
$options=['salt'=>$salt, 'cost'=>10];
$mypassword=$argv[1];
$cryptpwd=crypt($mypassword,'$2y$10$'.$salt.'$');
//$pwdhash=password_hash($mypassword, PASSWORD_DEFAULT, $options);
echo $cryptpwd;
echo $pwdhash;
//$2y$10$oje5wD.NupBacGticF3Uu.awEuUvFCXjz8IaWkIffgQzYP8/sNi2W
}*/

?>

<body>


<form method="GET" action="veruscal.php">

<div style="align:center;max-width: 980px">

<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
if ($_SESSION['valor']==4) include 'menuppal4.php';

$q_roles = "SELECT * FROM `users-perfil` ";
$__roles = mysql_query($q_roles);
$roles = [];
while ($r = mysql_fetch_assoc($__roles)) $roles[$r['usuario']][] = $r['perfil'];

 printf("<!-- %s -->",var_export($_SESSION,true));

$result79 = mysql_query ("SELECT * FROM users ORDER by habilitado ASC,dni ASC");
$cantidad=mysql_num_rows($result79);
mysqli_select_db($conexioncalif,"calificadores");
$resulfaltan = mysql_query ("SELECT DISTINCT iddocente FROM matcur WHERE iddocente NOT IN (SELECT dni FROM users)");
$faltan=mysql_num_rows($resulfaltan);
$usuarios = [];
?>
			<table border="0">
<tr><td><h1><p align="center">Administrar usuarios para Calificadores.</h1></p></td></tr>
<tr><td><h1><p align="center"><?echo $cantidad; ?></h1></p> <p align="center"><a href="docfal2.php">Faltan (<?echo $faltan; ?> </a>)</p></td></tr>

</table>
</div>
<br><br>
	<div align="center">
		<table border="2" width="750" bgcolor="#FFFFFF">
			<thead><tr>
				<th>DNI</th>
				<th>Correo Electronico</th>
				<th>Nombre y Apellido</th>
				<th>Habilitar</th>
				<th>Blanquear Pass (DNI)</th>
				<th>Docente</th>
				<th>Preceptore</th>
				<th>Jefatura Prec</th>
				<th>Tutore</th>
			</tr></thead>
<?
		while ($fila79 = mysql_fetch_array($result79))
			{
				$uId = rand(10000,99999); //crea ID para proteger los datos de la BD
				$usuarios[$uId] = $fila79['username'];

				echo "<tr>";

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
			die('Consulta no válida: ' . mysql_error());
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
			<td><?echo mb_convert_encoding($fila79['nya'],"CP1252","UTF-8"); ?></td>
			<td bgcolor="<?echo $colorhab; ?>"><a href = "veruscal.php?usuario=<?echo $fila79['username'];?>&hab=<?echo $hab;?>"><?echo $estado;?></a></td>
			<td><a href ="https://calificadores.colegiosobral.edu.ar/blanq.php?blanquear=<?echo $fila79['dni'];?>" target="_blank" onclick="return  confirm('Esta seguro que desea blanquear la clave?')">Blanquear</a></td>
			<td <?PHP if (array_search('1',$roles[$fila79['username']])!== false) echo "style='background-color: lightblue'" ?>></td>
			<td <?PHP if (array_search('11',$roles[$fila79['username']])!== false) echo "style='background-color: lightblue'" ?>></td>
			<td <?PHP if (array_search('10',$roles[$fila79['username']])!== false) echo "style='background-color: lightblue'" ?>></td>
			<td <?PHP if (array_search('15',$roles[$fila79['username']])!== false) echo "style='background-color: lightblue'" ?>></td>

<?
	echo "</tr>";

	}
?>


</table>
</div>



<?
$_SESSION['usu'] = $usuarios;

}

else { //vuelve a abrir la pagina actual si se desconecta
	$ref = base64_encode($_SERVER['REQUEST_URI']);
	$ref = 'Location: i_admin.php?ref=' . $ref;
	header($ref);
	exit;
}?>
