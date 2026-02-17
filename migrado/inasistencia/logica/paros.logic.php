<?PHP

session_start();

/*include 'conexion.php';
$conexion = conectar ();*/
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Reemplaza "login.php" con la URL de tu pÃ¡gina de inicio de sesiÃ³n
    exit();
}
//$conexion = desconectar ();
if ($_POST['seleccion']=='materias')
{include 'conexion3.php';
$conexion = conectar ();

}
if ($_POST['seleccion']=='cargos')
{include 'conexion.php';
$conexion = conectar ();
}



if (isset($_POST['fecha'])) $diadesc = $_POST['fecha'];
else $diadesc = date("Y-m-d");
$fVisible = date("d/m/Y",strtotime($diadesc));;
?>

