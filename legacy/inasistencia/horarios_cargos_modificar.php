<?
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

<title>HORARIOS CARGOS - MODIFICAR</title>

</head>

<?
include 'header.php';
$conexion = conectar();

//Tabla "usuarios": usuario - pass - valor - apellido - nombre - sector
$usuario = $_SESSION['usuario'];
$pass = $_SESSION['contrasenia'];
$chkusr = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario'") ;
$userdata = mysql_fetch_array($chkusr);
$fecha = date('Y-m-d');
$fechaDMA = date('d-m-Y');
$hora = date('H:i');
?>

<body>
<div id="marco980" align="center"><!-- ***** DIV PRINCIPAL *** -->

<!-- **************** BARRA DE MENÚS *************** -->
<?
  if ($_SESSION['valor']==1) {
    include 'menuppal2.php';
    }
  if ($_SESSION['valor']==0) {
    include 'menuppal.php';
    }
  if ($_SESSION['valor']==3) {
    include 'menuppal3.php';
    }
  if ($_SESSION['valor']==4) {
    include 'menuppal4.php';
    }
  if ($_SESSION['valor']==5) {
    include 'menuppal5.php';
    }
?>
<!-- **************** FIN BARRA DE MENÚS *************** -->
<br>
<!-- *********** CARGAR VARIABLES CON DATOS DEL DOCENTE SELECCIONADO ***********-->
<?
    $id = $_GET['id']; //identifica la fila de datos que se quiere mostrar 
    $buscahorariodocente = mysql_query ("SELECT * FROM horarios_cargos WHERE id = '$id'");
    $horariodocente = mysql_fetch_array ($buscahorariodocente);    
    $buscadatosdocente = mysql_query ("SELECT * FROM docentes WHERE dni = '$horariodocente[dni_docente]' ");
    $datosdocente = mysql_fetch_array($buscadatosdocente);
?>



<!-- *********** FIN CARGA DE VARIABLES ***********-->


<!-- *********** FORMULARIO PARA MODIFICAR HORARIO ***************** -->
<div id="nov_form_container" align="left">

<form action="horarios_cargos_modificar.php" method="post" name="form11">

    <p class="titulo" align="center">MODIFICAR HORARIO DE DOCENTE CON CARGO</p>
    <hr>
    <br>


Docente: 
<? 
    echo "<span class='titulo'>" . $datosdocente[apellido] . " " . $datosdocente[nombre] . "</span>";
?>
              
<br>
<br>

<div align="center"> <!-- *************** GRILLA MUESTRA HORARIOS ******************** -->
    <!-- ? 
        $buscahorarios = mysql_query ("SELECT * FROM horarios_cargos WHERE dni_docente = $docentedatos[dni]");
        $horariodocente = mysql_fetch_array ($buscahorarios);
    ? -->  
     					
	<table border="1" width="100%" cellpadding="1" cellspacing="0">
    	<tr bgcolor="#CCCCCC" align="center">
    		<td width="120" bgcolor="#f4bc42">CARGO</td>
    		<td>LUNES</td>
    		<td>MARTES</td>
    		<td>MIÉRCOLES</td>
    		<td>JUEVES</td>
    		<td>VIERNES</td>
    		<td>SÁBADO</td> 
    	</tr>
        <tr height="35">
            <td align="center" bgcolor="#FFFFFF">
            <?
              $codigocurso = $horariodocente[cargo];
              $cargostodos = mysql_query ("SELECT * FROM curso WHERE codigo = $codigocurso");
              $cargo = mysql_fetch_array ($cargostodos);
              echo "<b>" . $cargo[descripcion] . "</b>"; 
            ?>
            </td> 
    		<td align="center">E <input type="text" name="lun_ent" size="4" value="<? echo substr($horariodocente[lun_ent],0,5); ?>"> S <input type="text" name="lun_sal" size="4" value="<? echo substr($horariodocente[lun_sal],0,5); ?>"></td>
            </td> 
    		<td align="center">E <input type="text" name="mar_ent" size="4" value="<? echo substr($horariodocente[mar_ent],0,5); ?>"> S <input type="text" name="mar_sal" size="4" value="<? echo substr($horariodocente[mar_sal],0,5); ?>"></td>  
            </td> 
    		<td align="center">E <input type="text" name="mie_ent" size="4" value="<? echo substr($horariodocente[mie_ent],0,5); ?>"> S <input type="text" name="mie_sal" size="4" value="<? echo substr($horariodocente[mie_sal],0,5); ?>"></td> 
    		<td align="center">E <input type="text" name="jue_ent" size="4" value="<? echo substr($horariodocente[jue_ent],0,5); ?>"> S <input type="text" name="jue_sal" size="4" value="<? echo substr($horariodocente[jue_sal],0,5); ?>"></td> 
    		<td align="center">E <input type="text" name="vie_ent" size="4" value="<? echo substr($horariodocente[vie_ent],0,5); ?>"> S <input type="text" name="vie_sal" size="4" value="<? echo substr($horariodocente[vie_sal],0,5); ?>"></td> 
    		<td align="center">E <input type="text" name="sab_ent" size="3" value="<? echo substr($horariodocente[sab_ent],0,5); ?>"> S <input type="text" name="sab_sal" size="3" value="<? echo substr($horariodocente[sab_sal],0,5); ?>"></td>
        </tr>
        
	
    </table> <!-- *************** FIN GRILLA MUESTRA HORARIOS ******************** --> 
    <input type="hidden" name="id" value=<? echo $_GET['id']; ?>>

    <br>
  
<p><input type="submit" name="update" value="     Actualizar     " style="border: 1px solid #C0C0C0;  border-radius: 5px; padding: 4px 10px 4px 10px; background-color: #ffd56b; font-weight:700; font-size: 14px; box-shadow: 0 0 2px #555555;"></p>
    
<p align="left"><span class="titulo">REGISTR&Oacute;: </span><? echo $userdata[nombre]; ?></p> <!-- $userdata [nombre] tiene el nombre del usuario activo en la sesión -->  
<br> 
<? 
//grabar las modificaciones
    $mysqli = mysqli_connect("localhost","fgoicoechea","sobral2011","sid");
    if (isset ($_POST['update'])) {
    
        $id = $_POST['id'];
        $lun_ent = $_POST['lun_ent'];
        $lun_sal = $_POST['lun_sal'];
        $mar_ent = $_POST['mar_ent'];
        $mar_sal = $_POST['mar_sal'];
        $mie_ent = $_POST['mie_ent'];
        $mie_sal = $_POST['mie_sal'];
        $jue_ent = $_POST['jue_ent'];
        $jue_sal = $_POST['jue_sal'];
        $vie_ent = $_POST['vie_ent'];
        $vie_sal = $_POST['vie_sal'];
        $sab_ent = $_POST['sab_ent'];
        $sab_sal = $_POST['sab_sal'];
        
        $grabar = mysqli_query($mysqli, "UPDATE horarios_cargos SET lun_ent = '$lun_ent', lun_sal = '$lun_sal', mar_ent = '$mar_ent', mar_sal = '$mar_sal', mie_ent = '$mie_ent', mie_sal = '$mie_sal', jue_ent = '$jue_ent', jue_sal = '$jue_sal', vie_ent = '$vie_ent', vie_sal = '$vie_sal', sab_ent = '$sab_ent', sab_sal = '$sab_sal' WHERE id = $id");

//*************** MUESTRA MENSAJE GRABACIÓN EXITOSA **************
        echo "<font color='green'>Horario modificado correctamente.<br></font>";
    }
?>

</div>
</form>
</div>    <!-- ************* FIN FORMULARIO ******************** -->
</div>  
<?
    } //Fin comprueba sesión
?>

<p>&nbsp;</p>

<? include 'footer.php'; ?>

</div> <!-- ****************** FIN DIV PRINCIPAL ************ -->
</body>

<? //} ?>

</html>