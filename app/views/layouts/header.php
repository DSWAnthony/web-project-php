<?php
include '../../config/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo isset($title) ? $title : 'ELITE'; ?></title>

    <link href="../../../public/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (necesario para AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Archivo JavaScript personalizado -->
    <script src="../../../public/js/provedor.js"></script>
    <link href="../../../public/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 


</head>

<!-- filepath: c:\xampp\htdocs\entregable\web-project-php\app\views\layouts\nav.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../home/index.php">ELITE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="../../views/zapato/principal.php">Zapatillas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../views/almacen/index.php">Almacen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../views/provedor/listar_provedor.php">Provedor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../views/categoria/listar_categoria.php">Categorías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../views/modelo/listar_modelo.php">Modelo</a>
                </li>
            </ul>
        </div>
    </div>
</nav>