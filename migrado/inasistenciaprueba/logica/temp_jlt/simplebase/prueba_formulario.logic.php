<html>
<head>
<title>ALUMNOS QUE ADEUDAN ESPACIOS</title>
<style>

body {
    background-color: linen;
}

h1 {
    color: maroon;
    margin-left: 40px;
}
p {
    font-family: Arial;
}
table {
    font-family: sans-serif;
}

</style>
<body>
VER QUE PASA

<form action="form_test.php" method="post">

<table border="1" cellspacing="0" width="18%">
	<tr>
		<td>Curso: <input type="text" name="curso" id="curso" size="2" maxlength="2" value="" /></td>
	</tr>
	<tr>
		<td>Ingrese la Div: <input type="text" name="div" id="div" size="2" maxlength="2" value="" /></td>
	</tr>
	<tr>
		<td><textarea name="areatexto" rows="10" cols="30">The cat was playing in the garden.</textarea></td>
	</tr>		
	<tr>
		<td><input type="submit" value="   Buscar   "></td>
	</tr>

<?php
    
	$curso = $_POST['curso'];
	$div = $_POST['div'];
	$texto = $_POST['areatexto'];
?>

</table>
</form>
</body>
</html>

