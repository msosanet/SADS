<html> 
<head> 
   	<title>Me llamo a mi mismo...</title> 
</head> 

<body> 
<? 
if (!$_POST){ 
?> 
   	<form action="auto-llamada.php" method="post"> 
   	Nombre: <input type="text" name="nombre" size="30"> 
   	<br> 
   	Empresa: <input type="text" name="empresa" size="30"> 
   	<br> 
   	Telefono: <input type="text" name="telefono" size=14 value="+34 " > 
   	<br> 
   	<input type="submit" value="Enviar"> 
   	</form> 
<? 
}else{ 
   	echo "<br>Su nombre: " . $_POST["nombre"]; 
   	echo "<br>Su empresa: " . $_POST["empresa"]; 
   	echo "<br>Su Teléfono: " . $_POST["telefono"]; 
} 
?> 
</body> 
</html>
