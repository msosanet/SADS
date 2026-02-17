<?PHP
/* Asistencia comedor. Desarrollo original: Agustín Dominguez
 *
 * Utiliza un campo que oninput espera que dejen de ingresar numeros
 * durante 1 segundo y verifica que el código corresponda a un estudiante
 * autorizado a ingresar o no al comedor. Al comprobar con el servidor
 * muestra una alerta de acuerdo al caso
 *
 * */

    function debug_to_console($data)
        {
            $output = $data;
            if (is_array($output)) {
                $output = implode(',', $output);
            }

            echo "<script>console.log('" . $output . "' );</script>";
        }
    session_start();

	// $_SESSION['probando'] = true; // Comentar en producción

    if ($_SESSION['estado']==1) {
        include 'conexion55.php';
        conectaralumnos();
        if (isset($_SESSION['probando'])) if ($_SESSION['probando']) mysql_select_db('alumnos-prueba');

?>
    
