<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Language" content="es-ar">
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <link rel="stylesheet" type="text/css" href="style2.css" />

<title>HORARIOS DE CURSOS</title>
</head>

<body>


<div align="center">
<p class="titulo">COPIA DATOS DE ASIGNATURAS DE FOX A MYSQL</p>
<hr>
<?php
$mysqli = mysql_connect("localhost","joseluis","jeossoej");
mysql_select_db("DBF2MYSQL");
$vertabla = mysql_query("SELECT * FROM asignaturas WHERE turno = 'm' AND curso = 7 AND division = 1");
?>
<table border="1" cellspacing="0">
    <tr align="center">
        <td rowspan="2">CURSO</td>
        <td rowspan="2">DIVIS</td>
        <td rowspan="2">TURNO</td>
        <td rowspan="2">ESPACIO CURRICULAR</td>
        <td colspan="8">LUNES</td>
        <td rowspan="2"> </td>
        <td colspan="8">MARTES</td>
        <td rowspan="2"> </td>
        <td colspan="8">MIÉRCOLES</td>
        <td rowspan="2"> </td>
        <td colspan="8">JUEVES</td>
        <td rowspan="2"> </td>
        <td colspan="8">VIERNES</td>
        <td rowspan="2"> </td>
        <td rowspan="2">NOMBRE</td>
    </tr>
    <tr align="center">
        <td>1ª</td>
        <td>2ª</td>
        <td>3ª</td>
        <td>4ª</td>
        <td>5ª</td>
        <td>6ª</td>
        <td>7ª</td>
        <td>8ª</td>
        <td>1ª</td>
        <td>2ª</td>
        <td>3ª</td>
        <td>4ª</td>
        <td>5ª</td>
        <td>6ª</td>
        <td>7ª</td>
        <td>8ª</td>
        <td>1ª</td>
        <td>2ª</td>
        <td>3ª</td>
        <td>4ª</td>
        <td>5ª</td>
        <td>6ª</td>
        <td>7ª</td>
        <td>8ª</td>
        <td>1ª</td>
        <td>2ª</td>
        <td>3ª</td>
        <td>4ª</td>
        <td>5ª</td>
        <td>6ª</td>
        <td>7ª</td>
        <td>8ª</td>
        <td>1ª</td>
        <td>2ª</td>
        <td>3ª</td>
        <td>4ª</td>
        <td>5ª</td>
        <td>6ª</td>
        <td>7ª</td>
        <td>8ª</td>
    </tr>

<?
    while ($fila = mysql_fetch_array($vertabla)) {
            echo "<tr>
                    <td align='center'>" . $fila[curso] . "</td>
                    <td align='center'>" . $fila[division] . "</td>
                    <td align='center'>" . $fila[turno] . "</td>
                    <td align='left'>" . $fila[espcur] . "</td>";

           //************ empieza LUNES *************************

            if ($fila[lu1] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[lu1] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[lu1] . "</td>";
            }
            if ($fila[lu2] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[lu2] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[lu2] . "</td>";
            }
            if ($fila[lu3] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[lu3] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[lu3] . "</td>";
            }
            if ($fila[lu4] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[lu4] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[lu4] . "</td>";
            }
            if ($fila[lu5] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[lu5] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[lu5] . "</td>";
            }
            if ($fila[lu6] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[lu6] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[lu6] . "</td>";
            }
            if ($fila[lu7] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[lu7] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[lu7] . "</td>";
            }
            if ($fila[lu8] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[lu8] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[lu8] . "</td>";
            }
                echo "<td align='left'> </td>";

           //************ empieza MARTES *************************

            if ($fila[ma1] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[ma1] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[ma1] . "</td>";
            }
            if ($fila[ma2] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[ma2] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[ma2] . "</td>";
            }
            if ($fila[ma3] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[ma3] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[ma3] . "</td>";
            }
            if ($fila[ma4] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[ma4] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[ma4] . "</td>";
            }
            if ($fila[ma5] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[ma5] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[ma5] . "</td>";
            }
            if ($fila[ma6] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[ma6] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[ma6] . "</td>";
            }
            if ($fila[ma7] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[ma7] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[ma7] . "</td>";
            }
            if ($fila[ma8] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[ma8] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[ma8] . "</td>";
            }
                echo "<td align='left'> </td>";

           //************ empieza MIÉRCOLES *************************

            if ($fila[mi1] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[mi1] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[mi1] . "</td>";
            }
            if ($fila[mi2] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[mi2] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[mi2] . "</td>";
            }
            if ($fila[mi3] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[mi3] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[mi3] . "</td>";
            }
            if ($fila[mi4] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[mi4] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[mi4] . "</td>";
            }
            if ($fila[mi5] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[mi5] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[mi5] . "</td>";
            }
            if ($fila[mi6] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[mi6] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[mi6] . "</td>";
            }
            if ($fila[mi7] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[mi7] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[mi7] . "</td>";
            }
            if ($fila[mi8] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[mi8] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[mi8] . "</td>";
            }
                echo "<td align='left'> </td>";

           //************ empieza JUEVES *************************

            if ($fila[ju1] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[ju1] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[ju1] . "</td>";
            }
            if ($fila[ju2] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[ju2] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[ju2] . "</td>";
            }
            if ($fila[ju3] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[ju3] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[ju3] . "</td>";
            }
            if ($fila[ju4] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[ju4] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[ju4] . "</td>";
            }
            if ($fila[ju5] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[ju5] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[ju5] . "</td>";
            }
            if ($fila[ju6] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[ju6] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[ju6] . "</td>";
            }
            if ($fila[ju7] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[ju7] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[ju7] . "</td>";
            }
            if ($fila[ju8] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[ju8] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[ju8] . "</td>";
            }
                echo "<td align='left'> </td>";


           //************ empieza VIERNES *************************

            if ($fila[vi1] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[vi1] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[vi1] . "</td>";
            }
            if ($fila[vi2] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[vi2] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[vi2] . "</td>";
            }
            if ($fila[vi3] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[vi3] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[vi3] . "</td>";
            }
            if ($fila[vi4] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[vi4] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[vi4] . "</td>";
            }
            if ($fila[vi5] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[vi5] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[vi5] . "</td>";
            }
            if ($fila[vi6] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[vi6] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[vi6] . "</td>";
            }
            if ($fila[vi7] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[vi7] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[vi7] . "</td>";
            }
            if ($fila[vi8] == 'T') {
                echo "<td align='center' style='font-weight:bold;background:#cccccc;'>" . $fila[vi8] . "</td>";
            } else {
                echo "<td align='center'>" . $fila[vi8] . "</td>";
            }
                echo "<td align='left'> </td>";

            //************** FIN DIAS DE SEMANA ***************************
                echo "<td align='left'>" . $fila[nombre] . "</td>
            <tr>";
}
?>




</div>

</body>

</html>
