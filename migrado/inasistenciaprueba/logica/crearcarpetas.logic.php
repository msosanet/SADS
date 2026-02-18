<?
include 'conexion.php';

mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("sid") or die(mysql_error());

$con = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$dni=mysql_query("SELECT dni FROM docentes WHERE identificacion = '1'");

while($row = mysql_fetch_assoc($dni)) {

$directoryName = './ddjj/'.$row['dni'];
 
if(!is_dir($directoryName)){
    //Directory does not exist, so lets create it.
    mkdir($directoryName, 0755,true);
}

echo $directoryName;

}
?>

