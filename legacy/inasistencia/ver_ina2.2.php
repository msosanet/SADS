<?
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style2.css" /> 
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>INASISTENCIAS</title>
</head>

<body>

<div id="marco980" align="center"><!-- ***** DIV PRINCIPAL *** -->

<?
include 'header.php';
$conexion = conectar ();
$usuario = $_SESSION['usuario'];
$pass = $_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
?>


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
    
?>

<!-- **************** FIN BARRA DE MENÚS *************** -->	

<br>
<p class="titulo" align="left">Inasistencias - Buscar por apellido</p>

<form name="form2" method="GET" action="ver_ina2.2.php">
					
<div align="center">
<br>
    
<? 
include 'snipet_listadocentes.php';  //cuadro combinado con listado de docentes
?>  

<span class="titulo">
<font color="#ffffff"> - - </font>Desde: <input type="text" style="border: 1px solid #888888; background-color: #ffffff; border-radius: 5px; padding: 4px 0 4px 0; box-shadow: 0 0 2px #555555;" name="fecha_desde" id="fecha_desde" value="<? echo $_GET["fecha_desde"]; ?>" size="10" maxlength="8"/>
<img src="calendario.png" width="16" height="16" border="0" title="Fecha Desde" id="fechas1"></span>
<!-- script que define y configura el calendario-->
<script type="text/javascript"> 
	Calendar.setup({ 
	   inputField:"fecha_desde",       // id del campo de texto 
	   ifFormat:"%Y-%m-%d",            // formato de la fecha que se escriba en el campo de texto 
	   button:"fechas1"             // el id del bot&oacute;n que lanzar&aacute; el calendario 
	}); 
</script>

<span class="titulo"><font color="#ffffff"> - - </font>Hasta: <input type="text" style="border: 1px solid #888888; background-color: #ffffff; border-radius: 5px; padding: 4px 0 4px 0; box-shadow: 0 0 2px #555555;" name="fecha_hasta" id="fecha_hasta" value="<? echo $_GET["fecha_hasta"]; ?>" size="10" maxlength="8"/>
<img src="calendario.png" width="16" height="16" border="0" title="Fecha Hasta" id="fechas2"></span>

<!-- script que define y configura el calendario-->
<script type="text/javascript"> 
	Calendar.setup({ 
    	inputField:"fecha_hasta",       // id del campo de texto 
		ifFormat:"%Y-%m-%d",            // formato de la fecha que se escriba en el campo de texto 
		button:"fechas2"             // el id del bot&oacute;n que lanzar&aacute; el calendario 
	}); 
</script>
<font color="#ffffff"> - - </font> 
&nbsp;<input type="submit" value=" Consultar " name="consultar" style="border: 1px solid #C0C0C0;  border-radius: 5px; padding: 4px 10px 4px 10px; background-color: #ffd56b; font-weight:700; font-size: 14px; box-shadow: 0 0 2px #555555;"/>
    
	</div>


<!-- /font -->

<br>
<!-- ******************** FIN FORMULARIO ***************************** -->
<!-- ************************ PRESENTACIÓN DE RESULTADOS **************************** -->

<?
    if ($_POST['docente'] !== "- - - - - -") { //********* PRESENTACIÓN CONDICIONADA DE LA TABLA DE DATOS **********  
        echo "presentar resultados";
?>

<table border="1" width="90%">
    <tr>
        <td>TITULO</td>
    </tr>
    <tr>
        <td><? echo $_POST['docente']; ?></td>
    </tr>
</table>

<?  }                             //********** FIN TABLA DE DATOS ***************

else {
    echo "nada para mostrar por el momento";
    }
?>

					

<? include 'footer.php'; ?>

</div>  <!-- ****************** FIN DIVISIÓN PRINCIPAL *********************** -->
</form>
</body>

</html>
<? } ?>