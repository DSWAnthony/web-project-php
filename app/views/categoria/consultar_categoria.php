<?php
require_once '../../models/crud_categoria.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    header('Content-Type: application/json');

    $id = isset($_POST['id']) && is_numeric($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        $crud = new CRUDCategoria();
        $categoria = $crud->BuscarCategoriaId($id);

        if ($categoria) {
            echo json_encode([
                'success' => true,
                'data' => $categoria
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No se encontró la categoría con ese ID.'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'ID inválido o vacío.'
        ]);
    }
    exit;
}
?>

<!-- HTML + Modal -->
<div class="modal-header">
    <h5 class="modal-title">Consultar Categoría</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="formConsultarCategoria">
        <div class="mb-3">
            <label for="id" class="form-label">ID de la Categoría</label>
            <input type="number" class="form-control" id="id" name="id" placeholder="Ingrese el ID de la categoría" required>
        </div>
    </form>
    <div id="resultadosConsulta" class="mt-4"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="btnConsultarCategoria">Consultar</button>
</div>