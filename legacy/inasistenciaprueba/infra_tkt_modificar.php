<?PHP
session_start();
if ($_SESSION['estado']==1) {
//include 'conexion.php';
$mysqli = mysqli_connect("localhost", "fgoicoechea", "sobral2011", "sid");
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

<title>INFRAESTRUCTURA - MODIFICAR TICKET</title>

</head>

<!-- ************ MODIFICACION DE TICKET ***************** -->

<?

//$conexion = conectar();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$chkusr = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario'");
$userdata = mysql_fetch_array($chkusr);
?>

<body>
<div id="marco980" align="center"><!-- ***** DIV PRINCIPAL *** -->

<!-- **************** BARRA DE MENÚS *************** -->
<?
include 'header.php';

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



<!-- ++++++++++ CARGA TICKET A MODIFICAR ++++++++++++ -->



<?

//if (($usuario == 'lsosa') or ($usuario == 'jtibaudin')) { //Comprueba el nombre del usuario; si no es Laura Sosa o Jose Luis Tibaudin no permite hacer modificaciones
// echo $usuario;
//} else {
//  echo "algo anda mal";

//}

//getting id from url
$id = $_GET['id'];
//seleccionar datos asociados con este código en particular

$infratkt = mysqli_query($mysqli,"SELECT * FROM infra WHERE id = $id");

while($tktdata = mysqli_fetch_array($infratkt))
{
    $fecha_aviso = $tktdata['fecha_aviso'];
    $fechaDMA = substr($fecha_aviso,-2) . "-" . substr($fecha_aviso,-5,2) . "-" . substr($fecha_aviso, 0, 4);
    $lugar = $tktdata['lugar'];
    $desperfecto = $tktdata['desperfecto'];
    $quien_aviso = $tktdata['quien_aviso'];
    $quien_registro = $tktdata['quien_registro'];
    $recibio_solicitud = $tktdata['recibio_solicitud'];
    $hora_solicitud = $tktdata['hora_solicitud'];
    $observaciones = $tktdata['observaciones'];
    $tarea_cumplida = $tktdata['tarea_cumplida'];
    $fecha_cumplimiento = $tktdata['fecha_cumplimiento'];
}
?>
<!-- ++++++++++ FIN CARGA REGISTRO A MODIFICAR ++++++++++++ -->

<!-- *********** FORMULARIO TICKET A MODIFICAR ***************** -->
<div id="nov_form_container" align="left">

<form name="form1" method="post" action="infra_tkt_modificar.php">

    <p align="center" class="titulo">MODIFICAR TICKET</p>
    <hr>
    <p><span class="titulo"><? echo "TICKET Nº " . $id . "</span>, registrado el <span class='titulo'>" . $fechaDMA; ?></span></p>
    <p>&nbsp;</p>

    <p class="titulo">LUGAR: <input type="text" name="lugar" size="70" value="<? echo $lugar; ?>"></p>

    <p>&nbsp;</p>
    <p class="titulo">DESCRIPCI&Oacute;N DEL DESPERFECTO:</p>
        <textarea rows="4" cols="112" maxlength="300" name="desperfecto" id="desperfecto"><?echo $desperfecto;?></textarea>

    <p>&nbsp;</p>

    <p class="titulo">AVIS&Oacute;: <input type="text" name="quien_aviso" size="30" value="<? echo $quien_aviso; ?>">
     &nbsp;REGISTR&Oacute;: <input type="text" name="quien_registro" value="<? echo $quien_registro; ?>"></p>
    <p class="titulo"><u>SOLICITUD</u></p>
    <p class="titulo">
       RECIBI&Oacute;: <input type="text" name="recibio_solicitud" size="30" value="<? echo $recibio_solicitud; ?>">
       HORA: <input type="text" name="hora_solicitud" size="10" value="<? echo $hora_solicitud; ?>"><span class="fecha">(hh:mm)</span>
    </p>

     <p class="titulo">OBSERVACIONES:</p>
        <textarea rows="2" cols="112" maxlength="200" name="observaciones" id="observaciones"><? echo $observaciones; ?></textarea>

       <p class="titulo">TAREA REALIZADA:
       <? if ($tarea_cumplida == 'on') {
          echo "<input type='checkbox' name='tarea_cumplida' checked>";
       }
       else {
          echo "<input type='checkbox' name='tarea_cumplida'>";
       }
       ?>&nbsp;&nbsp;

       FECHA:&nbsp;<span class="fecha">d&iacute;a<input type="text" size="2" name="realiz_dia" value="<? echo substr($fecha_cumplimiento,-2); ?>"> mes<input type="text" size="2" name="realiz_mes" value="<? echo substr($fecha_cumplimiento,-5,2); ?>"> año<input type="text" size="4" name="realiz_anio" value="<? echo substr($fecha_cumplimiento, 0, 4); ?>"></span></p>

    <input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>
    <br>
    <p><input type="submit" name="update" value="     Actualizar     "></p>

</form>
</div>  <!-- ************* FIN FORMULARIO ******************** -->

<!-- *********** GRABAR CONTENIDO DEL FORMULARIO ************* -->
<?
    $mysqli = mysqli_connect("localhost","fgoicoechea","sobral2011","sid");
    if(isset($_POST['update'])) {

        //****************************************************
    $id = $_POST['id'];
    //$fecha_aviso = $tktdata['fecha_aviso'];
    $lugar = $_POST['lugar'];
    $desperfecto = $_POST['desperfecto'];
    $quien_aviso = $_POST['quien_aviso'];
    $quien_registro = $_POST['quien_registro'];
    $recibio_solicitud = $_POST['recibio_solicitud'];
    $hora_solicitud = $_POST['hora_solicitud'];
    $observaciones = $_POST['observaciones'];
    $tarea_cumplida = $_POST['tarea_cumplida'];
    $fecha_cumplimiento = $_POST['realiz_anio'] . "-" . $_POST['realiz_mes'] . "-" . $_POST['realiz_dia'];



        //$conexion = conectar ();
        // checking empty fields
        if(empty($lugar) || empty($desperfecto) || empty($quien_aviso)) {
            if(empty($lugar)) {
                echo "<font color='red'>Falta definir 'lugar'</font><br/>";
            }

            if(empty($desperfecto)) {
                echo "<font color='red'>El campo 'desperfecto' est&aacute; vac&iacute;o.</font><br/>";
            }

            if(empty($quien_aviso)) {
              echo "<font color='red'>Indicar qui&eacute;n inform&oacute; del desperfecto</font><br/>";
            }

            //link to the previous page
            //echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
        } else
        {
            //si todos los campos se encuentran completos
            //grabar las modificaciones
            $grabartkt = mysqli_query($mysqli, "UPDATE infra SET lugar = '$lugar', desperfecto = '$desperfecto', quien_aviso = '$quien_aviso', quien_registro = '$quien_registro', recibio_solicitud  = '$recibio_solicitud', hora_solicitud  = '$hora_solicitud', observaciones = '$observaciones', tarea_cumplida = '$tarea_cumplida', fecha_cumplimiento = '$fecha_cumplimiento' WHERE id = $id");

            //*************** MUESTRA MENSAJE GRABACIÓN EXITOSA **************
            echo "<font color='green'>Aviso modificado correctamente.<br></font>";

            ?>
				<script>
				var answer=alert("Datos Grabados Correctamente ")
				</script>
				<meta http-equiv='refresh' content='0; URL=infra_admin.php'>
				<?
        }
    }
?>

<p>&nbsp;</p>
<? include 'footer.php'; ?>

</div> <!-- ****************** FIN DIV PRINCIPAL ************ -->
</body>
</html>
<?
}
?>
