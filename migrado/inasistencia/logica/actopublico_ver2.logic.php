<?php
include 'conexion.php';
conectar();

// PAGINACIÓN
$por_pagina = 50;
$pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$inicio = ($pagina - 1) * $por_pagina;

// OBTENER TOTAL DE REGISTROS
$total_resultado = mysql_query("SELECT COUNT(*) as total FROM actopublico");
$total_fila = mysql_fetch_assoc($total_resultado);
$total_registros = $total_fila['total'];
$total_paginas = ceil($total_registros / $por_pagina);
?>


