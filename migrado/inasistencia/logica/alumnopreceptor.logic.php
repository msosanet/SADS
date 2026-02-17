<?PHP
session_start();
if ($_SESSION['estado']==1) {
	
$diasDeSemana = [false,"Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo"];

include 'conexion55.php';

$conexion = conectaralumnos ();
$actor = (isset($_GET["dni"])) ? $_GET["dni"] : 0;


$resultt = mysql_query ("SELECT * FROM alumno WHERE dni = $actor");
$filatt = mysql_fetch_array($resultt);
if (!mysql_num_rows($resultt)) {
	echo "<h1>No existe el estudiante</h1><meta http-equiv='refresh' content='2; URL=menu.php'>";
	exit();
}


$resulcc = mysql_query ("SELECT * FROM folio WHERE dni = $actor");
$filacc = mysql_fetch_array($resulcc);

$q_cd = mysql_query ("SELECT * FROM cursa WHERE alumno = $actor AND control = 1 ORDER BY anio DESC");
if (mysql_num_rows($q_cd)) {
 $cur_div = mysql_fetch_assoc($q_cd);
 $cd = $cur_div['curso'] . $cur_div['divi'];
}

//------------------------------------------------

function busca_edad($fecha_nacimiento){
$dia=30;
$mes=06;
$ano=date("Y");


$dianaz=date("d",strtotime($fecha_nacimiento));
$mesnaz=date("m",strtotime($fecha_nacimiento));
$anonaz=date("Y",strtotime($fecha_nacimiento));


//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual

if (($mesnaz == $mes) && ($dianaz > $dia)) {
$ano=($ano-1); }

//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual

if ($mesnaz > $mes) {
$ano=($ano-1);}

 //ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad

$edad=($ano-$anonaz);


return $edad;


}

$anio=date("Y");

$color = "";

$hayerrores = 0;

  $flag = 0;
  if (isset($_GET["submitx"])) {
     // verifico los errores en los campos




}
 else
  {
    $flag = 1;
  }

if ($hayerrores OR $flag) {
?>

