<?php
require_once '../../models/crud_categoria.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'], $_POST['descripcion'])) {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);

    $crud = new CRUDCategoria();
    $resultado = $crud->RegistrarCategoria($nombre, $descripcion);

    if ($resultado) {
        echo json_encode(['success' => true, 'message' => 'Categoría registrada correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar la categoría.']);
    }
    exit;
}
?>

<!-- Modal HTML para Registrar Categoría -->
<div class="modal-header">
    <h5 class="modal-title">Registrar Nueva Categoría</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="formRegistrarCategoria">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Categoría</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingrese la descripción" required></textarea>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="btnRegistrarCategoria">Registrar</button>
</div>