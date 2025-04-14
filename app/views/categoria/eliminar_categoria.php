<?php 
require_once '../../models/crud_categoria.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que se reciba el ID de la categoría
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = (int) $_POST['id'];

        // Instanciar el CRUD y eliminar la categoría
        $crud = new CRUDCategoria();
        $resultado = $crud->EliminarCategoria($id);

        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Categoría eliminada correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar la categoría.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID inválido o no proporcionado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>
