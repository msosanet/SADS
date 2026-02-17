<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />


<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Administrador del SID</title>

</head>
<?
include 'header.php';
include 'funciones.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];


?>

<body background="bgris.gif" >


<form id="miFormulario" method="POST" action="plazas3.php">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			
			<div align="center">
			<table border="0" width="980">

<?if ($_SESSION['valor']==1)
{		
include 'menuppal2.php';
}
if ($_SESSION['valor']==0)
{		
include 'menuppal.php';
}
if ($_SESSION['valor']==3) 
{		
include 'menuppal3.php';
}
?>	


			</table>
			</div>
			

			</td>
		</tr>
	</table>
</div>
<br>
<h2>PLAZAS</h2>
<br><br>
<input type="text" id="busqueda" placeholder="Buscar..." value='<?php echo $_GET['busqueda']; ?>' />
	<div align="center">
		<table border="1" width="980" bgcolor="#FFFFFF">
			
			<tr><td align="center" colspan="8">
				<label for="checkbox1">Mostrar Todos</label>
			<?if ($_GET['activos']==1)	echo "<input type='checkbox' id='checkbox1' name='activos' value='0' onclick='enviarFormulario()' checked>";
			  else echo "<input type='checkbox' id='checkbox1' name='activos' value='1' onclick='enviarFormulario()'>";
			?>
			</td></tr>
			
			<tr>
			
	
		<script>
				function enviarFormulario() {
					var checkbox = document.getElementById("checkbox1");
					var form = document.getElementById("miFormulario");
					// Ajusta el valor de 'activos' según el estado del checkbox
					if (checkbox.checked) {
						form.action = "plazas3.php?activos=1";
						checkbox.value = 0;
					} else {
						form.action = "plazas3.php?activos=0";
						checkbox.value = 1;
					}
					form.submit();
				}
			</script>
			
	<?	
	$sqlCar = "SELECT * FROM caracter ORDER BY codigo ASC";
	$resultCar = mysql_query($sqlCar);	
	while ($rowCar = mysql_fetch_assoc($resultCar))
	{	
	if ($rowCar['codigo']==1) $color="style='background-color: green;'";
	if ($rowCar['codigo']==2) $color="style='background-color: blue;'";
	if ($rowCar['codigo']==3) $color="style='background-color: yellow;'";
	if ($rowCar['codigo']==4) $color="style='background-color: orange;'";
	if ($rowCar['codigo']==10) $color="style='background-color: grey;'";
	
	
	
	echo "<td align=center ".$color.">";
	echo $rowCar['descripcion'];
	echo "</td>";
	}
			echo "</tr>";
		echo "</table>";
	echo "</div>";
			
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script>
	$(document).ready(function() {
    var activos = "<?php echo isset($_GET['activos']) ? $_GET['activos'] : ''; ?>";
    
    // Llamada inicial para cargar datos al cargar la página
    $.ajax({
        url: "buscar_plazas.php",
        method: "GET",
        data: { busqueda: '', activos: activos },
        success: function(data) {
            $("#tabla_resultados").html(data);
        }
    });

    $("#busqueda").on("input", function() {
        var valor = $(this).val();

        if (valor === "") {
            // Llamar a buscar_plazas.php con activos=0 y busqueda=''
            $.ajax({
                url: "buscar_plazas.php",
                method: "GET",
                data: { busqueda: '', activos: 0 },
                success: function(data) {
                    $("#tabla_resultados").html(data);
                }
            });
        } else {
            // Proceder con la búsqueda normal
            $.ajax({
                url: "buscar_plazas.php",
                method: "GET",
                data: { busqueda: valor, activos: activos },
                success: function(data) {
                    $("#tabla_resultados").html(data);
                }
            });
        }
    });
});
		</script>

<?

//include 'buscar_plazas.php';

?>



<div align="center" id="tabla_resultados"></div>





</form>
 </td>

</div>

</body>
<footer>
      <br><br><br>
	  <?	include 'footer.php';?>
    </footer>
</html>

<? } ?>