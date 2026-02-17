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

<title>INFORM&Aacute;TICA - MODIFICAR TICKET</title>

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

$informattkt = mysqli_query($mysqli,"SELECT * FROM informat WHERE id = $id");

while($tktdata = mysqli_fetch_array($informattkt))
{
    $fecha = $tktdata['fecha'];
    $fechaDMA = substr($fecha,-2) . "-" . substr($fecha,-5,2) . "-" . substr($fecha, 0, 4);
    $hora = $tktdata['hora'];
    $solicitante = $tktdata['solicitante'];
    $lugar = $tktdata['lugar'];
    $desperfecto = $tktdata['desperfecto'];
    $quien_registro = $tktdata['quien_registro'];
    $observaciones = $tktdata['observaciones'];
    $tarea_finalizada = $tktdata['tarea_finalizada'];
    $fecha_finalizada = $tktdata['fecha_finalizada'];
    $hora_finalizada = $tktdata['hora_finalizada'];
}
?>
<!-- ++++++++++ FIN CARGA REGISTRO A MODIFICAR ++++++++++++ -->

<!-- *********** FORMULARIO TICKET A MODIFICAR ***************** -->
<div id="nov_form_container" align="left">

<form name="form1" method="post" action="informat_tkt_modificar.php">

    <p align="center" class="titulo">MODIFICAR TICKET INFORM&Aacute;TICA</p>
    <hr>
    <br>
    <p><span class="titulo"><? echo "TICKET Nº " . $id . "</span>, registrado el <span class='titulo'>" . $fechaDMA . "</span>, a la hora <span class='titulo'>" . substr($hora, 0, 5); ?></span></p>

    <p class="titulo">SOLICITANTE: <input type="text" name="solicitante" size="50" value="<? echo $solicitante; ?>"></p>
    <p class="titulo">LUGAR: <input type="text" name="lugar" size="50" value="<? echo $lugar; ?>"></p>
    <p class="titulo">DESCRIPCI&Oacute;N DEL DESPERFECTO:</p>
        <textarea rows="4" cols="112" maxlength="300" name="desperfecto" id="desperfecto"><? echo $desperfecto;?></textarea>

    <p class="titulo">REGISTR&Oacute;: <input type="text" name="quien_registro" value="<? echo $quien_registro; ?>"></p>

     <p class="titulo">OBSERVACIONES:</p>
        <textarea rows="3" cols="112" maxlength="200" name="observaciones" id="observaciones"><? echo $observaciones; ?></textarea>

       <p class="titulo">TAREA REALIZADA:
       <? if ($tarea_finalizada == 'on') {
          echo "<input type='checkbox' name='tarea_finalizada' checked>";
       }
       else {
          echo "<input type='checkbox' name='tarea_finalizada'>";
       }
       ?>
       &nbsp;&nbsp;

       FECHA:&nbsp;<span class="fecha">d&iacute;a<input type="text" size="2" name="realiz_dia" value="<? echo substr($fecha_finalizada,-2); ?>"> mes<input type="text" size="2" name="realiz_mes" value="<? echo substr($fecha_finalizada,-5,2); ?>"> año<input type="text" size="4" name="realiz_anio" value="<? echo substr($fecha_finalizada, 0, 4); ?>"></span>
       HORA: <input type="text" name="hora_finalizada" size="10" value="<? echo $hora_finalizada; ?>"><span class="fecha">(hh:mm)</span>
       </p>

    <input type="hidden" name="id" value=<? echo $_GET['id']; ?>>

    <br>
    <p><input type="submit" name="update" value="     Actualizar     "></p>

</form>
</div>  <!-- ************* FIN FORMULARIO ******************** -->

<!-- *********** GRABAR CONTENIDO DEL FORMULARIO ************* -->
<?
    //$mysqli = mysqli_connect("localhost","fgoicoechea","sobral2011","sid"); //la variable $mysqli se cargó al principio del script
    if(isset($_POST['update'])) {

        //****************************************************
    $id = $_POST['id'];
    //$fecha = $tktdata['fecha'];
    //$hora = $tktdata['hora'];
    $solicitante = $_POST['solicitante'];
    $lugar = $_POST['lugar'];
    $desperfecto = $_POST['desperfecto'];
    $quien_registro = $_POST['quien_registro'];
    $observaciones = $_POST['observaciones'];
    $tarea_finalizada = $_POST['tarea_finalizada'];
    $fecha_finalizada = $_POST['realiz_anio'] . "-" . $_POST['realiz_mes'] . "-" . $_POST['realiz_dia'];
    $hora_finalizada = $_POST['hora_finalizada'];

    //$conexion = conectar ();

        // checking empty fields
        if(empty($solicitante) || empty($lugar) || empty($desperfecto)) {
            if(empty($solicitante)) {
                echo "<font color='red'>Falta definir 'Solicitante'</font><br/>";
            }

            if(empty($desperfecto)) {
                echo "<font color='red'>El campo 'desperfecto' est&aacute; vac&iacute;o.</font><br/>";
            }

            //link to the previous page
            //echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
        } else
        {
            //si todos los campos se encuentran completos
            //grabar las modificaciones
    $grabartkt = mysqli_query($mysqli, "UPDATE informat SET solicitante = '$solicitante' , lugar = '$lugar', desperfecto = '$desperfecto' , quien_registro = '$quien_registro', observaciones = '$observaciones', tarea_finalizada = '$tarea_finalizada', fecha_finalizada = '$fecha_finalizada', hora_finalizada = '$hora_finalizada' WHERE id = $id");

            //*************** MUESTRA MENSAJE GRABACIÓN EXITOSA **************
            //echo "<font color='green'>Aviso modificado correctamente.<br></font>";
            ?>
				<script>
				var answer=alert("Datos Grabados Correctamente ")
				</script>
				<meta http-equiv='refresh' content='0; URL=informat_admin.php'>
				<?
        }
//******************** FIN GRABA REGISTRO *****************************
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

