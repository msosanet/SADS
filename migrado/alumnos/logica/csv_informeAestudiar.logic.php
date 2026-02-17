<?PHP
// Devuelve "Informe A Estudiar.csv" con tabla de alumnos que adeudan los espacios
// solicitados por N.M 219/2023 de la D. P. N. S. con el formato establecido

session_start();
if ($_SESSION['estado']!=1) exit();
include 'conexion.php';

$ext=".csv";
$nombre="informe Plan a Estudiar ".date("Ymd").$ext;
$anio=$_SESSION['cicloLectivo'];

// Conecta a la BD
$conexion = conectar ();

$estAde_q = mysql_query("SELECT DISTINCT previas.alumno FROM `previas`,(SELECT alumno FROM cursa WHERE control = 1 AND ((anio = 2023 AND curso BETWEEN 4 AND 6) OR (anio = 2022 AND curso LIKE 'E'))) AS nuestros WHERE previas.alumno = nuestros.alumno AND nota < 6 AND idmateria IN (47,34,24,43,52,4,6,32,27,20,23) AND materia NOT LIKE '%M.E.%' ");
$estAde = array(); // DNIs de los que adeudan alguno de esos espacios
while($estosSonLosQueAdeudan = mysql_fetch_assoc($estAde_q)) $estAde[] = $estosSonLosQueAdeudan['alumno'];
$espacios = array(47,34,43,24,52,4,6,32,27,20,23);

// Establece el formato del documento como planilla de Excel
header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

 // Establece quién obtuvo el listado
 $usuario = $_SESSION['usuario'];
 $result = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario'");
 $fila = mysql_fetch_array($result) ;

// Nombre y apellido de quiÃ©n obtuvo el listado. Fecha de obtenido
 echo "Listado obtenido el " . date("j/n/Y") . " por " . $fila['nombre'] . " " . $fila['apellido'] . "\n";

 foreach($estAde AS $estudiante){
  $datosPers_q = mysql_query("SELECT * FROM cursa LEFT JOIN alumno ON cursa.alumno = alumno.dni WHERE cursa.alumno = '$estudiante' AND cursa.control = 1");
  foreach($espacios AS $materia) {
   $adeuda_q = mysql_query("SELECT * FROM previas WHERE idmateria = '$materia' AND alumno = '$estudiante' AND nota < 6");
   if (mysql_num_rows($adeuda_q)) $adeudadas[$estudiante][$materia] = 'X';
   else $adeudadas[$estudiante][$materia] = '';
  }
  $datosPers = mysql_fetch_assoc($datosPers_q);
  if ($datosPers['curso'] == 'E') $curso_anterior = 6;
  else $curso_anterior = $datosPers['curso']-1;
// Volcado de datos de la consulta en la tabla 
  echo "$datosPers[anio];";
  echo strtoupper(trim($datosPers['apellido'])) . " " . ucwords(strtolower(trim($datosPers['nombre']))) . ";";
  echo "$datosPers[dni];";
  echo ";";
  echo $curso_anterior."°;";
  echo "$datosPers[anio];";
  echo $adeudadas[$estudiante][47].";";
  echo ";";
  echo $adeudadas[$estudiante][34].";";
  echo ";";
  echo ";";
  echo $adeudadas[$estudiante][43].";";
  echo $adeudadas[$estudiante][24].";";
  echo $adeudadas[$estudiante][52].";";
  echo $adeudadas[$estudiante][4].";";
  echo $adeudadas[$estudiante][6].";";
  echo ";";
  echo ";";
  echo $adeudadas[$estudiante][32].";";
  echo $adeudadas[$estudiante][27].";";
  echo $adeudadas[$estudiante][20].";";
  echo $adeudadas[$estudiante][23]."\n";
 }
?>
