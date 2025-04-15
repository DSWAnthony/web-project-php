<?php
require_once '../../models/crud_categoria.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar el registro de la categoría
    if (isset($_POST['nombre'], $_POST['descripcion'])) {
        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);

        $crud = new CRUDCategoria();
        $resultado = $crud->RegistrarCategoria($nombre, $descripcion);

        echo json_encode(['success' => $resultado]);
        exit;
    }
}
?>

<!-- Modal para Registrar Categoría -->
<div class="modal-header">
    <h5 class="modal-title">Registrar Nueva Categoría</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="formRegistrarCategoria">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Categoría</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="button" class="btn btn-primary" id="btnRegistrarCategoria">Registrar</button>
</div>

<script>
document.getElementById('btnRegistrarCategoria').addEventListener('click', function () {
    const form = document.getElementById('formRegistrarCategoria');
    const formData = new FormData(form);

    fetch('/web-project-php/app/views/categoria/registrar_categoria.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Categoría registrada correctamente');
            document.getElementById('mainModal').classList.remove('show'); // Cerrar el modal
            location.reload(); // Recargar la página para mostrar la nueva categoría
        } else {
            alert('Error al registrar la categoría');
        }
    })
    .catch(error => {
        alert('Error inesperado');
        console.error(error);
    });
});
</script>