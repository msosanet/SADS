<?PHP
session_start();
if ($_SESSION['estado']==1) { 

//include 'conexion.php';
include 'conexioncalif.php';

		if(isset($_GET["curso"]))
		{
		$curso=$_GET["curso"];
		}
		else
		{
		$curso=$_POST['curso'];
		}
		
		echo $curso;
?>

