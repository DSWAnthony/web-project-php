<?php
require_once '../../models/crud_provedor.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Caso 1: Procesar la actualización
    if (isset($_POST['proveedor_id'], $_POST['nombre'], $_POST['contacto'], $_POST['direccion'], $_POST['email'], $_POST['telefono'], $_POST['ruc'])) {
        $id = (int) $_POST['proveedor_id'];
        $nombre = $_POST['nombre'];
        $contacto = $_POST['contacto'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $ruc = $_POST['ruc'];

        $crud = new CRUDProveedor();
        $resultado = $crud->ActualizarProveedor($id, $nombre, $contacto, $direccion, $email, $telefono, $ruc);

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el proveedor.']);
        }
        exit;
    }

    // Caso 2: Mostrar el formulario de edición
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = (int) $_POST['id'];
        $crud = new CRUDProveedor();
        $proveedor = $crud->BuscarProveedorPorId($id); // Llamada a la función BuscarProveedorPorId

        if ($proveedor): ?>
            <div class="modal-header">
                <h5 class="modal-title">Editar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarProveedor">
                    <input type="hidden" name="proveedor_id" value="<?= htmlspecialchars($proveedor->proveedor_id) ?>">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($proveedor->nombre) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="contacto" class="form-label">Contacto</label>
                        <input type="text" class="form-control" id="contacto" name="contacto" value="<?= htmlspecialchars($proveedor->contacto) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <textarea class="form-control" id="direccion" name="direccion" rows="3"><?= htmlspecialchars($proveedor->direccion) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($proveedor->email) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?= htmlspecialchars($proveedor->telefono) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="ruc" class="form-label">RUC</label>
                        <input type="text" class="form-control" id="ruc" name="ruc" value="<?= htmlspecialchars($proveedor->ruc) ?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarCambios">Guardar Cambios</button>
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
    <?php }
}
?>