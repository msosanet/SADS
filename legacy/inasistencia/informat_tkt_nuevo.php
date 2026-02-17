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

<title>INFORM&Aacute;TICA TICKET NUEVO</title>

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

<form action="informat_tkt_nuevo.php" method="post" name="form1">


    <p class="titulo" align="center">NUEVO TICKET DE ATENCI&Oacute;N INFORM&Aacute;TICA</p>
    <hr>
    <p>&nbsp;</p>
    <p><span class="titulo">FECHA: </span><span class ="titulo2"><? echo $fechaDMA; ?></span><span class="titulo"> HORA: </span><span class="titulo2"><? echo $hora; ?></span>
    <p class="titulo">SOLICITANTE: <input type="text" name="solicitante" size="30" autofocus="true"> *</p>
    <p class="titulo">LUGAR: </span><input type="text" name="lugar" size="50"></p>

    <p class="titulo">DESCRIPCI&Oacute;N DEL DESPERFECTO: </p>
        <textarea rows="4" cols="111" maxlength="200" name="desperfecto" id="desperfecto"></textarea> *

    <br>

    <p class="titulo">REGISTR&Oacute;: <input type="text" name="quien_registro" value="<? echo $userdata[nombre]; ?>"></p>

    <p class="titulo">OBSERVACIONES:</p>
         <textarea rows="3" cols="111" maxlength="200" name="observaciones" id="observaciones"></textarea>

    <p class="titulo">TAREA REALIZADA: <input type="checkbox" name="tarea_cumplida">&nbsp;&nbsp;FECHA:&nbsp;<span class="fecha">d&iacute;a<input type="text" size="2" name="realiz_dia"> mes<input type="text" size="2" name="realiz_mes"> año<input type="text" size="4" name="realiz_anio" value="<? echo date('Y'); ?>"></span>
       <span class="titulo"> HORA: <input type="text" name="hora_cumplida" size="10" value="<? echo $hora_cumplida; ?>"></span><span class="fecha"> (hh:mm)</span></p>

       <p>(*) Campo obligatorio</p>
       <br>
       <p><input type="submit" name="Submit" value="     Guardar     "></p>

</form>
</div>  <!-- ************* FIN FORMULARIO ******************** -->

<!-- *********** GRABAR CONTENIDO DEL FORMULARIO ************* -->
<?
    $mysqli = mysqli_connect("localhost","fgoicoechea","sobral2011","sid");
    if(isset($_POST['Submit'])) {


        $fecha = date('Y-m-d');
        $hora = date('H:i');
        $solicitante = $_POST['solicitante']; //campo obligatorio
        $lugar = $_POST['lugar'];
        $desperfecto = $_POST['desperfecto']; //campo obligatorio
        $quien_registro = $_POST['quien_registro'];
        $observaciones = $_POST['observaciones'];
        $tarea_finalizada = $_POST['tarea_finalizada'];
        $fecha_finalizada = $_POST['realiz_anio'] . "-" . $_POST['realiz_mes'] . "-" . $_POST['realiz_dia'];
        $hora_finalizada = $_POST['hora_finalizada'];

        // checking empty fields
        if(empty($solicitante) || empty($desperfecto)) {
            if(empty($solicitante)) {
                echo "<font color='red'>Debe ingresar un solicitante</font><br/>";
            }

            if(empty($desperfecto)) {
                echo "<font color='red'>El campo desperfecto est&aacute; vac&iacute;o.</font><br/>";
            }


        } else {
            // if all the fields are filled (not empty)
            //insert data to database
            $grabatkt = mysqli_query($mysqli, "INSERT INTO informat VALUES(0, '$fecha', '$hora', '$solicitante', '$lugar', '$desperfecto', '$quien_registro', '$observaciones', '$tarea_cumplida', '$fecha_cumplida', '$hora_cumplida','')");

            //*************** MUESTRA MENSAJE GRABACIÓN EXITOSA **************
              ?>
				<script>
				var answer=alert("Ticket de Atención Informática Grabado Correctamente ")
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