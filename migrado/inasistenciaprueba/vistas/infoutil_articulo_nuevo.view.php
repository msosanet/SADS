<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />

<script src="ckeditor/ckeditor.js"></script>

<title>INFO UTIL - ARTICULO NUEVO</title>

</head>

<?
include 'header.php';
//$conexion = conectar();
$usuario = $_SESSION['usuario'];
$pass = $_SESSION['contrasenia'];
$resultt = mysqli_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysqli_fetch_array($resultt);
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
<!-- *********** FORMULARIO CARGA AVISOS ***************** -->
<div id="nov_form_container" align="center">

<form action="infoutil_articulo_nuevo.php" method="post" name="form1">

    <p class="titulo">ARTICULO NUEVO</p>
    <hr>
    <p>&nbsp;</p>
    <p class="titulo2">TITULO PARA MENÚ (máx 25 caracteres)
        <input type="text" name="titulo"> ORDEN <input type="text" name="orden">
    </p>
    <p>&nbsp;</p>
    <p class="titulo2">GRUPO
    <input type="radio" name="grupo" value="datos"> Datos |
    <input type="radio" name="grupo" value="alumnos"> Alumnos |
    <input type="radio" name="grupo" value="docentes"> Docentes |
    <input type="radio" name="grupo" value="mesaent"> Mesa Entradas |
    </p>
    <p>&nbsp;</p>
        <textarea rows="7" cols="100" maxlength="65000" name="detalle" id="detalle"></textarea>

        <script>
           CKEDITOR.replace( 'detalle' );
        </script>

    <p>&nbsp;</p>
       <p><input type="submit" name="Submit" value="     Guardar     "></p>

<p><a href="infoutil_admin.php"> VOLVER A PANEL DE ADMINISTRACIÓN</a></p>

</form>
</div>  <!-- ************* FIN FORMULARIO ******************** -->

<!-- *********** GRABAR CONTENIDO DEL FORMULARIO ************* -->
<?
    $mysqli = mysqli_connect("localhost","fgoicoechea","sobral2011","sid");
    if(isset($_POST['Submit'])) {
        $fecha = date('Y-m-d');
        $grabo = $_SESSION['usuario'];
        $titulo = $_POST['titulo'];
        $orden = $_POST['orden'];
        $grupo = $_POST['grupo'];
        $detalle = $_POST['detalle'];
        $conexion = conectar ();

        // checking empty fields
        if(empty($titulo) || empty($orden) || empty($grupo) || empty($detalle)) {
            if(empty($titulo)) {
                echo "<font color='red'>El campo titulo est&aacute; vac&iacute;o.</font><br/>";
            }

            if(empty($orden)) {
                echo "<font color='red'>El campo orden est&aacute; vac&iacute;o.</font><br/>";
            }

            if(empty($grupo)) {
                echo "<font color='red'>Falta definir el grupo.</font><br/>";
            }

            if(empty($detalle)) {
                echo "<font color='red'>El campo detalle esta vacio</font><br/>";
            }

            //link to the previous page
            echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
        } else {
            // if all the fields are filled (not empty)
            //insert data to database
            $result = mysqli_query($mysqli, "INSERT INTO infoutil VALUES(0,'$fecha','$grabo','$titulo','$orden', '$grupo', '$detalle',0)");

            //*************** MUESTRA MENSAJE GRABACIÓN EXITOSA **************
            echo "<font color='green'>Datos agregados correctamente.</font>";

        }
    }
?>

<p>&nbsp;</p>

<? include 'footer.php'; ?>

</div> <!-- ****************** FIN DIV PRINCIPAL ************ -->
</body>

<? } ?>

</html>
