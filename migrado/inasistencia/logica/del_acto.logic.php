<?php
session_start();
if ($_SESSION['estado'] == 1) {
    include 'conexion.php';
    $conexion = conectar();

    if (isset($_GET['actor'])) {
        $id = intval($_GET['actor']);

        // Verificamos si existe
        $consulta = mysql_query("SELECT * FROM actopublico WHERE id = $id");
        if (mysql_num_rows($consulta) > 0) {
            $borrar = mysql_query("DELETE FROM actopublico WHERE id = $id");
            if ($borrar) {
                echo "<script>alert('Registro eliminado correctamente.'); window.location.href='".$_SERVER['HTTP_REFERER']."';</script>";
            } else {
                echo "<script>alert('Error al eliminar el registro.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('El registro no existe.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('ID no válido.'); window.history.back();</script>";
    }
} else {
    header("Location: i_admin.php");
    exit;
}
?>

