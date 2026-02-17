<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Asistencia</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 20px; }
        table { width: 80%; margin: auto; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .asistio { color: green; font-weight: bold; }
        .ausente { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <h2>Consultar Asistencia</h2>
    <form action="procesar.php" method="GET">
        <label for="fecha">Seleccione la fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
        <button type="submit">Verificar Asistencia</button>
    </form>

</body>
</html>
