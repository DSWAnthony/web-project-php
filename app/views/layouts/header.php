<?php
require_once '../../models/crud_provedor.php'; // Asegúrate de que la ruta sea correcta

$crud = new CRUDProveedor();
$proveedores = $crud->ListarProveedores(); // Obtiene los proveedores desde la base de datos
?>
<link href="../../../public/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
