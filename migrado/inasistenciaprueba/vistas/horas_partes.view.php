<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Language" content="es-ar">
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <link rel="stylesheet" type="text/css" href="style2.css" />

<title>HORARIO DE CURSOS</title>
</head>

<body>

<!-- *********** FORMULARIO CARGA HORA ***************** -->
<div>

<form action="horas_partes.php" method="post" name="form1">

    <p class="titulo" align="center">NUEVA ENTRADA DE HORARIO</p>
    <hr>
    <p>&nbsp;</p>

    <p>DIA SEMANA:
    <select name="dia_sem">
        <option value="" selected>&nbsp;</option>
        <option value="lun">Lunes</option>
        <option value="mar">Martes</option>
        <option value="mie">Miércoles</option>
        <option value="jue">Jueves</option>
        <option value="vie">Viernes</option>
    </select>
    </p>
    <p>TURNO:
    <select name="turno">
        <option value="" selected>&nbsp;</option>
        <option value="M">Mañana</option>
        <option value="T">Tarde</option>
        <option value="V">Vespertino</option>
    </select>
    &nbsp;
    AÑO: <select name="anio">
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
    DIVISIÓN: <select name="division">
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
    </select>

    <p>ORDEN: <select name="orden">
        <option value="" selected>&nbsp;</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
    </select>
    &nbsp;
    HORA:   <select name="hora">
            <option value="" selected>&nbsp;</option>
            <option value="Pre1">Pre1</option>
            <option value="Pre2">Pre2</option>
            <option value="1">1ª</option>
            <option value="2">2ª</option>
            <option value="3">3ª</option>
            <option value="4">4ª</option>
            <option value="5">5ª</option>
            <option value="6">6ª</option>
            <option value="7">7ª</option>
            <option value="8">8ª</option>
    </select>
    </p>

    <p>ESPACIO CURRICULAR:
    <?
    $conexion = conectar();
    $espacios_all = mysql_query ("SELECT * FROM espacios_curriculares ORDER BY espacio ASC");
    $docentes_all = mysql_query ("SELECT * FROM docentes ORDER BY apellido ASC");

    ?>
    <select name="esp_curric">
    <?
    while ($espacio = mysql_fetch_array ($espacios_all)) {
        echo "<option value='" . $espacio[espacio] . "'>" . $espacio[espacio] . "</option>";
        }
    ?>
    </select>

    <!-- input type="text" name="esp_curric" -->
    &nbsp;
    DOCENTE:
     <select name="docente">
    <?
    while ($docente = mysql_fetch_array ($docentes_all)) {
        echo "<option value='" . $docente[apellido] . " " . $docente[nombre]. "'>" . $docente[apellido] . " " . $docente[nombre] . "</option>";
        }
    ?>
    </select>


    </p>
    <input type="submit" name="Submit" value="     Guardar     ">

</form>  <!-- ************* FIN FORMULARIO ******************** -->

<!-- *********** GRABAR CONTENIDO DEL FORMULARIO ************* -->
<?
    $mysqli = mysqli_connect("localhost","fgoicoechea","sobral2011","sid");
    if(isset($_POST['Submit'])) {
    $dia_sem = $_POST['dia_sem'];
    $turno = $_POST['turno'];
    $anio = $_POST['anio'];
    $division = $_POST['division'];
    $orden = $_POST['orden'];
    $hora = $_POST['hora'];
    $esp_curric = $_POST['esp_curric'];
    $docente = $_POST['docente'];


    $conexion = conectar ();

        // checking empty fields
        if(empty($turno)) {
            if(empty($turno)) {
                echo "<font color='red'>El campo turno est&aacute; vac&iacute;o.</font><br/>";
            }

            //link to the previous page
            echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
        } else {
            // if all the fields are filled (not empty)
            //insert data to database
            $grabacaso = mysqli_query($mysqli, "INSERT INTO horas_partes VALUES(0,'$dia_sem','$turno', '$anio', '$division', '$orden', '$hora', '$esp_curric', '$docente')");
            echo $esp_curric . " " . $docente;

            //*************** MUESTRA MENSAJE GRABACIÓN EXITOSA **************
              ?>
				<script>
				var answer=alert("Datos Grabados Correctamente ")
				</script>
				<meta http-equiv='refresh' content='0; URL=horas_partes.php'>
				<?

        }
    }
?>
<!-- ************************************** MUESTRA HORARIO ********************************* -->
<br><br>
<form name="consultahorarios" method="GET" action="horas_partes.php">
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
    DIVISIÓN: <select name="division">
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
    </select>
    <input type="submit" name="submit" value="     VER HORARIO     ">


</p>
</form>
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
<!-- ***********************************FIN MUESTRA HORARIO ******************************* -->

    <!-- able name="1º1ª" border="1" cellspacing="0">
        <tr height="30" bgcolor="#cccccc" align="center">
            <td width="20" rowspan="2">ORD</td>
            <td width="20" rowspan="2">HORA</td>
            <td width="100" colspan="2">LUNES</td>
            <td width="100" colspan="2">MARTES</td>
            <td width="100" colspan="2">MIERCOLES</td>
            <td width="100" colspan="2">JUEVES</td>
            <td width="100" colspan="2">VIERNES</td>
        </tr>
        <tr height="40" bgcolor="#cccccc" align="center">
            <td>Espacio<br>Curricular</td>
            <td>Docente</td>
            <td>Espacio<br>Curricular</td>
            <td>Docente</td>
            <td>Espacio<br>Curricular</td>
            <td>Docente</td>
            <td>Espacio<br>Curricular</td>
            <td>Docente</td>
            <td>Espacio<br>Curricular</td>
            <td>Docente</td>

        </tr>
        <tr height="40" align="center">
            <td width="20">1</td>
            <td width="20">
                <select name="hora">
                <option value="" selected>&nbsp;</option>
                <option value="Pre1">Pre1</option>
                <option value="Pre2">Pre2</option>
                <option value="1">1ª</option>
                <option value="2">2ª</option>
                <option value="3">3ª</option>
                <option value="4">4ª</option>
                <option value="5">5ª</option>
                <option value="6">6ª</option>
                <option value="7">7ª</option>
                <option value="8">8ª</option>
                </select>
            </td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
        </tr>
        <tr height="40" align="center">
            <td width="20">2</td>
            <td width="20">
                <select name="hora">
                <option value="" selected>&nbsp;</option>
                <option value="Pre1">Pre1</option>
                <option value="Pre2">Pre2</option>
                <option value="1">1ª</option>
                <option value="2">2ª</option>
                <option value="3">3ª</option>
                <option value="4">4ª</option>
                <option value="5">5ª</option>
                <option value="6">6ª</option>
                <option value="7">7ª</option>
                <option value="8">8ª</option>
                </select>
            </td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
        </tr>
        <tr height="40" align="center">
            <td width="20">3</td>
            <td width="20">
                <select name="hora">
                <option value="" selected>&nbsp;</option>
                <option value="Pre1">Pre1</option>
                <option value="Pre2">Pre2</option>
                <option value="1">1ª</option>
                <option value="2">2ª</option>
                <option value="3">3ª</option>
                <option value="4">4ª</option>
                <option value="5">5ª</option>
                <option value="6">6ª</option>
                <option value="7">7ª</option>
                <option value="8">8ª</option>
                </select>
            </td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
        </tr>
        <tr height="40" align="center">
            <td width="20">4</td>
            <td width="20">
                <select name="hora">
                <option value="" selected>&nbsp;</option>
                <option value="Pre1">Pre1</option>
                <option value="Pre2">Pre2</option>
                <option value="1">1ª</option>
                <option value="2">2ª</option>
                <option value="3">3ª</option>
                <option value="4">4ª</option>
                <option value="5">5ª</option>
                <option value="6">6ª</option>
                <option value="7">7ª</option>
                <option value="8">8ª</option>
                </select>
            </td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
        </tr>
        <tr height="40" align="center">
            <td width="20">5</td>
            <td width="20">
                <select name="hora">
                <option value="" selected>&nbsp;</option>
                <option value="Pre1">Pre1</option>
                <option value="Pre2">Pre2</option>
                <option value="1">1ª</option>
                <option value="2">2ª</option>
                <option value="3">3ª</option>
                <option value="4">4ª</option>
                <option value="5">5ª</option>
                <option value="6">6ª</option>
                <option value="7">7ª</option>
                <option value="8">8ª</option>
                </select>
            </td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
        </tr>
        <tr height="40" align="center">
            <td width="20">6</td>
            <td width="20">
                <select name="hora">
                <option value="" selected>&nbsp;</option>
                <option value="Pre1">Pre1</option>
                <option value="Pre2">Pre2</option>
                <option value="1">1ª</option>
                <option value="2">2ª</option>
                <option value="3">3ª</option>
                <option value="4">4ª</option>
                <option value="5">5ª</option>
                <option value="6">6ª</option>
                <option value="7">7ª</option>
                <option value="8">8ª</option>
                </select>
            </td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
        </tr>
        <tr height="40" align="center">
            <td width="20">7</td>
            <td width="20">
                <select name="hora">
                <option value="" selected>&nbsp;</option>
                <option value="Pre1">Pre1</option>
                <option value="Pre2">Pre2</option>
                <option value="1">1ª</option>
                <option value="2">2ª</option>
                <option value="3">3ª</option>
                <option value="4">4ª</option>
                <option value="5">5ª</option>
                <option value="6">6ª</option>
                <option value="7">7ª</option>
                <option value="8">8ª</option>
                </select>
            </td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
        </tr>
        <tr height="40" align="center">
            <td width="20">8</td>
            <td width="20">
                <select name="hora">
                <option value="" selected>&nbsp;</option>
                <option value="Pre1">Pre1</option>
                <option value="Pre2">Pre2</option>
                <option value="1">1ª</option>
                <option value="2">2ª</option>
                <option value="3">3ª</option>
                <option value="4">4ª</option>
                <option value="5">5ª</option>
                <option value="6">6ª</option>
                <option value="7">7ª</option>
                <option value="8">8ª</option>
                </select>
            </td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
        </tr>
        <tr height="40" align="center">
            <td width="20">9</td>
            <td width="20">
                <select name="hora">
                <option value="" selected>&nbsp;</option>
                <option value="Pre1">Pre1</option>
                <option value="Pre2">Pre2</option>
                <option value="1">1ª</option>
                <option value="2">2ª</option>
                <option value="3">3ª</option>
                <option value="4">4ª</option>
                <option value="5">5ª</option>
                <option value="6">6ª</option>
                <option value="7">7ª</option>
                <option value="8">8ª</option>
                </select>
            </td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
        </tr>
        <tr height="40" align="center">
            <td width="20">10</td>
            <td width="20">
                <select name="hora">
                <option value="" selected>&nbsp;</option>
                <option value="Pre1">Pre1</option>
                <option value="Pre2">Pre2</option>
                <option value="1">1ª</option>
                <option value="2">2ª</option>
                <option value="3">3ª</option>
                <option value="4">4ª</option>
                <option value="5">5ª</option>
                <option value="6">6ª</option>
                <option value="7">7ª</option>
                <option value="8">8ª</option>
                </select>
            </td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
            <td><textarea rows="2"= cols="10" name="1"></textarea></td>
        </tr>
    </table -->
</div>





</body>

</html>
