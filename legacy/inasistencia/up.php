<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['archivo'])) {
    $archivos = $_FILES['archivo'];

    // Ruta donde guardar los archivos
    $directorioDestino = 'ruta/donde/guardar/';

    // Recorremos los archivos recibidos
    foreach ($archivos['tmp_name'] as $key => $ubicacionTemporal) {
        $nombreArchivo = $archivos['name'][$key];
        $rutaDestino = $directorioDestino . $nombreArchivo;

        // Movemos el archivo a la ubicación deseada en el servidor
        if (move_uploaded_file($ubicacionTemporal, $rutaDestino)) {
            echo "El archivo '$nombreArchivo' se ha cargado correctamente.";
        } else {
            echo "Error al cargar el archivo '$nombreArchivo'.";
        }
    }
}
?>
