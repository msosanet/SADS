<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SIGE</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>
<body>
    <h1>Filtrando la Tabla pedorra de SIGE</h1>
    <table id="miTabla" style="width: 100%">
        <thead>
            <tr>
                <?php
                $linkcalif2 = mysqli_connect('192.168.0.249', 'root', 'msi2010', 'sid');

                $sqlCOL = "SHOW COLUMNS FROM sigeTMP2";
                $resultCOL = mysqli_query($linkcalif2, $sqlCOL);
                while ($crowCOL = mysqli_fetch_assoc($resultCOL)) {
                    echo "<th>" . $crowCOL['Field'] . "</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <!-- Los datos se cargarÃ¡n aquÃ­ con DataTables -->
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            // Inicializa la tabla con DataTables
            $('#miTabla').DataTable({
                "ajax": {
                    "url": "obtener_datos.php", // Archivo PHP para obtener los datos desde la base de datos
                    "dataSrc": "" // Nombre del objeto que contiene los datos en el JSON devuelto por el servidor
                },
                "columns": <?php
                    $sqlCOL = "SHOW COLUMNS FROM sigeTMP2";
                    $resultCOL = mysqli_query($linkcalif2, $sqlCOL);
                    $columnas = array();
                    while ($crowCOL = mysqli_fetch_assoc($resultCOL)) {
                        $columnas[] = array("data" => $crowCOL['Field']);
                    }
                    echo json_encode($columnas);
                ?>,
                // Puedes personalizar mÃ¡s opciones segÃºn tus necesidades
            });
        });
    </script>
</body>
</html>

