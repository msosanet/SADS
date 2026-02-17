<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />
<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO")
}
</script>

<title>HORARIOS CARGOS - OCULTAR</title>

</head>

<?
include 'header.php';
$conexion = conectar();

$id = $_GET['id'];
?>

<body>
<div id="marco980" align="center"><!-- ***** DIV PRINCIPAL *** -->
<?
include 'snipet_barramenu.php';
?>

<p>&nbsp;</p>

<!-- *********** FORMULARIO PARA OCULTAR HORARIO ***************** -->
<div id="nov_form_container" align="left">

<form action="horarios_cargos_ocultar.php" method="post" name="form20">

    <p class="titulo" align="center">OCULTAR HORARIO DE DOCENTE CON CARGO</p>
<hr>
<br>
<!-- *********************** MUESTRA APELLIDO Y NOMBRE DEL DOCENTE CUYO HORARIO SE MUESTRA *******************-->
<!-- Variable $id ya tiene la identificación del registro que contiene DNI, cargo y horarios del docente-->


<!-- *********************** FIN MUESTRA APELLIDO Y NOMBRE DEL DOCENTE CUYO HORARIO SE MUESTRA *******************-->


<div align="center"> <!-- *************** GRILLA MUESTRA HORARIOS ******************** -->
<? 
$buscahorarios = mysql_query ("SELECT * FROM horarios_cargos WHERE id = $id");
$horariosdeldocente = mysql_fetch_array ($buscahorarios);
$dni = $horariosdeldocente[dni_docente];
$buscadocente = mysql_query ("SELECT * FROM docentes WHERE dni = $dni");
$datosdeldocente = mysql_fetch_array ($buscadocente);

echo "<p class='titulo' align='left'>" . $datosdeldocente[apellido] . ", " . $datosdeldocente[nombre] . " - D.N.I. Nº " . number_format($dni,0,'','.') . "</p>";
    ?>


<br>    					
	<table border="1" width="100%" cellpadding="1" cellspacing="0">
    	<tr bgcolor="#CCCCCC" align="center">
    		<td width="180" bgcolor="#f4bc42">CARGO</td>
    		<td>LUNES</td>
    		<td>MARTES</td>
    		<td>MIÉRCOLES</td>
    		<td>JUEVES</td>
    		<td>VIERNES</td>
    		<td>SÁBADO</td>
    	</tr>
                   
            
<? 
$buscahorarios = mysql_query ("SELECT * FROM horarios_cargos WHERE id = $id");
while ($horariosdeldocente = mysql_fetch_array($buscahorarios)) {
?>
        
    	<tr bgcolor="#FFFFFF" align="center">
            <td>
                <?
                    $codigocurso = $horariosdeldocente[cargo];
                    $cargostodos = mysql_query ("SELECT * FROM curso WHERE codigo = $codigocurso");
                    $cargo = mysql_fetch_array ($cargostodos);
                    echo "<b>" . $cargo[descripcion] . "</b>"; 
                ?>
            </td>
    		<td><? echo substr($horariosdeldocente[lun_ent],0,5) . " a " . substr($horariosdeldocente[lun_sal],0,5); ?></td>
    		<td><? echo substr($horariosdeldocente[mar_ent],0,5) . " a " . substr($horariosdeldocente[mar_sal],0,5); ?></td>
    		<td><? echo substr($horariosdeldocente[mie_ent],0,5) . " a " . substr($horariosdeldocente[mie_sal],0,5); ?></td>
    		<td><? echo substr($horariosdeldocente[jue_ent],0,5) . " a " . substr($horariosdeldocente[jue_sal],0,5); ?></td>
    		<td><? echo substr($horariosdeldocente[vie_ent],0,5) . " a " . substr($horariosdeldocente[vie_sal],0,5); ?></td>
    		<td><? echo substr($horariosdeldocente[sab_ent],0,5) . " a " . substr($horariosdeldocente[sab_sal],0,5); ?></td> 
            <!-- td><!-- ? echo substr($horariosdeldocente[id],0,5); ?></td -->
    	</tr>
        
        <? 
            }
        ?>		
    </table> <!-- *************** FIN GRILLA MUESTRA HORARIOS ******************** --> 
    <input type="hidden" name="id" value=<? echo $_GET['id']; ?>>
<br>
    &nbsp;<input type="submit" value=" Ocultar " name="ocultar" style="border: 1px solid #C0C0C0;  border-radius: 5px; padding: 4px 10px 4px 10px; background-color: #ffd56b; font-weight:700; font-size: 14px; box-shadow: 0 0 2px #555555;"/>

</div>

</div> 
<?  
    $mysqli = mysqli_connect("localhost","fgoicoechea","sobral2011","sid");
    if (isset ($_POST['ocultar'])) {
        $id = $_POST['id'];
        echo "acá iría el id " . $id;
        $grabar = mysqli_query($mysqli, "UPDATE horarios_cargos SET ver = '0' WHERE id = $id");

//*************** MUESTRA MENSAJE GRABACIÓN EXITOSA **************
        echo "<font color='green'>Horario ocultado.<br></font>";
    }   

// ************* FIN FORMULARIO ********************
?>

</form>

<?
} // *************** FIN COMPRUEBA SESION ***************
?>
<p>&nbsp;</p>

<? include 'footer.php'; ?>

</div> <!-- ****************** FIN DIV PRINCIPAL ************ -->
</body>

</html>