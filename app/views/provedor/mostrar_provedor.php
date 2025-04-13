<?php
require_once '../../models/crud_provedor.php'; // Asegúrate de que la ruta sea correcta

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $crud = new CRUDProveedor();
    $proveedor = $crud->BuscarProveedorPorId($id); // Llamada a la función BuscarProveedorPorId

    if ($proveedor): ?>
        <div class="modal-header">
            <h5 class="modal-title">Información del Proveedor</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($proveedor->nombre) ?></h5>
                    <p class="card-text"><strong>Contacto:</strong> <?= htmlspecialchars($proveedor->contacto) ?></p>
                    <p class="card-text"><strong>Dirección:</strong> <?= htmlspecialchars($proveedor->direccion) ?></p>
                    <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($proveedor->email) ?></p>
                    <p class="card-text"><strong>Teléfono:</strong> <?= htmlspecialchars($proveedor->telefono) ?></p>
                    <p class="card-text"><strong>RUC:</strong> <?= htmlspecialchars($proveedor->ruc) ?></p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
    <?php else: ?>
        <div class="modal-body">
            <p>No se encontró información para este proveedor.</p>
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