<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

<script src="ckeditor/ckeditor.js"></script>

<title>NOVEDADES PARA DOCENTES</title>

</head>

<!-- ************ MODIFICACION DE AVISO ***************** -->

<?

//$conexion = conectar();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt);
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



<!-- ++++++++++ CARGA DATOS DEL REGISTRO A MODIFICAR ++++++++++++ -->

<?
//getting id from url
$codigo = $_GET['codigo'];
//seleccionar datos asociados con este código en particular

$result = mysqli_query($mysqli,"SELECT * FROM nov_docentes WHERE codigo = $codigo");

while($res = mysqli_fetch_array($result))
{
    $categoria = $res['categoria'];
    $tema = $res['tema'];
    $aviso = $res['aviso'];
    $vencimiento = $res['vencimiento'];
}
?>


<!-- *********** FORMULARIO AVISO A MODIFICAR ***************** -->
<div id="nov_form_container" align="left">

<form name="form1" method="post" action="nov_aviso_modificar.php">

    <p class="titulo2" align="center">MODIFICAR AVISO</p>
    <hr>
    <p>&nbsp;</p>
    <p class="titulo2">TEMA</p>
        <textarea rows="1" cols="50" maxlength="100" name="tema"><? echo $tema; ?></textarea>
    <p>&nbsp;</p>
    <p><span class="titulo2">TEXTO DEL AVISO</span><span class="fecha"> (Máx 500 caracteres)</span></p>
        <textarea rows="4" cols="100" maxlength="500" name="aviso"><?echo $aviso;?></textarea>

        <script>
           CKEDITOR.replace( 'aviso' );
        </script>

    <p>&nbsp;</p>
    <p class="titulo2">
       <input type="radio" name="categoria" value="doc" <? if ($categoria == "doc") { echo "checked"; } ?> > Docentes |
       <input type="radio" name="categoria" value="alu" <? if ($categoria == "alu") { echo "checked"; } ?> > Alumnos |
       <input type="radio" name="categoria" value="adm" <? if ($categoria == "adm") { echo "checked"; } ?> > Administraci&oacute;n
    </p>
<!-- ************** INGRESAR FECHA VENCIMIENTO *************** -->
    <p class="titulo2">&nbsp;<br>
    VENCIMIENTO</p>
    <input type="text" name="vencimiento" id="vencimiento"  maxlength="10" value="<? echo $vencimiento;?>">
 					<img src="calendario.png" width="20" height="20" border="0" title="vencimiento" id="fechas1">
						<!-- script que define y configura el calendario-->
						<script type="text/javascript">
	   					Calendar.setup({
	    					inputField:"vencimiento",     // id del campo de texto
	    					ifFormat:"%Y-%m-%d",          // formato de la fecha que se escriba en el campo de texto
						button:"fechas1"                  // el id del bot&oacute;n que lanzar&aacute; el calendario
								});
						</script>
<!-- ******************* FIN FECHA VENCIMIENTO ********************* -->

    <p>&nbsp;</p>
    <input type="hidden" name="codigo" value=<?php echo $_GET['codigo'];?>>
    <p><input type="submit" name="update" value="     Actualizar     "></p>

</form>
</div>  <!-- ************* FIN FORMULARIO ******************** -->

<!-- *********** GRABAR CONTENIDO DEL FORMULARIO ************* -->
<?
    $mysqli = mysqli_connect("localhost","fgoicoechea","sobral2011","sid");
    if(isset($_POST['update'])) {
        $codigo = $_POST['codigo'];
        $categoria = $_POST['categoria'];
        $tema = $_POST['tema'];
        $aviso = $_POST['aviso'];
        $date = date('Y-m-d');
        $usuario = $_SESSION['usuario'];
        $vencimiento = $_POST['vencimiento'];
        //$conexion = conectar ();
        // checking empty fields
        if(empty($tema) || empty($aviso) || empty($categoria) || empty($vencimiento)) {
            if(empty($tema)) {
                echo "<font color='red'>El campo Tema est&aacute; vac&iacute;o.<br/>";
            }

            if(empty($aviso)) {
                echo "<font color='red'>El campo Aviso est&aacute; vac&iacute;o.</font><br/>";
            }

            if(empty($categoria)) {
                echo "<font color='red'>Falta definir una categor&iacute;a.</font><br/>";
            }

            if(empty($vencimiento)) {
                echo "<font color='red'>Falta definir una fecha de vencimiento.</font><br/>";
            }

            //link to the previous page
            echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
        } else
        {
            // if all the fields are filled (not empty)
            //grabar las modificaciones
            $result = mysqli_query($mysqli, "UPDATE nov_docentes SET categoria = '$categoria', tema = '$tema', aviso = '$aviso', fecha = '$date', grabo  = '$usuario', vencimiento = '$vencimiento', borrado = 1 WHERE codigo = $codigo");

            //*************** MUESTRA MENSAJE GRABACIÓN EXITOSA **************
            echo "<font color='green'>Aviso modificado correctamente.<br></font>";

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

