<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexioncalif.php';
$conexion = conectarcalif ();
$usuario=$_SESSION['usuario'];

$instancia = 4;

$cursox= (isset($_GET['curso']) ? $_GET['curso'] : false);
$cursox= (isset($_POST['curso']) ? $_POST['curso'] : $cursox);


//Nombre de cursos
$cursosHabilitados = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1'order by descripcion ASC,curso ASC,division ASC");
$cursosTodos = "";
while ($cursoH = mysql_fetch_assoc($cursosHabilitados)) {
	$cursosTodos[$cursoH['idcurso']] = $cursoH['descripcion'];
	if ($cursox == $cursoH['idcurso']) {
		$curso =  $cursoH['curso'];
		$division = $cursoH['division'];
	}
}

if (isset($_POST["submitx"])) //habilita la carga para cada materia
{
 $insertadas = [];
 $habilitar=$_POST['habilitar'];
 $finPlazo = date("Y-m-d H:i:s",strtotime("+6 hours"));

 foreach ($habilitar AS $idmat) {
	 $q_habilitar = "INSERT INTO `plazoscarga`(`desde`, `hasta`, `instancia`, `curso`, `division`, `materia`, `quien`) VALUES (CURRENT_TIMESTAMP(),'$finPlazo','$instancia','$curso','$division','$idmat','$usuario')";
	 $insertadas[] = (mysql_query($q_habilitar) ? $idmat : 0);
 }

}



//Instancia a habilitar
$q_instancia = "SELECT * FROM `calificaciones` WHERE `id` = ".$instancia;
$_instancia = mysql_query($q_instancia);
while($_inst = mysql_fetch_assoc($_instancia)) $nomInstancia = [$_inst['abreviado'],$_inst['obs']];

//Ya habilitadas
$inicioPlazo = date("Y-m-d 23:59:59");

$q_habilitadas = "SELECT * FROM `plazoscarga` WHERE desde < '".$inicioPlazo."'  AND `hasta` > CURRENT_TIMESTAMP() AND `instancia` = ".$instancia." AND `curso` = '" . $curso . "' AND `division` = '" . $division . "'";
$habilitadas = mysql_query($q_habilitadas);
$habHasta = [];
while ($h = mysql_fetch_assoc($habilitadas)) $habHasta[$h['materia']] = $h['hasta'];

$espDeSecc = NULL;
$result79 = mysql_query ("SELECT m.descripcion,mc.idcurso,mc.idmateria FROM matcur mc, materias m WHERE mc.idmateria=m.idmateria AND mc.idcurso='$cursox' AND mc.idmateria!=65");
while ($fila79 = mysql_fetch_array($result79)) $espDeSecc[] = $fila79;

?>

