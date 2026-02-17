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



 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<link rel="stylesheet" href="tablas.css" type="text/css" />
	<link rel="stylesheet" href="alerta.css" type="text/css" />
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
	function myFunction() {
	alert("I am an alert box!");
	}
</script>
   
   <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
	<img src="sobral.jpg"></img>
	<style>
	input[type='number'] { font-size: 24px; }
</style>
</head>
<body>
       <div class="page-header">
        <h1>Hola, <b><?php echo htmlspecialchars($nya); ?></b>. Bienvenid@.</h1>
        
    
    <p>
        <a href="reset-password.php" class="btn btn-warning">Cambia tu contraseña</a>
        <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
    </p>
	</div> 
	
	
	<div class="page-header">
    <p>
    </p>
	</div> 

<form method="POST" action="<?=$_SERVER['PHP_SELF']?>" >	
<div align="center">
<table class="blueTable" style="width:60%">
	
	
	
	<thead style="text-align:center !important">
	<tr>
		<td width="100" style="text-align: center;"><label for="nombre"></label></td>
	<td width="100" style="text-align: center;"><label for="nombre"></label></td>

	
	</tr>
	<tr>
	
	<td style="text-align: center;"><label for="nombre">Fecha de la clase</label></td>
	<td style="text-align: center;"><label for="nombre"><input type="date" name="fclase" </label></td>
	
	
	</tr>

	<tr>
	
	<td style="text-align: center;"><label for="nombre">CONTENIDO DE LA CLASE</label></td>
	<td style="text-align: center;"><label for="nombre"><textarea name="contenido" id="contenido" cols="40" rows="4">
</textarea></label></td>
	
	
	</tr>
	<tr>
	
	<td style="text-align: center;"><label for="nombre"></label></td>
	<td style="text-align: center;"><label for="nombre"></label></td>
	
	
	</tr>
	<tr>
	
	<td style="text-align: center;"><label for="nombre">ACTIVIDADES</label></td>
	<td style="text-align: center;"><label for="nombre"><textarea name="acti" id="acti" cols="40" rows="4">
</textarea></label></td>
	
	
	</tr>


	</thead>


	
<tr>
	

	
	
	
	
	
	
	
	
	<input type="hidden" name="alumno[]"  value="<?php echo $crowalu['dni']; ?>"/>

</tr>
<input type="hidden" name="cursox" value="<?php echo $curso;?>"/>
<input type="hidden" name="nyax" value="<?php echo $dni;?>"/>
<input type="hidden" name="materiax" value="<?php echo $materia;?>"/>

	<tr>
		<td align="center" colspan=4>
		<p align="center" style="font-size:16px"><input type="submit" value="     Guardar Libro     " name="submitx" /></p>
		</td>
	</tr>
	<tr>
		<td align="center" colspan=5>
		<a href="welcome.php">Volver</a>
		</td>
	</tr>
<?php if ($cantidadcalif>0) {?>	
<?php /*
	<tr>
		<td align="center" colspan=4>
		<p align="center" style="font-size:16px"><a href="planillaCalificaciones.php?cursox=<?=$curso?>&materiax=<?=$materia?>"  target="_blank">Ver Planilla</a></p> 
		</td>
	</tr> */ ?>
<?php } ?>

</table>
<br><br> <br>  
</div> 


</body>
<?php } ?>
</html>

<?php 
if(isset($_POST["submitx"]))
	{
		
	
	
		$materia=$_POST['materiax'];
		$curso=$_POST['cursox'];
		$nyax=$_POST['nyax'];


		$fclase=$_POST['fclase']; 

		$contenido=$_POST['contenido']; 

		$acti=$_POST['acti']; 

	
		$date = date('Y/m/d H:i:s');


if (mysql_query ("INSERT INTO librotemas VALUES ($nyax,$materia,'$curso','$fclase','$date',$contenido,'$acti',0)"))
	{		

?>
				<script>
					var answer=alert("¡Libro de temas Guardado!")
				</script> 
				<meta http-equiv='refresh' content='0; URL=leg_unif.php?actor=<? echo $dni; ?>'>
				<? 
				
	}
				else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 
				}					




$url = $_SERVER['PHP_SELF'] . "?materia=" . $materia . "&curso=" . $curso;


	
	
} //fin submit
?>