<?php
require_once '../../models/crud_provedor.php'; // Asegúrate de que la ruta sea correcta

$crud = new CRUDProveedor();
$proveedores = $crud->ListarProveedores(); // Obtiene los proveedores desde la base de datos
?>
<link href="/web-project-php/public/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery (necesario para AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Archivo JavaScript personalizado -->
<script src="/web-project-php/public/js/provedor.js"></script>