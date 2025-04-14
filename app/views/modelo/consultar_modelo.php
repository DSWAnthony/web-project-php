<?php
require_once '../../models/crud_modelo.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Caso 1: Procesar la consulta
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Instanciar el CRUD y obtener los datos del modelo por ID
        $crud = new CRUDModelo();
        $modelo = $crud->BuscarModeloPorId($id);

        if ($modelo) {
            echo json_encode(['success' => true, 'data' => $modelo]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se encontró el modelo con el ID proporcionado.']);
        }
        exit; // Detener la ejecución para evitar contenido adicional
    } else {
        echo json_encode(['success' => false, 'message' => 'No se proporcionó un ID para consultar.']);
        exit; // Detener la ejecución
    }
}

// Caso 2: Mostrar el formulario de consulta
?>
<div class="modal-header">
    <h5 class="modal-title">Consultar Modelo</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="formConsultarModelo">
        <div class="mb-3">
            <label for="id" class="form-label">ID del Modelo</label>
            <input type="text" class="form-control" id="id" name="id" placeholder="Ingrese el ID del modelo" required>
        </div>
    </form>
    <div id="resultadosConsulta" class="mt-4">
        <!-- Aquí se mostrarán los detalles del modelo -->
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="btnConsultarModelo">Consultar</button>
</div>