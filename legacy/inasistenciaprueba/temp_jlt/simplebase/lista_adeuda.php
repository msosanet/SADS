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

</head>

<body>

<?php
// Establece conexión con la base de datos;

include "conecta.php";
?>

<!-- *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*- -->
<form method="GET" action="lista_adeuda.php">

<table bgcolor="DDDDDD" border="0" cellspacing="0" width="30%" align="center">
	<tr align="center" height="30">
		<!-- td>Curso: <input type="text" name="curso1" id="curso1" size="2" maxlength="2" value="" autofocus></td -->
		<!-- td>Ingrese la Div: <input type="text" name="div" id="div" size="2" maxlength="2" value=""></td -->
		<td>Curso<select name="curso">
			<option value="">- -</option>
			<option value="2">2º</option>
			<option value="3">3º</option>
			<option value="4">4º</option>
			<option value="5">5º</option>
			<option value="7">6º</option>
			</select> 
		</td>
		<td>División<select name="div">
			<option value="" selected>- -</option>
			<option value="1">1ª</option>
			<option value="2">2ª</option>
			<option value="3">3ª</option>
			<option value="4">4ª</option>
			<option value="5">5ª</option>
			<option value="6">6ª</option>
			<option value="7">7ª</option>
			<option value="8">8ª</option>
			<option value="9">9ª</option>
			<option value="10">10ª</option>
			<option value="11">11ª</option>
			</select> 
		</td>
		<td><input type="submit" value="Buscar" name="muestra2"></td>
	</tr>
</table>

<!-- *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*- -->
<?
	if (isset($_GET['muestra2']))
{ 
	$curso=$_GET['curso'];
	$div=$_GET['div'];


$sql = "SELECT alumno, dni, curso, division, adeuda FROM alumnos WHERE adeuda <> 'Ninguna' AND curso LIKE '$curso' AND division LIKE '$div' ORDER BY alumno";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

// output data of each row
?>    
<table align="center" border="0" id="table1" cellpadding="2" cellspacing="2" bordercolor="#C0C0C0" font="Arial">
						<tr bgcolor="#CCCCCC" height="36">
							<td width="10" align="center">CUR</td>
							<td width="10" align="center">DIV</td>
							<td width="90" align="center">D.N.I.</td>
							<td width="300" align="center">ALUMNO</td>
							<td width="600" align="center" >MATERIAS QUE ADEUDA</td>
						</tr>
<?php
    while($row = $result->fetch_assoc()) {
?>
        <tr bgcolor="#FFFFFF">
            <td height="25" align="center"><?echo $row["curso"]?>º</td>
            <td align="center"><?echo $row["division"]?>ª</td>
            <td width="5" align="center"><?echo $row["dni"]?></td>
            <td><?echo $row["alumno"]?></td>
            <td><?echo $row["adeuda"]?></td>
        </td>
<?}
} else {
    echo "0 results";
	echo $curso;
}
$conn->close();
?>
</table>
<?
}
	?>
</form>
</body>
</html>
