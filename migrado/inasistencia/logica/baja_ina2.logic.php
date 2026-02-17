<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
if (isset($_GET["actor"])) $dni=$_GET["actor"];
else echo "<script>history.back()</script>";
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;




$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente); 

?>

