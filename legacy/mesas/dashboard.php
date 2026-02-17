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
    <style>
        body {
            background: url('TOP SAS.png') no-repeat center center fixed;
            background-size: cover;
        }
        .welcome-container {
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }
    </style>
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="verDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Ver
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="verDropdown">
                            <li><a class="dropdown-item" href="ver_curso.php">Ver Curso</a></li>
                            <li><a class="dropdown-item" href="ver_hs_plaza.php">Ver Horarios de plazas</a></li>
                            <li><a class="dropdown-item" href="alta_horarios.php">alta horarios</a></li>
                           <li><a class="dropdown-item" href="asiste.php">Ver ingreso</a></li>
                            <li><a class="dropdown-item" href="index2.php">Ingreso</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="welcome-container">
            <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?></h2>
            <p>Selecciona una opción del menú.</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>