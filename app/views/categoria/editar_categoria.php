<?php
require_once '../../models/crud_categoria.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Caso 1: Procesar la actualización
    if (isset($_POST['categoria_id'], $_POST['nombre'])) {
        $id = (int) $_POST['categoria_id'];
        $nombre = trim($_POST['nombre']);
        $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : null;

        $crud = new CRUDCategoria();
        $resultado = $crud->ActualizarCategoria($id, $nombre, $descripcion);

        echo json_encode(['success' => $resultado]);
        exit;
    }

    
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = (int) $_POST['id'];
        $crud = new CRUDCategoria();
        $categoria = $crud->BuscarCategoriaId($id);

        if ($categoria): ?>
            <div class="modal-header">
                <h5 class="modal-title">Editar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarCategoria">
                    <input type="hidden" name="categoria_id" value="<?= htmlspecialchars($categoria->categoria_id) ?>">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($categoria->nombre) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?= htmlspecialchars($categoria->descripcion ?? '') ?></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarCambiosCategoria">Guardar Cambios</button>
            </div>

            <script>
            document.getElementById('btnGuardarCambiosCategoria').addEventListener('click', function () {
                const form = document.getElementById('formEditarCategoria');
                const formData = new FormData(form);

                fetch('/web-project-php/app/views/categoria/editar_categoria.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Categoría actualizada correctamente');
                        
                    } else {
                        alert('Error al actualizar la categoría');
                    }
                })
                .catch(error => {
                    alert('Error inesperado');
                    console.error(error);
                });
            });
            </script>
        <?php else: ?>
            <div class="modal-body">
                <p>No se encontró información para esta categoría.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        <?php endif;
    } else { ?>
        <div class="modal-body">
            <p>No se proporcionó un ID válido.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
    <?php }
}
?>
