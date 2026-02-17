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
        <a href="reset-password.php" class="btn btn-warning">Cambia tu contraseÃ±a</a>
        <a href="logout.php" class="btn btn-danger">Cerrar sesiÃ³n</a>
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
					var answer=alert("Â¡Libro de temas Guardado!")
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
