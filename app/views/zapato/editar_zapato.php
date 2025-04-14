<?php
require_once '../../models/crud_zapato.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Actualizar zapato
    if (isset($_POST['zapato_id'], $_POST['color'], $_POST['costo'], $_POST['porcentaje_ganancia'], $_POST['sku'], $_POST['talla'], $_POST['modelo_id'])) {
        $id = (int) $_POST['zapato_id'];
        $color = trim($_POST['color']);
        $costo = floatval($_POST['costo']);
        $porcentaje_ganancia = floatval($_POST['porcentaje_ganancia']);
        $sku = trim($_POST['sku']);
        $talla = trim($_POST['talla']);
        $modelo_id = (int) $_POST['modelo_id'];

        // Instanciar el CRUD
        $crud = new CRUDZapato();
        $resultado = $crud->ActualizarZapato($id, $color, $costo, $porcentaje_ganancia, $sku, $talla, $modelo_id);

        // Respuesta en formato JSON
        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Zapato actualizado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el zapato.']);
        }
        exit;
    }

    // Mostrar formulario para editar
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = (int) $_POST['id'];
        $crud = new CRUDZapato();
        $zapato = $crud->BuscarZapatoPorId($id);

        // Obtener la lista de modelos
        $modelos = $crud->ListarModelos(); // Método que devuelve todos los modelos

        if ($zapato): ?>
            <div class="modal-header">
                <h5 class="modal-title">Editar Zapato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarZapato">
                    <input type="hidden" name="zapato_id" value="<?= htmlspecialchars($zapato->zapato_id) ?>">

                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control" id="color" name="color" value="<?= htmlspecialchars($zapato->color) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="costo" class="form-label">Costo</label>
                        <input type="number" step="0.01" class="form-control" id="costo" name="costo" value="<?= htmlspecialchars($zapato->costo) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="porcentaje_ganancia" class="form-label">Porcentaje de Ganancia</label>
                        <input type="number" step="0.01" class="form-control" id="porcentaje_ganancia" name="porcentaje_ganancia" value="<?= htmlspecialchars($zapato->porcentaje_ganancia) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" class="form-control" id="sku" name="sku" value="<?= htmlspecialchars($zapato->sku) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="talla" class="form-label">Talla</label>
                        <input type="text" class="form-control" id="talla" name="talla" value="<?= htmlspecialchars($zapato->talla) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="modelo_id" class="form-label">Modelo</label>
                        <select class="form-control" id="modelo_id" name="modelo_id" required>
                        <?php if (!empty($modelos)): ?>
    <?php foreach ($modelos as $modelo): ?>
        <option value="<?= htmlspecialchars($modelo->modelo_id) ?>" <?= $modelo->modelo_id == $zapato->modelo_id ? 'selected' : '' ?>>
            <?= htmlspecialchars($modelo->nombre) ?>
        </option>
    <?php endforeach; ?>
<?php else: ?>
    <option value="">No hay modelos disponibles</option>
<?php endif; ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarCambiosZapato">Guardar Cambios</button>
            </div>
        <?php else: ?>
            <div class="modal-body">
                <p>No se encontró información para este zapato.</p>
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