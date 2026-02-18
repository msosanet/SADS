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
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>
<title>SID</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>
<?
include 'header.php';
?>
<body background="bgris.gif" >

<p>


<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo6 {
	font-size: 16px;
	font-weight: bold;
}
.Estilo7 {font-size: 16px; font-weight: bold; color: #FF0000; }
-->
</style>

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
				<table border="0" width="980" cellspacing="0" cellpadding="0">
					<tr>
						
					</tr>
				</table>
				
				<p></div>
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
echo "</table></div>";

	
// Make a MySQL Connection
mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("base_sobral") or die(mysql_error());

$con = conectar ();

echo "<br>";
echo "<br>";

$curso=$_GET['curso']; //SI TIENE VALOR
$division=$_GET['division'];//IDEM

$sql = "SELECT * FROM curso2 WHERE habilitado='1'order by curso,division ASC";
$result = mysql_query($sql);




echo "<form method='GET' action='boletinprueba.php'>";
echo "Curso: ";

echo "<select name='curso'>";
while ($row = mysql_fetch_assoc($result))
{ if ($curso==$row['idcurso'])
	{echo "<option value=".$row['idcurso']." selected>".$row['descripcion']."</option>";}
  else
	{echo "<option value=".$row['idcurso'].">".$row['descripcion']."</option>";}

}
echo "</select>";

echo "<br>";
echo "<br>";
echo "<br>";

 $meses = array();
 $meses[1] = "Enero";
 $meses[2] = "Febrero";
 $meses[3] = "Marzo";
 $meses[4] = "Abril";
 $meses[5] = "Mayo";
 $meses[6] = "Junio";
 $meses[7] = "Julio";
 $meses[8] = "Agosto";
 $meses[9] = "Septiembre";
 $meses[10] = "Octubre";
 $meses[11] = "Noviembre";
 $meses[12] = "Diciembre";
 
 if (isset($_GET['mes'])) 
 {$mex = $_GET['mes'];}
else
 {$mex=date("m");}
 
 
   echo "Seleccione Mes: ";
   echo "<select name=\"mes\">";           
   for($mes=1; $mes<=12; $mes++){ //si es el mes en curso lo marca como selected
      if ($mex == $mes){
         echo "<option value=\"$mes\" selected>$meses[$mes]</option>";
      }
      else {
         echo "<option value=\"$mes\">$meses[$mes]</option>";
      }
   }
   echo"</select>";


echo "<input type='submit' name='mostrar' value='Ver Planilla Asistencia'/>";




echo "</table></div>";


if (isset($_GET['mostrar'])) {
    $curso = substr($_GET['curso'], 0, 1);
    $division = substr($_GET['curso'], 1);
    $mess = $mex; // Mes seleccionado
    $year = date('Y');
    $day = date('d');
    $mec = date('m'); // Mes en curso

    $days = cal_days_in_month(CAL_GREGORIAN, $mess, $year); // Cantidad de días del mes seleccionado

    echo "<br><br><br><br>";
    echo "<h2>PLANILLA DE ASISTENCIA $mess-$year</h2>";
    echo "<h3>Cantidad de días del mes: $days </h3>";

    $re = $mec - $mess;

    if ($re == 0) {
        $days = date('d'); // Si estamos en el mes en curso, solo recorre hasta los días que hayan pasado
    }

    if ($re < 0) {
        $days = 0; // Si el mes en curso es mayor, no busca nada porque todavía no debería haber novedades
    }
?>

<style>
    body {
        font-family: Arial, sans-serif;
    }
    h2, h3 {
        text-align: center;
    }
    #customers {
        width: 50%;
        border-collapse: collapse;
        margin: 20px auto;
        font-size: 18px;
    }
    #customers th, #customers td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    #customers th {
        background-color: #4CAF50;
        color: white;
    }
    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    #customers tr:hover {
        background-color: #ddd;
    }
</style>

<table id="customers">
    <thead>
        <tr>
            <th width="15%">Alumno</th>
            <?php for ($j = 1; $j <= $days; $j++) echo "<th>$j/$mess</th>"; ?>
            <th>Total A. Justificadas</th>
            <th>Total A. Injustificadas</th>
            <th>Total Ausencias (I+J+T)</th>
            <th>Total Presentes</th>
            <th>%</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $ano = date("Y");
        $alumnos = mysql_query("SELECT CONCAT(a.apellido, ' ', a.nombre) as alumno, a.dni FROM alumno a, cursa c WHERE c.alumno=a.dni AND c.curso='$curso' AND c.divi='$division' AND c.anio='$ano' AND c.control='1' ORDER BY alumno ASC") or die(mysql_error());

        while ($row = mysql_fetch_assoc($alumnos)) {
            echo "<tr>";
            echo "<td><a href='ver_alu.php?actor=" . $row['dni'] . "' target='_blank'>" . $row['alumno'] . "</a></td>";

            $dni = $row['dni'];
            $presente = $ausentec = $finde = $injust = $just = $tarde = 0;

            for ($z = 1; $z <= $days; $z++) {
                $flag = 0;
                $fecha = "$year-$mess-$z";
                $dia = date("w", mktime(0, 0, 0, $mess, $z, $year));

                if ($dia == 0) { // Domingo
                    $flag = 1;
                    echo "<td bgcolor='#f0f8ff'>D</td>";
                }

                if ($dia == 6) { // Sábado
                    $flag = 1;
                    echo "<td bgcolor='#f0f8ff'>S</td>";
                }

                $feriado = mysql_query("SELECT * FROM feriados WHERE fecha='$fecha'");
                $feri = mysql_num_rows($feriado);

                if ($feri > 0 && $flag == 0) { // Feriado
                    $flag = 1;
                    echo "<td bgcolor='#f0f8ff'>F</td>";
                }

                if ($flag == 0) {
                    $consultalu = ("SELECT * FROM alumnos_faltas a, injus i WHERE a.injus=i.id AND a.fecha='$fecha' AND a.dni='" . $row['dni'] . "'");
                    $ausentex = mysql_query($consultalu);
                    $total = mysql_num_rows($ausentex);

                    if ($total > 0) {
                        echo "<td bgcolor='#FF0000'><a href='alumnostarde.php?fecha=" . $fecha . "&dni=" . $dni . "' target='_blank'>";
                        $letras = [];
                        while ($rowz = mysql_fetch_assoc($ausentex)) {
                            $letras[] = $rowz['letra'];
                        }
                        echo implode(' | ', $letras);
                        echo "</a></td>";
                    } else {
                        echo "<td bgcolor='#00FF00'>P</td>";
                        $presente++;
                    }
                }
            }

            $justificadasQ = ("SELECT SUM(i.valorfalta) as total FROM alumnos_faltas a, injus i WHERE i.id=0 AND a.injus=i.id AND MONTH(fecha) = '" . $mess . "' AND a.dni='" . $row['dni'] . "'");
            $justificadax = mysql_query($justificadasQ);
            if ($justificadax) {
                $row = mysql_fetch_assoc($justificadax);
                $justificadas = $row['total'];
            }

            $injustificadasQ = ("SELECT SUM(i.valorfalta) as total FROM alumnos_faltas a, injus i WHERE i.id=1 AND a.injus=i.id AND MONTH(fecha) = '" . $mess . "' AND a.dni='" . $row['dni'] . "'");
            $injustificadax = mysql_query($injustificadasQ);
            if ($injustificadax) {
                $row = mysql_fetch_assoc($injustificadax);
                $injustificadas = $row['total'];
            }

            $totalausentes = $justificadas + $injustificadas;
            $porcentaje = round(100 - (($totalausentes / ($totalausentes + $presente)) * 100), 0);

            $color = '#FFFFFF'; // Color por defecto
            if ($porcentaje > 80) {
                $color = '#00FF00'; // Verde
            } elseif ($porcentaje >= 50 && $porcentaje <= 79) {
                $color = '#FFFF00'; // Amarillo
            } elseif ($porcentaje < 50) {
                $color = '#FF0000'; // Rojo
            }

            echo "<td>$justificadas</td>";
            echo "<td>$injustificadas</td>";
            echo "<td>$totalausentes</td>";
            echo "<td>$presente</td>";
            echo "<td bgcolor='$color'>$porcentaje</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php
}
?>







?>

