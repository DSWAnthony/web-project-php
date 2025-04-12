<?php
// Definir BASE_URL dinámicamente
$base_url = str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__);
define('BASE_URL', $base_url);

// Cargar configuración y controladores
require_once __DIR__.'/../app/config/conexion.php';
require_once __DIR__.'/../app/controllers/ProveedorController.php';

// Enrutamiento limpio
$request = str_replace(BASE_URL, '', $_SERVER['REQUEST_URI']);
$route = explode('?', $request)[0];

switch($route) {
    case '/proveedores':
        $controller = new ProveedorController();
        $controller->listar();
        break;
    case '/':
    default:
        require_once __DIR__.'/../app/views/layouts/header.php';
        require_once __DIR__.'/../app/views/home/home.php';
        require_once __DIR__.'/../app/views/layouts/footer.php';
        break;
}