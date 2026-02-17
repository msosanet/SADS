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
			$codigo$_GET['codigo'];
			$anio=$_GET['anio'];
			$dni=$_GET['dni'];


			
			if (mysql_query ("delete from mesas where codigo=$codigo and anio='$anio' and dni='$dni'")) 

			{	
				php?>
			<script>
				alert("Se elimino correctamente")
				onclick=cierro();
			</script>  
	
				<?php 
			}
				else
					{	
				php?>
			<script>
				alert("No se pudo realizar la acción. Comuníquese con el administrador del sistema")
				onclick=cierro();
			</script>  
	
				<?php 
			}
			
}
php?>


<form method="GET" action="borrarme.php">

<body  bgcolor="#FFFFFF">
<div align="center">
<table border="0" width="59%">
	<tr>
		<td>
		<p align="center">
		<img border="0" src="header.jpg" width="32" height="32"><p align="center">
		¿Esta seguro que desea borrar la Nota Gob? <BR><BR>
			<input type="submit" name="submit"  value=" SI " onClick='window.opener.location.reload(true);' style="background-color: #FFFFFF; border-style: solid; border-width: 1">&nbsp;&nbsp;&nbsp;
			<input type=button value="NO" onclick="cierro()" style="background-color: #FFFFFF; border-style: solid; border-width: 1"> 
		<p align="center">
		&nbsp;</td>
	</tr>
</table>
</div>



<input type="hidden" name="codigo" value="<?php echo $_GET['codigo'] php?>">
<input type="hidden" name="anio" value="<?php echo $_GET['anio'] php?>">
<input type="hidden" name="dni" value="<?php echo $_GET['dni'] php?>">

</form>

</body>


</html>
<?php } php?>
