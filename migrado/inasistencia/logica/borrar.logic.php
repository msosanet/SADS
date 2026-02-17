<?php
// Initialize the session
// calificadores-bdprueba por calificadores 



session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

//include "configbasesobral.php";
//require_once "config.php";
//require_once "configalumnos.php";
require_once "config.php";

function validarFecha($fechax)
		{
		$fechades = date("j,n,Y",strtotime($fechax)); 
		$valores = explode(",",$fechades);
		$diaF = $valores[0];
		$mesF = $valores[1];
		$anoF = $valores[2];
		/*echo "dia".$diaF."mes:".$mesF."ano".$anoF;
		echo "valor:".checkdate($diaF,$mesF,$anoF);		*/
		return checkdate($mesF,$diaF,$anoF);
		}


$titulo = "Calificadores - Colegio Sobral";





if (isset($_GET['materia']) or isset($_GET['curso']))
	{
	$materia=$_GET['materia'];
	$curso=$_GET['curso'];
	}
else {
	$materia=$_POST['materiax'];
	$curso=$_POST['cursox'];
	}

//DATOS DEL DOCENTE
$sql = "SELECT * FROM docente WHERE dni='$_SESSION[dni]' ";
$result = mysqli_query($linkcalif, $sql);
while($crow = mysqli_fetch_assoc($result))
	{	
	$nya=$crow['apellido'].' '.$crow['nombre'];
	
	}
$dni=$crow[dni];

//$nya=$_GET['nyax'];


//DATOS DEL CURSO
$sqlcur = "SELECT * FROM curso2 WHERE idcurso='$curso'  ";

$resultcur = mysqli_query($linkcalif, $sqlcur);
while($crowcur = mysqli_fetch_assoc($resultcur))
{	
$cur=$crowcur['curso'];
$divi=$crowcur['division'];
$turno=$crowcur['turno'];
$cursodesc=$crowcur['descripcion'];
}

//DATOS DE LA MATERIA

$sqlmat = "SELECT * FROM materias WHERE idmateria='$materia'  ";
//echo $sql;
$resultmat = mysqli_query($linkcalif, $sqlmat);
while($crowmat = mysqli_fetch_assoc($resultmat))
{	
$matdesc=$crowmat['descripcion'];
}


$titulo = $cursodesc.': '.$matdesc;


//	chequeamos que no se cambie el curso ni la materia
$sqlesta = "SELECT * FROM matcur WHERE iddocente='$_SESSION[dni]' AND idmateria='$materia' AND idcurso='$curso'";
$resultesta = mysqli_query($linkcalif, $sqlesta);
$esta=mysqli_num_rows($resultesta);
//echo $esta;

if ($esta==0)
{


header("location: welcome.php");
exit;	
}
else 
{
/*$habilitado='';
$habilitado2="disabled";*/
?>



 

