<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Language" content="es-ar">
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <link rel="stylesheet" type="text/css" href="style2.css" />

<title>HORARIO DE CURSOS</title>
</head>

<body>


<div align="center">
<p class="titulo">CONSULTA DE HORARIO DE CURSOS</p>
<hr>

<p>&nbsp;</p>
<form name="consultahorarios" method="GET" action="horas_partes_ver.php">
<p>AÑO: <select name="anio">
        <option value="" selected>&nbsp;</option>
        <option value="1">1º</option>
        <option value="2">2º</option>
        <option value="3">3º</option>
        <option value="4">4º</option>
        <option value="5">5º</option>
        <option value="6">6º</option>
        <option value="A">A</option>
    </select>
    &nbsp;
    DIVISIÓN:
     <?
    $conexion = conectar();
    $divisiones_all = mysql_query ("SELECT * FROM horas_partes_cursos WHERE anio = '$_GET[anio]'");
    ?>

    <select name="division">
        <option value="" selected>&nbsp;</option>

    <?
    while ($division = mysql_fetch_array ($divisiones_all)) {
        echo "<option value='" . $division['division'] . "'>" . $division['division'] . "</option>";
        }
    ?>
    </select>



    <!-- select name="division">
        <option value="" selected>&nbsp;</option>
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
        <option value="A">A</option>
    </select -->

    <input type="submit" name="submit" value="     VER HORARIO     ">
</p>
</form>
<p>&nbsp;</p>

<?
    $conexion = conectar ();
    $anio = $_GET['anio'];
    $division = $_GET['division'];
    echo "<p align='center' class='titulo'>" . $anio . "º / " . $division . "ª</p>";

    $horas_todas = mysql_query ("SELECT * FROM horas_partes WHERE anio = '$anio' AND division = '$division'");

?>

<table border="1" cellspacing="0">
    <tr align="center" height="35">
        <td width="10">HORARIO</td>
        <td width="10">HORA</td>
        <td width="200" colspan="2">LUNES</td>
        <td width="200" colspan="2">MARTES</td>
        <td width="200" colspan="2">MIÉRCOLES</td>
        <td width="200" colspan="2">JUEVES</td>
        <td width="200" colspan="2">VIERNES</td>
    </tr>
<?  while ($hora_curso = mysql_fetch_array($horas_todas)) {
?>
    <tr align="center" height="35">
        <td><? echo $hora_curso[horario]; ?></td>
        <td><? echo $hora_curso[hora]; ?></td>
        <td width="100"><? echo $hora_curso[lun_esp_curric]; ?></td>
        <td width="100"><b><? echo $hora_curso[lun_docente]; ?></b></td>
        <td width="100"><? echo $hora_curso[mar_esp_curric]; ?></td>
        <td width="100"><b><? echo $hora_curso[mar_docente]; ?></b></td>
        <td width="100"><? echo $hora_curso[mie_esp_curric]; ?></td>
        <td width="100"><b><? echo $hora_curso[mie_docente]; ?></b></td>
        <td width="100"><? echo $hora_curso[jue_esp_curric]; ?></td>
        <td width="100"><b><? echo $hora_curso[jue_docente]; ?></b></td>
        <td width="100"><? echo $hora_curso[vie_esp_curric]; ?></td>
        <td width="100"><b><? echo $hora_curso[vie_docente]; ?></b></td>
    </tr>
<?
}
?>

</table>
</div>





</body>

</html>
