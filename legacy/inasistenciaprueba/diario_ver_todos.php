<?
session_start();
if ($_SESSION['estado'] == 1) { 
include 'conexion.php';
$conexion = conectar();
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Language" content="es-ar">
<!-- meta http-equiv="Content-Type" content="text/html; charset=windows-1252" -->
<meta charset="windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css">
<title>REGISTRO ENTRADA-SALIDA</title>

</head>

<body>
<div id="marco980" align="center">

<?
include 'header.php'; // banner en parte superior de la pagina
include 'snipet_barramenu.php'; // barra de menus diferenciada por tipo de usuario
$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
/*
function borrar_registro() {
    if (session == 1) {
    $mysql = mysql_query("DELETE * FROM diario_sandbox WHERE dni = '$dni' AND fecha = '$fecha' AND horario = '$horario'");    
echo "<script>
      confirm('¿Desea eliminar este registro?');
      </script>
      }";
    } */
?>

<br>

<p class="titulo">CONSULTA AL REGISTRO DE ENTRADA Y SALIDA DEL PERSONAL DOCENTE</p>
<hr>
<br>
<form name="form1" method="post" action="">

  Fecha desde: 
    <select name="desde_dia" autofocus>
        <option value="">d&iacute;a</option>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option> 
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option> 
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
    </select>  
    <select name="desde_mes">
        <option value="">mes</option>
        <option value="01">enero</option>
        <option value="02">febrero</option>
        <option value="03">marzo</option>
        <option value="04">abril</option>
        <option value="05">mayo</option>
        <option value="06">junio</option>
        <option value="07">julio</option>
        <option value="08">agosto</option>
        <option value="09">septiembre</option>
        <option value="10">octubre</option>
        <option value="11">noviembre</option>
        <option value="12">diciembre</option>
    </select>  
    <select name="desde_anio">
        <option value="2018">2018</option>
        <option value="2017">2017</option>
    </select> - 
  Fecha hasta: 
    <select name="hasta_dia">
        <option value="">d&iacute;a</option>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option> 
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option> 
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
    </select>  
    <select name="hasta_mes">
        <option value="">mes</option>
        <option value="01">enero</option>
        <option value="02">febrero</option>
        <option value="03">marzo</option>
        <option value="04">abril</option>
        <option value="05">mayo</option>
        <option value="06">junio</option>
        <option value="07">julio</option>
        <option value="08">agosto</option>
        <option value="09">septiembre</option>
        <option value="10">octubre</option>
        <option value="11">noviembre</option>
        <option value="12">diciembre</option>
    </select>  
    <select name="hasta_anio">
        <option value="2018">2018</option>
        <option value="2017">2017</option>
    </select> - 
    <input type="submit" name="submit" value="   CONSULTAR   " />
</form>

<?
if ($desde == "") {
    $desde = $_POST[desde_anio] . "-" . $_POST[desde_mes] . "-" . $_POST[desde_dia];
    }
if (isset ($_POST[desde_dia])) {
    $desde = $_POST[desde_anio] . "-" . $_POST[desde_mes] . "-" . $_POST[desde_dia];
}    
if ($hasta == "") {    
    $hasta = $_POST[hasta_anio] . "-" . $_POST[hasta_mes] . "-" . $_POST[hasta_dia];
    } 
if (isset ($_POST[desde_dia])) {   
    $hasta = $_POST[hasta_anio] . "-" . $_POST[hasta_mes] . "-" . $_POST[hasta_dia];
}
    
$desdeDMA = substr($desde,-2,2) . "-" . substr($desde,-5,2) . "-" . substr($desde,-10,4);
$hastaDMA = substr($hasta,-2,2) . "-" . substr($hasta,-5,2) . "-" . substr($hasta,-10,4);
?>

<br>

<? echo "Movimientos registrados desde el <b>" . $desdeDMA . "</b> hasta el <b>" . $hastaDMA . "</b>"; ?>

<br>
 
 
<!-- *************** GRILLA MUESTRA HORARIOS ******************** -->    					
	<table border="1" cellpadding="1" cellspacing="0">
    	<tr bgcolor="#f4bc42" align="center">          
    		<td width="300">DOCENTE</td>
    		<td width="80">FECHA</td>
    		<td width="60">DIA</td>
    		<td width="60">TIPO MOV</td>
    		<td width="80">HORA</td>    
    		<td width="120">ACCI&Oacute;N</td> 
    		<!-- td width="250">CONTENIDO DE MATRIZ</td -->
    	</tr>

<?

$diario_todos = mysql_query ("SELECT docentes.apellido,docentes.nombre,diario_sandbox.dni,diario_sandbox.fecha,diario_sandbox.dia,diario_sandbox.horario,diario_sandbox.tipo FROM diario_sandbox, docentes WHERE diario_sandbox.dni=docentes.dni AND fecha BETWEEN '$desde' AND '$hasta' ORDER BY docentes.apellido,docentes.nombre,diario_sandbox.fecha,diario_sandbox.horario");

$loop = 0;   // *************** INICIALIZAR UN LAZO PARA LLENAR UNA MATRIZ ********

while ($diario_fila = mysql_fetch_array($diario_todos)) {

?>

    	<tr bgcolor="#FFFFFF" align="center">
        
            <td align="left">
<?
    $dni_docente = $diario_fila[dni];
    $docentestodos = mysql_query ("SELECT * FROM docentes WHERE dni = $dni_docente");
    $docente = mysql_fetch_array ($docentestodos);
    echo "<b>" . $docente[apellido] . "</b>, " . $docente[nombre]; 
?>
            </td>
            
            <td><? echo substr($diario_fila[fecha],8,2) . "-" . substr($diario_fila[fecha],5,2) . "-" . substr($diario_fila[fecha],0,4); ?></td>
    		    <?  if ($diario_fila[dia] == 1) {
                        echo "<td bgcolor='#F09483'>Lunes";
                    } 
                    if ($diario_fila[dia] == 2) {
                        echo "<td bgcolor='#F0CA83'>Martes";
                    } 
                    if ($diario_fila[dia] == 3) {
                        echo "<td bgcolor='#E0F083'>Mi&eacute;rcoles";
                    } 
                    if ($diario_fila[dia] == 4) {
                        echo "<td bgcolor='#A9F083'>Jueves";
                    }
                    if ($diario_fila[dia] == 5) {
                        echo "<td bgcolor='#83F0CA'>Viernes";
                    } 
                    if ($diario_fila[dia] == 6) {
                        echo "<td bgcolor='#83E0F0'>S&aacute;bado";
                    }
                ?>
            </td>
    		<td><? if ($diario_fila[tipo] == "Entrada") {
                        echo "<p style='color:green'><b>Entrada</b></p>";
                    } 
                   if ($diario_fila[tipo] == "Salida") {
                        echo "<p style='color:red'><b>Salida</b></p>";
                    }            
                ?>
            </td>  
            <td><? echo substr($diario_fila[horario],0,-3); ?></td> 
            <td>
            
            <?
            $matriz_dni[$loop] = $diario_fila[dni]; 
            $matriz_fecha[$loop] = $diario_fila[fecha]; 
            $matriz_tipo[$loop] = $diario_fila[tipo]; 
            $matriz_horario[$loop] = $diario_fila[horario];
            ?>
            
            <? 
            if ($diario_fila[tipo] == "Entrada") {
                echo "
                <a href='diario_ent2sal.php?dni=" . $matriz_dni[$loop] . "&fecha=" . $matriz_fecha[$loop] . "&horario=" . $matriz_horario[$loop] . "&desde=" . $desde . "&hasta=" . $hasta . "'>Ent/Sal </a>";  
            }
            
            if ($diario_fila[tipo] == "Salida") {
                echo "
                <a href='diario_sal2ent.php?dni=" . $matriz_dni[$loop] . "&fecha=" . $matriz_fecha[$loop] . "&horario=" . $matriz_horario[$loop] . "&desde=" . $desde . "&hasta=" . $hasta . "'>Ent/Sal </a>";  
            }
            ?>
<!-- ***************************************************************************** -->            
            <? echo 
            "<script>
                function BORRAR" . $loop . "()
                {
                var opcionborrar" . $loop . " = confirm('¿Desea borrar el siguiente registro? " . $docente[apellido] . ", " . $docente[nombre] . "  " . $matriz_dni[$loop] . "  " . $matriz_fecha[$loop] . "  " . $matriz_tipo[$loop] . "  " . $matriz_horario[$loop] . "');
                if (opcionborrar" . $loop . " == true) {
                    alert('alguna acción');
                    alert('registro borrado " . $loop . "'); 
                    }
                }
            </script>";
            ?>           
<!-- ***************************************************************************** -->           
<!--BORRAR--><a href="javascript:void(0)" onclick="BORRAR<? echo $loop; ?>();"><img src='images/b_drop.png'></a> 
            
            <? echo 
            "<script>
                function VER" . $loop . "()
                {
                alert('" . $docente[apellido] . ", " . $docente[nombre] . "-" . $matriz_dni[$loop] . "-" . $matriz_fecha[$loop] . "-" . $matriz_tipo[$loop] . "-" . $matriz_horario[$loop] . "');
                }
            </script>";
            ?>
            
            <input type="submit" name="" value="VER" onclick="VER<? echo $loop; ?>();"> 
            
            </td>
            <!-- td>
            <? //echo $matriz_dni[$loop] . "-" . $matriz_fecha[$loop] . "-" . $matriz_tipo[$loop] . "-" . $matriz_horario[$loop]; ?>
            </td -->
    	</tr>
        
<? 
$loop = $loop + 1; //incrementa contador del bucle************************************************
} 
?>		
    </table>

<!-- *************** FIN GRILLA MUESTRA HORARIOS ******************** --> 
<br>
<? 
include 'footer.php';
?>

</div>
</body>
</html>



<?
} //************ FIN BRACKET SESION *******************************************************************
?>