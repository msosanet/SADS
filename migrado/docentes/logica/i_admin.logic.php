<?PHP
session_start();


include 'conexion.php';
?>



<title>Bienvenido al SiDoS</title>
</head>
<?
include 'header.php';


if (isset($_POST['muestra']))
{ 
	$_SESSION['usuario']=$_POST['usuario'];
	$_SESSION['contrasenia']=$_POST['contrasenia'];	

	?><meta http-equiv='refresh' content='0; URL=menu.php?'><?
}
else
{
?>


