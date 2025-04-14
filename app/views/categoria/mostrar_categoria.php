<?php 
require_once '../../models/crud_categoria.php'; // Asegúrate de que la ruta sea correcta

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $crud = new CRUDCategoria();
    $categoria = $crud->BuscarCategoriaPorId($id);

    if ($categoria): ?>
        <div class="modal-header">
            <h5 class="modal-title">Información de la Categoría</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($categoria->nombre) ?></h5>
                    <p class="card-text"><strong>ID:</strong> <?= htmlspecialchars($categoria->categoria_id) ?></p>
                    <p class="card-text"><strong>Descripción:</strong> <?= htmlspecialchars($categoria->descripcion ?? 'No disponible') ?></p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
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
<?php } ?>
