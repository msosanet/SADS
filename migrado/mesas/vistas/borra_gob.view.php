<html>

<head>

<title>Borrar</title>
</head>

<body  bgcolor="#ffffff">
<script>
function cierro ()
{
window.close()
}
</script>
<?php

if ($_GET["submit"]==" SI ")
{
			$conexion = conectar ();	
			$codigo=$_GET['codigo'];
			$anio=$_GET['anio'];
			$dni=$_GET['dni'];

			
			if (mysql_query ("delete from mesas where codigo=$codigo and dni='$dni' and anio='$anio'")) 

			{	
				?>
			<script>
				alert("Se elimino correctamente")
				onclick=cierro();
			</script>  
	
				<?php 
			}
				else
					{	
				?>
			<script>
				alert("No se pudo realizar la acción. Comuníquese con el administrador del sistema")
				onclick=cierro();
			</script>  
	
				<?php 
			}
			
}
?>


<form method="GET" action="borra_gob.php">

<body  bgcolor="#FFFFFF">
<div align="center">
<table border="0" width="59%">
	<tr>
		<td>
		<p align="center">
		
		¿Esta seguro que desea borrar la inscripcion <BR><BR>
			<input type="submit" name="submit"  value=" SI " onClick='window.opener.location.reload(true);' style="background-color: #FFFFFF; border-style: solid; border-width: 1">&nbsp;&nbsp;&nbsp;
			<input type=button value="NO" onclick="cierro()" style="background-color: #FFFFFF; border-style: solid; border-width: 1"> 
		<p align="center">
		&nbsp;</td>
	</tr>
</table>
</div>



<input type="hidden" name="codigo" value="<?php echo $_GET['codigo']?>">
<input type="hidden" name="anio" value="<?php echo $_GET['anio']?>">
<input type="hidden" name="dni" value="<?php echo $_GET['dni']?>">

</form>

		  </body>


</html>
<?php } ?>
