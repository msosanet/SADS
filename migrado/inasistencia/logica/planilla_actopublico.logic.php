<?php
session_start();
include 'conexion.php';
$conexion = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = trim($_POST['exceldata']);

    // 1. Normalizar saltos de línea (Windows/Linux)
    $data = str_replace(["\r\n", "\r"], "\n", $data);

    // 2. Aplanar contenido dentro de comillas (quita tabs y saltos dentro de comillas dobles)
    $data = preg_replace_callback('/"(.*?)"/s', function ($m) {
        return str_replace(["\t", "\n"], [' ', ' '], $m[0]); // reemplaza tabulaciones y \n internos
    }, $data);

    $rows = explode("\n", $data);
    $errores = 0;
    $insertadas = 0;

    foreach ($rows as $row) {
        $row = trim($row);
        if ($row == '') continue;

        $cols = preg_split("/\t/", $row);

        while (count($cols) < 21) {
            $cols[] = '';
        }

        foreach ($cols as $i => $val) {
            $cols[$i] = mysql_real_escape_string(trim($val, "\" \n\r\t"));
        }

        $numero   = $cols[1];
        $materia  = $cols[4];
        $turno    = $cols[7];
        $curydiv  = $cols[8];
        $estado   = $cols[14];
        $alta     = $cols[16];
        $dni      = $cols[17];
        $apellido = $cols[18];
        $nombre   = $cols[19];
        $tel      = $cols[20];

        if ($alta != '' && preg_match('#^(\d{1,2})/(\d{1,2})/(\d{4})$#', $alta, $m)) {
            $alta = $m[3] . '-' . str_pad($m[2], 2, '0', STR_PAD_LEFT) . '-' . str_pad($m[1], 2, '0', STR_PAD_LEFT);
        }

        $sql = "INSERT INTO actopublico 
            (numero, materia, turno, curydiv, estado, alta, dni, apellido, nombre, tel)
            VALUES ('$numero', '$materia', '$turno', '$curydiv', '$estado', '$alta', '$dni', '$apellido', '$nombre', '$tel')";

        if (!mysql_query($sql)) {
            $errores++;
        } else {
            $insertadas++;
        }
    }

    echo "<script>alert('Se insertaron $insertadas filas. Errores: $errores');</script>";
}
?>
<?php
include 'header.php';
include 'menuppal2.php';
?>


