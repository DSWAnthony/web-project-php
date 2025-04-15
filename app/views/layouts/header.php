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
    <script src="../../../public/js/modelo.js"></script>
    
    
   
    <link href="../../../public/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 


</head>

<<<<<<< HEAD
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../home/index.php">ELITE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
=======
<nav class="navbar navbar-expand-lg navbar-dark shadow sticky-top" style="background: linear-gradient(90deg, #111 0%, #222 100%);">
    <div class="container-fluid px-4">
       
        <a class="navbar-brand d-flex align-items-center fw-bold" href="../home/index.php">
            <img src="../../../public/img/imagen1.png" alt="Logo" width="40" height="40" class="me-2 rounded-circle">
            ELITE
        </a>

        <!-- Botón responsive -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
>>>>>>> 2108e96009da811a0bcf1392bcc2e9c4c732be76
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Enlaces -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active fw-semibold" href="../../views/zapato/principal.php">
                        <i class="fas fa-shoe-prints me-1"></i> Zapatillas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="../../views/almacen/principal.php">
                        <i class="fas fa-warehouse me-1"></i> Almacén
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="../../views/provedor/listar_provedor.php">
                        <i class="fas fa-truck me-1"></i> Proveedor
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="../../views/categoria/listar_categoria.php">
                        <i class="fas fa-tags me-1"></i> Categorías
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="../../views/modelo/listar_modelo.php">
                        <i class="fas fa-cubes me-1"></i> Modelo
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
