<?php
class ProveedorController {
    private $model;

    public function __construct() {
        require_once __DIR__.'/../models/ProveedorModel.php';
        $this->model = new ProveedorModel();
    }

    public function listar() {
        // Obtener datos
        $proveedores = $this->model->listarProveedores();
        
        // Cargar vistas con layout
        require_once __DIR__.'/../views/layouts/header.php';
        require_once __DIR__.'/../views/proveedor/listar.php';
        require_once __DIR__.'/../views/layouts/footer.php';
        
        exit(); // Importante para evitar carga duplicada
    }
}