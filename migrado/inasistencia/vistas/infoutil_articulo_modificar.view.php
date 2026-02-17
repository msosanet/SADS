<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />    <script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO")
}
</script>

<script src="ckeditor/ckeditor.js"></script>

<title>INFO UTIL - MODIFICAR DATO</title>

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



<!-- ++++++++++ CARGA REGISTRO A MODIFICAR ++++++++++++ -->

<?
//getting id from url
$id = $_GET['id'];
//seleccionar datos asociados con este código en particular

$result = mysqli_query($mysqli,"SELECT * FROM infoutil WHERE id = $id");

while($res = mysqli_fetch_array($result))
{
    $titulo = $res['titulo'];
    $orden = $res['orden'];
    $grupo = $res['grupo'];
    $detalle = $res['detalle'];
    $ocultar = $res['ocultar'];
}
?>
<!-- ++++++++++ FIN CARGA REGISTRO A MODIFICAR ++++++++++++ -->

<!-- *********** FORMULARIO ARTICULO A MODIFICAR ***************** -->
<div id="nov_form_container" align="left">

<form name="form1" method="post" action="infoutil_articulo_modificar.php">

    <p class="titulo2" align="center">MODIFICAR ART&Iacute;CULO</p>
    <hr>
    <p>&nbsp;</p>
    <p class="titulo2">TITULO <span class="fecha">(máx 25 caracteres)</span>
        <input type="text" name="titulo" value="<? echo $titulo; ?>"> ORDEN <input type="text" name="orden" size="2" value="<? echo $orden; ?>">
    </p>
    <p>&nbsp;</p>
    <p class="titulo2">GRUPO
    <input type="radio" name="grupo" value="datos" <? if ($grupo == "datos") { echo "checked"; } ?> > Datos |
    <input type="radio" name="grupo" value="alumnos" <? if ($grupo == "alumnos") { echo "checked"; } ?> > Alumnos |
    <input type="radio" name="grupo" value="docentes" <? if ($grupo == "docentes") { echo "checked"; } ?> > Docentes |
    <input type="radio" name="grupo" value="mesaent" <? if ($grupo == "mesaent") { echo "checked"; } ?> > Mesa Entradas |
    </p>
    <p>&nbsp;</p>
        <textarea rows="7" cols="100" maxlength="65000" name="detalle" id="detalle"><?echo $detalle;?></textarea>

        <script>
           CKEDITOR.replace( 'detalle' );
        </script>

    <p>&nbsp;</p>

    <input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>
    <p><input type="submit" name="update" value="     Actualizar     "></p>

</form>
</div>  <!-- ************* FIN FORMULARIO ******************** -->

<!-- *********** GRABAR CONTENIDO DEL FORMULARIO ************* -->
<?
    $mysqli = mysqli_connect("localhost","fgoicoechea","sobral2011","sid");
    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $fecha = date('Y-m-d');
        $grabo = $_SESSION['usuario'];
        $titulo = $_POST['titulo'];
        $orden = $_POST['orden'];
        $grupo = $_POST['grupo'];
        $detalle = $_POST['detalle'];
        //$conexion = conectar ();
        // checking empty fields
        if(empty($titulo) || empty($orden) || empty($grupo) || empty($detalle)) {
            if(empty($titulo)) {
                echo "<font color='red'>El campo titulo est&aacute; vac&iacute;o.</font><br/>";
            }

            if(empty($orden)) {
                echo "<font color='red'>El campo orden est&aacute; vac&iacute;o.</font><br/>";
            }

            if(empty($detalle)) {
              echo "<font color='red'>El campo detalle esta vacio</font><br/>";
            }

            if(empty($grupo)) {
              echo "<font color='red'>Falta definir grupo.</font><br/>";
            }

            //link to the previous page
            echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
        } else
        {
            // if all the fields are filled (not empty)
            //grabar las modificaciones
            $result = mysqli_query($mysqli, "UPDATE infoutil SET titulo = '$titulo', orden = '$orden', grupo = '$grupo', detalle = '$detalle', fecha = '$fecha', grabo  = '$grabo', ocultar = '0' WHERE id = $id");

            //*************** MUESTRA MENSAJE GRABACIÓN EXITOSA ************** ?>
				<script>
				var answer=alert("Datos Grabados Correctamente ")
				</script>
				<meta http-equiv='refresh' content='0; URL=infoutil_admin.php'>
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

