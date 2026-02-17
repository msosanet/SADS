<?php
session_start();
if ($_SESSION['estado'] != 1) {
    $ref = base64_encode($_SERVER['REQUEST_URI']);
    header('Location: i_admin.php?ref=' . $ref);
    exit;
}

include 'conexion.php';
$conexion = conectar();

if (isset($_GET['codigo'])) {
    $codigo = intval($_GET['codigo']);

    // Verificamos que exista la novedad
    $verifica = mysql_query("SELECT * FROM nov_docentes WHERE codigo = $codigo");
    if (mysql_num_rows($verifica) > 0) {
        // Borrado físico
        $resultado = mysql_query("DELETE FROM nov_docentes WHERE codigo = $codigo");

        if ($resultado) {
            echo "<script>alert('La novedad fue eliminada correctamente.');</script>";
        } else {
            echo "<script>alert('Error al intentar eliminar la novedad.');</script>";
        }
    } else {
        echo "<script>alert('La novedad no existe.');</script>";
    }

    echo "<meta http-equiv='refresh' content='0;URL=nov_docentes_vertodo.php'>";
} else {
    echo "<script>alert('Código de novedad no recibido.');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=nov_docentes_vertodo.php'>";
}
?>


