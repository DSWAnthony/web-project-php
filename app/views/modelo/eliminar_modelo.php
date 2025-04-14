<?php
require_once '../../models/crud_modelo.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se recibió el parámetro 'id'
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Instanciar el CRUD y eliminar el modelo por ID
        $crud = new CRUDModelo();
        $resultado = $crud->EliminarModelo($id);

        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Modelo eliminado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar el modelo.']);
        }
        exit; // Detener la ejecución para evitar contenido adicional
    } else {
        echo json_encode(['success' => false, 'message' => 'No se proporcionó un ID para eliminar.']);
        exit; // Detener la ejecución
    }
}
?>

<!-- Formulario para confirmar la eliminación -->
<div class="modal-header">
    <h5 class="modal-title">Eliminar Modelo</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <p>¿Estás seguro de que deseas eliminar este modelo?</p>
    <form id="formEliminarModelo">
        <input type="hidden" id="id" name="id">
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="button" class="btn btn-danger" id="btnEliminarModelo">Eliminar</button>
</div>