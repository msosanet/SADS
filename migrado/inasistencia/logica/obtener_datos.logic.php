<?php
//ini_set('memory_limit', '512M');
$linkcalif = mysqli_connect('192.168.0.249', 'root', 'msi2010', 'sid');

mysqli_set_charset($linkcalif, "utf8mb4");

// ParÃ¡metros para paginaciÃ³n
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perPage = 10; // NÃºmero de registros por pÃ¡gina

// Calcular el desplazamiento para la paginaciÃ³n
$offset = ($page - 1) * $perPage;

$sql = "SELECT * FROM sigeTMP2 LIMIT $offset, $perPage";
$result = mysqli_query($linkcalif, $sql);

if (!$result) {
    die('Error en la consulta: ' . mysqli_error($linkcalif));
}

// Obtener todas las filas de una vez
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Cerrar la conexiÃ³n
mysqli_close($linkcalif);

echo json_encode(array("data" => $data));
?>

