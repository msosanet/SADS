<?PHP
// Usado por cargar_ina.php    
    // function debug_to_console($data) 
    //     {
    //         $output = $data;
    //         if (is_array($output)) {
    //             $output = implode(',', $output);
    //         }
        
    //         echo "<script>console.log('" . $output . "' );</script>";
    //     }    
    session_start();
    if ($_SESSION['estado']==1) {
        include 'conexion.php';
        conectar();

?>        
    
