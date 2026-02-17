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

<title>HORARIOS CARGOS - NUEVO</title>

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
if ($_SESSION['valor']==1)
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
if ($_SESSION['valor']==4)
{
include 'menuppal4.php';
}
if ($_SESSION['valor']==5)
{
include 'menuppal5.php';
}
?>
<!-- **************** FIN BARRA DE MENÚS *************** -->
<p>&nbsp;</p>

<!-- *********** FORMULARIO PARA INGRESAR DATOS DEL CARGO ***************** -->
<div id="nov_form_container" align="left">

<!-- form action="horarios_cargos_nuevo.php" method="post" name="form10" -->
<form>

    <p class="titulo" align="center">AGREGAR HORARIO DE DOCENTE CON CARGO</p>
    <hr>
    <p>&nbsp;</p>

    <p><span class="titulo">D.N.I.: <input type="text" name="dni" size="10"></span> * 
    
    <input type="submit" value="Buscar" name="buscar" style="border: 1px solid #C0C0C0; padding: 1px 10px 2px 10px; background-color: gold; font-weight:700; float:center" />

<!-- DEBE APARECER EL APELLIDO Y NOMBRE DEL DOCENTE CUYO DNI FIGURA EN EL CAMPO PRECEDENTE-->    
    
<? 
       $datodni = $_POST['dni'];
    if ($datodni !== " ") {
        $datos_docente = mysql_query ("SELECT * FROM docentes WHERE dni = $datodni");
        $muestra_docente = mysql_fetch_array ($datos_docente);
        $docente = $muestra_docente[apellido] . " " . $muestra_docente[nombre];
        } 
    else {
        $docente = "";
        }
    
?>     
    
    <span class="titulo">Apellido y nombre: </span><? echo $docente; ?></p>
<br>

<!-- LISTA DE DOCENTES *************************************************************************** -->                    
<span class="titulo">Docente: 
    <select size="1" name="docente" autofocus="true" onchange="this.form.submit()">
    <option value="" disabled selected>- - -</option>
<? 
    $listadocentes = mysql_query ("SELECT * FROM docentes WHERE identificacion = 1 ORDER BY apellido, nombre");
      
    while ($docente = mysql_fetch_array($listadocentes)) {			
	echo "<option value=" . $docente[apellido] . ">" . $docente[apellido] . ", " . $docente[nombre] . "</option>";
    }
  
      echo "</select>";
    ?>
    D.N.I.: <? echo $docente[dni]; ?></span>
<!-- FIN LISTA DE DOCENTES *************************************************************************** -->    

<p>&nbsp;</p>
<hr>
<p>&nbsp;</p>

<!-- LISTA DE CARGOS *************************************************************************** -->                    
			<span class="titulo">Cargo: </span><select size="1" name="cargo">
            <? $listacurso = mysql_query ("SELECT * FROM curso ORDER BY descripcion");
            
            	while ($cargo = mysql_fetch_array($listacurso))
				    {			
						echo "<option value=" . $cargo[codigo] . ">" . $cargo[descripcion] . "</option>";
				    }
		      ?></select>
<!-- FIN LISTA DE CARGOS *************************************************************************** -->

<div align="center">
<br>					
	<table border="0" width="98%" cellpadding="1" cellspacing="2">
    	<tr bgcolor="#BB6666" align="center" height="30">
    		<td class="titulo">LUNES</td>
    		<td class="titulo">MARTES</td>
    		<td class="titulo">MIÉRCOLES</td>
    		<td class="titulo">JUEVES</td>
    		<td class="titulo">VIERNES</td>
    		<td class="titulo">SÁBADO</td>
    	</tr>

    	<tr bgcolor="#CC9999" align="center" height="35">
    		<td>E <input type="text" name="lun_ent" size="4" value="00:00"> S <input type="text" name="lun_sal" size="4" value="00:00"></td>
    		<td>E <input type="text" name="mar_ent" size="4" value="00:00"> S <input type="text" name="mar_sal" size="4" value="00:00"></td>
            <td>E <input type="text" name="mie_ent" size="4" value="00:00"> S <input type="text" name="mie_sal" size="4" value="00:00"></td>
            <td>E <input type="text" name="jue_ent" size="4" value="00:00"> S <input type="text" name="jue_sal" size="4" value="00:00"></td>
            <td>E <input type="text" name="vie_ent" size="4" value="00:00"> S <input type="text" name="vie_sal" size="4" value="00:00"></td>
            <td>E <input type="text" name="sab_ent" size="4" value="00:00"> S <input type="text" name="sab_sal" size="4" value="00:00"></td>
    	</tr>		
    </table>  
<p align="left">(*) Campo obligatorio</p>
<br>
<p align="left"><span class="titulo">REGISTR&Oacute;: </span><? echo $userdata[nombre]; ?></p> <!-- $userdata [nombre] tiene el nombre del usuario activo en la sesión -->  
<br>        
<p align="center"><input type="submit" value="   Guardar   " name="submitx" style="border: 1px solid #C0C0C0; padding: 1px 10px 3px 10px; background-color: gold; font-weight:700; float:center" />

</div>
</div>    <!-- ************* FIN FORMULARIO ******************** -->

</form>

<?      
 if(isset($_GET["docente"])) {
    $docente = $_GET["docente"];
    echo " La selección es " . $docente;
 }
?>
</div>  

<!-- *********** GRABAR CONTENIDO DEL FORMULARIO ************* -->
<?
$mysqli = mysqli_connect("localhost","fgoicoechea","sobral2011","sid");
if (isset($_POST['submitx'])) {     
    $fecha = date('Y-m-d');
    $hora = date('H:i');
    $dni = $_POST['dni'];
    $cargo = $_POST['cargo'];
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
    $time_stamp = date('Y-m-d H:i:s');
    $quien_registro = $userdata[nombre];

    // VERIFICAR QUE HAYA DATOS EN LOS CAMPOS
    if (empty($dni)) {
        echo "<font color='red'>Debe ingresar DNI del/de la docente</font><br/>";
        }
        
    if ($cargo == "- - -") {
        echo "<font color='red'>Debe seleccionar un cargo</font><br/>";
        }

    else {
        // if all the fields are filled (not empty) insert data to database
        $grabahorario = mysqli_query ($mysqli, "INSERT INTO horarios_cargos VALUES (0, '$dni', '$cargo', '$lun_ent', '$lun_sal', '$mar_ent', '$mar_sal', '$mie_ent', '$mie_sal', '$jue_ent', '$jue_sal', '$vie_ent', '$vie_sal', '$sab_ent', '$sab_sal','$time_stamp','$quien_registro')");
?>

<!-- *************** MUESTRA MENSAJE GRABACIÓN EXITOSA ************** -->
<script>
    var answer=alert("Nuevo horario de cargo grabado correctamente ")
</script>
<meta http-equiv='refresh' content='0; URL=menu.php'>

<?
   }
  }
?>

<p>&nbsp;</p>

<? include 'footer.php'; ?>

</div> <!-- ****************** FIN DIV PRINCIPAL ************ -->
</body>

<? 

} //cierra bracket del inicio 

?>   

</html>

