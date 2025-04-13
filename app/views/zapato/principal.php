<?php 

require_once '../../views/layouts/header.php'; // Asegúrate de que la ruta sea correcta


?>

<div class="container mt-5">
        <h1><i class="fas fa-bars"></i> Listado de Zapatillas</h1>

        <nav>
    <div class="d-flex justify-content-center mb-4">
        <div class="btn-group" role="group" aria-label="Basic outlined example">
            <!-- Botón Registrar -->
            <button 
    type="button" 
    class="btn btn-outline-primary btn-registrar" 
    data-url="registrar_provedor.php" 
    data-bs-toggle="tooltip" 
    data-bs-placement="top" 
    title="Registrar un nuevo proveedor">
    <i class="fas fa-plus"></i> Registrar
</button>

<!-- Botón Consultar -->
<button 
    type="button" 
    class="btn btn-outline-primary btn-consultar" 
    data-url="consultar_provedor.php" 
    data-bs-toggle="tooltip" 
    data-bs-placement="top" 
    title="Consultar un proveedor">
    <i class="fas fa-search"></i> Consultar
</button>

<!-- Botón Filtrar -->
<button 
    type="button" 
    class="btn btn-outline-primary btn-filtrar" 
    data-url="filtrar_provedor.php" 
    data-bs-toggle="tooltip" 
    data-bs-placement="top" 
    title="Filtrar proveedores">
    <i class="fas fa-filter"></i> Filtrar
</button>
        </div>
    </div>