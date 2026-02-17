<?php
// Obtener el criterio de bÃºsqueda desde GET
$criterio = isset($_GET['criterio']) ? $_GET['criterio'] : '';

// URL a buscar
$url = 'https://inasistencias2.colegiosobral.edu.ar/flexshare/secretaria-sobral/ANOTAS/ANOTAS%202023/';

// Obtener el contenido de la URL
$contenido = file_get_contents($url);

// Realizar la bÃºsqueda en el contenido
$resultados = [];
if ($contenido !== false) {
    // Buscar el criterio en el contenido
    preg_match_all("/<a[^>]*href=\"([^\"]*)\"[^>]*>(.*?)<\/a>/", $contenido, $coincidencias, PREG_SET_ORDER);

    // Filtrar las coincidencias segÃºn el criterio
    foreach ($coincidencias as $coincidencia) {
        $enlace = $coincidencia[1];
        $textoEnlace = $coincidencia[2];

        // Buscar una coincidencia parcial (aproximada) en el texto del enlace
        if (stripos($textoEnlace, $criterio) !== false) {
            $resultados[] = $enlace;
        }
    }
}

// Mostrar los resultados
echo "<h2>Resultados de la bÃºsqueda para el criterio aproximado: $criterio</h2>";
if (!empty($resultados)) {
    echo "<ul>";
    foreach ($resultados as $resultado) {
        echo "<li><a href='$resultado'>$resultado</a></li>";
    }
    echo "</ul>";
} else {
    echo "No se encontraron resultados para el criterio aproximado: $criterio";
}
?>

