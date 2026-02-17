<?PHP
session_start();
if ($_SESSION['estado']==1) { 
$_estados = [ "A" => "Ausente","P" => "Presente","T" => "Tardanza"];

include 'conexion3.php';
$conexion = conectar ();
$actor=$_GET["actor"];

$resultt = mysql_query ("SELECT * FROM docentes WHERE dni = '$actor'");
$filatt = mysql_fetch_array($resultt);
?>

