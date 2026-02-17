<?PHP
// Usado por asistenciaComedor.php

    session_start();
    if ($_SESSION['estado']==1) {
        include 'conexion55.php';
        $usuario=$_SESSION['usuario'];
        $conexion = conectaralumnos();

        // para pruebas
        if (isset($_SESSION['probando'])) if ($_SESSION['probando']) mysql_select_db('alumnos-prueba');

        $fecha = $_POST['fecha'];

        $codigo = (string)$_POST['codigo'];

        $digito = substr($codigo, -1);
        $documento = substr($codigo, 0, -1);

        // retorna la cantidad de INTENTOS de asistencia en el dia
        $result = mysql_query("SELECT COUNT(*) FROM comedor_asistencia WHERE dni_alumno = '$documento' AND digito_control = '$digito' AND fecha = '$fecha' AND permitido = '1' ");
        if ($result) {
            $row = mysql_fetch_assoc($result); // Obtiene la fila resultante
            $existe = $row['COUNT(*)']; // Extrae el valor del conteo
            error_log($existe . '');
            mysql_free_result($result); // Libera los recursos del resultado
            if ($existe == 0) { // Si hubo mas de un intento en el dia
                $result = mysql_query("SELECT habilitado FROM comedor_habilitados WHERE dni_alumno = '$documento' AND fecha = (SELECT MAX(fecha) FROM comedor_habilitados WHERE dni_alumno = '$documento')");
                error_log($documento . ''. mysql_num_rows($result));
                if (mysql_num_rows($result) > 0) {
                    // Obtener la fila de resultados
                    $fila = mysql_fetch_assoc($result);
                    $habilitado = $fila["habilitado"];
                    if ($habilitado == 1) { //acceso concedido

                        $sql="INSERT INTO comedor_asistencia (permitido,dni_alumno,digito_control,fecha) VALUES ('" . $habilitado . "', '" . $documento . "', '" . $digito . "', '" . $fecha . "')";
                        if (mysql_query($sql)) {
                            header('Content-Type: application/json');
                            echo json_encode(array('asistio' => $existe,'habilitado' => $habilitado));
                        }
                    } else {
                        //acceso denegador
                        $sql="INSERT INTO comedor_asistencia (permitido,dni_alumno,digito_control,fecha) VALUES ('0', '" . $documento . "', '" . $digito . "', '" . $fecha . "')";
                        if (mysql_query($sql)) {

                            header('Content-Type: application/json');
                            echo json_encode(array('asistio' => $existe,'habilitado' => $habilitado));
                        }
                    }
                } else {
                    error_log("Error en la consulta sobre habilitaciones: " . mysql_error());
                }
            } else {
                $sql="INSERT INTO comedor_asistencia (permitido,dni_alumno,digito_control,fecha) VALUES ('0', '" . $documento . "', '" . $digito . "', '" . $fecha . "')";
                if (mysql_query($sql)) {
                    // header('Content-Type: application/json');
                    // echo json_encode(array('habilitado' => $cantidadDias));
                    header('Content-Type: application/json');
                    echo json_encode(array('asistio' => $existe,'habilitado' => $habilitado));
                }
            }

        } else {
            error_log("Error en la consulta sobre asistencia: " . mysql_error());
        }
    }
?>
