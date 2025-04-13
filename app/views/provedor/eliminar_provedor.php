<?php
require_once '../../models/crud_provedor.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que se reciba el ID del proveedor
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = (int) $_POST['id'];

        // Instanciar el CRUD y eliminar el proveedor
        $crud = new CRUDProveedor();
        $resultado = $crud->EliminarProveedor($id);

        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Proveedor eliminado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar el proveedor.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID inválido o no proporcionado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}