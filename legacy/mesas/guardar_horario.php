<?php
$conexion = new mysqli("localhost", "fgoicoechea", "sobral2011", "sid");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$plaza_id = $_POST['plaza_id'];
$horas_inicio = $_POST['hora_inicio'];
$horas_fin = $_POST['hora_fin'];

if (empty($plaza_id)) {
    die("Error: La plaza es obligatoria.");
}

$errores = [];

// Eliminar horarios anteriores de la plaza (para que no se dupliquen)
$conexion->query("DELETE FROM horarios_plaza WHERE plaza_id = '$plaza_id'");

// Insertar nuevos horarios
foreach ($horas_inicio as $dia => $turnos) {
    foreach ($turnos as $index => $hora_inicio) {
        $hora_fin = $horas_fin[$dia][$index];

        if (!empty($hora_inicio) && !empty($hora_fin)) {
            $sql = "INSERT INTO horarios_plaza (plaza_id, dia, hora_inicio, hora_fin)
                    VALUES ('$plaza_id', '$dia', '$hora_inicio', '$hora_fin')";

            if (!$conexion->query($sql)) {
                $errores[] = "Error al guardar el horario de $dia (turno ".($index+1)."): " . $conexion->error;
            }
        }
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de Guardado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .modal {
            display: block;
            position: fixed;
            z-index: 999;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: white;
            margin: auto;
            padding: 30px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 10px;
            text-align: center;
            animation: fadeIn 0.3s ease-in-out;
        }
        .modal-content h2 {
            color: #28a745;
        }
        .modal-content p {
            margin: 15px 0;
        }
        .btn {
            background-color: #FF914D;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #4DAEFF;
        }
        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }
    </style>
</head>
<body>

<div class="modal">
    <div class="modal-content">
        <?php if (empty($errores)): ?>
            <h2>? ¡Horario guardado correctamente!</h2>
            <p>Se cargaron los horarios para la plaza <?= htmlspecialchars($plaza_id) ?>.</p>
        <?php else: ?>
            <h2 style="color:red;">? Ocurrieron errores</h2>
            <?php foreach ($errores as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <button class="btn" onclick="window.location.href='alta_horarios.php?plaza_id=<?= $plaza_id ?>'">Volver</button>
    </div>
</div>

</body>
</html>
