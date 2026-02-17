<?php
session_start();


include 'conexion3.php';
?>



<title>Bienvenido a Preceptores</title>
</head>
<?php
include 'header.php';


if (isset($_POST['muestra']))
{ 
	$_SESSION['usuario']=$_POST['usuario'];
	$_SESSION['contrasenia']=$_POST['contrasenia'];	

	?><meta http-equiv='refresh' content='0; URL=menu.php?'><?php
}
else
{
?>


