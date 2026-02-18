<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexion.php';

$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date("Y-m-d",strtotime("yesterday"));
$curso = isset($_GET['curso']) ? substr($_GET['curso'], 0,1) : 1;
$division = isset($_GET['curso']) ? substr($_GET['curso'], 1) : 1;

$_cd = $curso . $division;

// Make a MySQL Connection
mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("base_sobral") or die(mysql_error());

$sql = "SELECT * FROM curso2 WHERE habilitado='1' AND idcurso != 999 ORDER BY curso,division ASC";
$result = mysql_query($sql);




/*$sql = "SELECT DISTINCT division FROM alumnos_curso WHERE division!='' ORDER BY division ASC";
$result = mysql_query($sql);
echo "<select name='division'>";
while ($row = mysql_fetch_assoc($result))
{ if ($row['division']!='')
     { echo "<option value=".$row['division'].">".$row['division']."</option>";}
}
echo "</select>";*/


?>



