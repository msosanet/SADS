<?PHP
session_start();


include 'conexion.php';
?>


<title>Administrador S.A.S.</title>
</head>
<?
include 'header.php';


if (isset($_POST['muestra']))
{ 
	$_SESSION['usuario']=$_POST['usuario'];
	$_SESSION['contrasenia']=$_POST['contrasenia'];	
	$_SESSION['cicloLectivo']=2023;	

	?><meta http-equiv='refresh' content='0; URL=menu.php?'><?
}
else
{
?>


