<?PHP
session_start();

if (isset($_SESSION['estado'])) if ($_SESSION['estado'] == 1) {
	header('Location: menu.php');
	exit;
}

include 'conexion.php';
conectar();
if (isset($_POST['muestra']))
{
	$_SESSION['usuario']=$_POST['usuario'];
	$_SESSION['contrasenia']=$_POST['contrasenia'];
	$_SESSION['cicloLectivo']=2025;

	$es_usuario = mysql_query("SELECT * FROM `usuarios` WHERE `usuario` LIKE '$_POST[usuario]' AND `pass` LIKE '$_POST[contrasenia]' ");

	if(mysql_num_rows($es_usuario)) {
		if (isset($_POST['ref'])) {
			$ingreso = mysql_fetch_assoc($es_usuario);
			$_SESSION['estado']=1;
			$_SESSION['valor']=$ingreso['valor'];
			$_SESSION['sector']=$ingreso['sector'];
			$ref = base64_decode($_POST['ref']);
			$ref = 'Location: ' . $ref;
			header($ref);
			exit;
		}
		else header('Location: menu.php');
		exit;
/*	?><meta http-equiv='refresh' content='0; URL=menu.php?'><? */
	}
	else header('Location: menu.php');
	exit;
}
else
{
?>

