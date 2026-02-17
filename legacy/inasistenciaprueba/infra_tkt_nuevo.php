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

<title>INFRA TICKET NUEVO</title>

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
?>

<body>
<div id="marco980" align="center"><!-- ***** DIV PRINCIPAL *** -->

<!-- **************** BARRA DE MENÚS *************** -->
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

<!-- *********** FORMULARIO CARGA TKT ***************** -->
<div id="nov_form_container" align="left">

<form action="infra_tkt_nuevo.php" method="post" name="form1">

    <p class="titulo" align="center">NUEVO TICKET DE INFRAESTRUCTURA</p>
    <hr>
    <p>&nbsp;</p>
    <p><span class="titulo">FECHA: </span><span class ="titulo2"><? echo $fechaDMA; ?></span>
    <p class="titulo">LUGAR: <input type="text" name="lugar" size="70" autofocus="true"></p>

    <p class="titulo">DESCRIPCI&Oacute;N DEL DESPERFECTO:</p>
        <textarea rows="4" cols="112" maxlength="200" name="desperfecto" id="desperfecto"></textarea>

    <p>&nbsp;</p>

    <p class="titulo">AVIS&Oacute;: <input type="text" name="quien_aviso" size="30">
     &nbsp;REGISTR&Oacute;: <input type="text" name="quien_registro" value="<? echo $userdata[nombre]; ?>"></p>
     <br>

    <p class="titulo"><u>SOLICITUD</u></p>
    <p class="titulo">
       RECIBI&Oacute;: <input type="text" name="recibio_solicitud" size="30">
       HORA: <input type="text" name="hora_solicitud" size="6"><span class="fecha">(hh:mm)</span>
    </p>

    <p class="titulo">OBSERVACIONES:</p>
         <textarea rows="2" cols="112" maxlength="200" name="observaciones" id="observaciones"></textarea>

    <p class="titulo">TAREA REALIZADA: <input type="checkbox" name="tarea_cumplida">&nbsp;&nbsp;FECHA:&nbsp;<span class="fecha">d&iacute;a<input type="text" size="2" name="realiz_dia"> mes<input type="text" size="2" name="realiz_mes"> año<input type="text" size="4" name="realiz_anio"></span></p>

       <br>
       <p><input type="submit" name="Submit" value="     Guardar     "></p>

</form>
</div>  <!-- ************* FIN FORMULARIO ******************** -->

<!-- *********** GRABAR CONTENIDO DEL FORMULARIO ************* -->
<?
    $mysqli = mysqli_connect("localhost","fgoicoechea","sobral2011","sid");
    if(isset($_POST['Submit'])) {

        $fecha_aviso = date('Y-m-d');
        $lugar = $_POST['lugar'];
        $desperfecto = $_POST['desperfecto'];
        $quien_aviso = $_POST['quien_aviso'];
        $quien_registro = $_POST['quien_registro'];
        $recibio_solicitud = $_POST['recibio_solicitud'];
        $hora_solicitud = $_POST['hora_solicitud'];
        $observaciones = $_POST['observaciones'];
        $tarea_cumplida = $_POST['tarea_cumplida'];
        $fecha_cumplimiento = $_POST['realiz_anio'] . "-" . $_POST['realiz_mes'] . "-" . $_POST['realiz_dia'];
        $conexion = conectar ();

        // checking empty fields
        if(empty($lugar) || empty($desperfecto) || empty($quien_aviso) || empty($quien_registro)) {
            if(empty($lugar)) {
                echo "<font color='red'>El campo lugar est&aacute; vac&iacute;o.</font><br/>";
            }

            if(empty($desperfecto)) {
                echo "<font color='red'>El campo desperfecto est&aacute; vac&iacute;o.</font><br/>";
            }

            if(empty($quien_aviso)) {
                echo "<font color='red'>Falta definir el quien avisó.</font><br/>";
            }

            if(empty($quien_registro)) {
                echo "<font color='red'>El campo quien registró esta vacio</font><br/>";
            }

            //link to the previous page
            echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
        } else {
            // if all the fields are filled (not empty)
            //insert data to database
            $result = mysqli_query($mysqli, "INSERT INTO infra VALUES(0, '$fecha_aviso', '$lugar', '$desperfecto', '$quien_aviso', '$quien_registro', '$recibio_solicitud', '$hora_solicitud', '$observaciones', '$tarea_cumplida', '$fecha_cumplimiento','')");
            echo $lugar . $desperfecto;

            //*************** MUESTRA MENSAJE GRABACIÓN EXITOSA **************
              ?>
				<script>
				var answer=alert("Datos Grabados Correctamente ")
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

<? } ?>

</html>