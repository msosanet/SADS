<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexioncalif.php';

if (isset($_GET["submitx"])) //actualiza los docentes para cada materia
{
 $conexion = conectarcalif ();
 $curso=$_GET['curso'];

 $i=0;
 foreach ($_GET['asigna'] as $d)
	{	$es=$_GET['matmat'];
		$mate=$es[$i];
		$sql = "UPDATE matcur SET idarea='$d' WHERE idmateria='$mate' AND idcurso='$curso'";

		$i++;
		mysql_query($sql);
		//printf("<!-- %s -->\n",$sql);
	}
}

$conexion = conectarcalif ();
$usuario=$_SESSION['usuario'];
//$materia=$_GET['materia'];
$cursox= (isset($_GET['curso']) ? $_GET['curso'] : 11);

$cursosHabilitados = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1'order by descripcion ASC,curso ASC,division ASC");
$cursosTodos = "";
while ($cursoH = mysql_fetch_assoc($cursosHabilitados)) $cursosTodos[$cursoH['idcurso']] = $cursoH['descripcion'];

$rr = mysql_query ("SELECT * FROM curso2 where idcurso='$cursox'");
$rr = mysql_fetch_array($rr);

$cursillo=$rr['descripcion'];

/* $resulturno = mysql_query ("SELECT * FROM materiax where curso='$cursillo'");
$cursotext = mysql_fetch_array($resulturno);    */

$_areas = "SELECT * FROM `areas` WHERE idarea NOT LIKE 'a19%' ";
$q_areas = mysql_query($_areas);
$area = [];
while ($__a = mysql_fetch_assoc($q_areas)) $area[$__a['idarea']] =  $__a['descripcion'];

?>

