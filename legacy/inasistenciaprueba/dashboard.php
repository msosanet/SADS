<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Sistema</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Licencias</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Avisos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Info</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Notas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Faltas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Altas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Bajas</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?></h2>
        <p>Selecciona una opción del menú.</p>
    </div>
</body>
</html>