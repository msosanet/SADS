<?PHP
session_start();


include 'conexion.php';
?>



<title>Administrador del SID -</title>
</head>
<?
include 'header.php';


if (isset($_POST['muestra']))
{ 
	$_SESSION['docente']=$_POST['docente'];


	?><meta http-equiv='refresh' content='0; URL=menu.php?'><?
}
else
{
?>


