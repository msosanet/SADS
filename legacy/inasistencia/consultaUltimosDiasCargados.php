<?PHP
// Usado por cargar_ina.php    
    
    session_start();
    if ($_SESSION['estado']==1) {
        
        $diasQueFaltan = $_POST['diasQueFaltan']; // Si usas POST
        // $diasQueFaltan = $_GET['diasQueFaltan']; // Si usas GET
        $fechaDesdeReferencia = $_POST['fechaDesdeReferencia'];
        $nuevaFechaDesde = $_POST['nuevaFechaDesde'];
        include 'conexion.php';
        $usuario=$_SESSION['usuario'];
        $conexion = conectar ();
        $dni=$_POST['docente'];
        
        $result = mysql_query("SELECT COUNT(*) FROM ( SELECT * FROM ausentes AS a WHERE a.fecha_desde BETWEEN '$fechaDesdeReferencia' AND '$nuevaFechaDesde' AND a.docente = '$dni' AND a.motivo = '1' ORDER BY a.fecha_desde DESC LIMIT $diasQueFaltan) AS subconsulta");
        // Enviar los datos como JSON
        $cantidadDias=0;
        if ($result) {
            $row = mysql_fetch_assoc($result); // Obtiene la fila resultante
            $cantidadDias = $row['COUNT(*)']; // Extrae el valor del conteo
            mysql_free_result($result); // Libera los recursos del resultado
        } else {
            // Manejo de errores (opcional)
            error_log("Error en la consulta: " . mysql_error());
        }
        
        // Envía los datos como JSON
        header('Content-Type: application/json');
        echo json_encode(array('cantidad' => $cantidadDias));
        // header('Content-Type: application/json');
        // echo json_encode($cantidadDias);
    
    }
?>
