<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexion.php';

//Calcula el numero de dias entre dos fechas.
// Da igual el formato de las fechas (dd-mm-aaaa o aaaa-mm-dd),
// pero el caracter separador debe ser un guión.
function diasEntreFechas($fechainicio, $fechafin){
    return (((strtotime($fechafin)-strtotime($fechainicio))/86400)+1);
}
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$dni=$_GET['actor'];
//$identificacion=$_GET['ident'];


$hora=date("H:i:s");

$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente);

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario);


$resultplaza = mysql_query ("SELECT * FROM materia_cargo WHERE activo=1 order by plaza
");

$resultmotivo = mysql_query ("SELECT * FROM motivos where codigo <> 47 order by descripcion");

$errordoc = 0;
  $hayerrores = 0;


  if (!isset($_POST["submitx"])) {
$_POST['d']=date("d");
$_POST['m']=date("m");
$_POST['a']=date("Y");
$_POST['d2']=date("d");
$_POST['m2']=date("m");
$_POST['a2']=date("Y");
$_POST['hora']=$hora;


}


  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos

     if (trim($_POST["d"]) == '') { $errorfecha = 1; $hayerrores = 1; };
     if (trim($_POST["m"]) == '') { $errorfecha = 1; $hayerrores = 1; };
     if (trim($_POST["a"]) == '') { $errorfecha = 1; $hayerrores = 1; };
     if (trim($_POST["d2"]) == '') { $errorfecha2 = 1; $hayerrores = 1; };
     if (trim($_POST["m2"]) == '') { $errorfecha2 = 1; $hayerrores = 1; };
     if (trim($_POST["a2"]) == '') { $errorfecha2 = 1; $hayerrores = 1; };
     if (trim($_POST["hora"]) == '') { $errorhora = 1; $hayerrores = 1; };

}
 else
  {
    $flag = 1;
  }

if ($hayerrores OR $flag) {

?>

