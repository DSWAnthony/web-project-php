<?php
require_once '../../models/crud_zapato.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Actualizar zapato
    if (isset($_POST['zapato_id'], $_POST['color'], $_POST['precio_comercial'], $_POST['sku'], $_POST['talla'])) {
        $id = (int) $_POST['zapato_id'];
        $color = $_POST['color'];
        $precio_comercial = $_POST['precio_comercial'];
        $sku = $_POST['sku'];
        $talla = $_POST['talla'];
        $modelo_id = 2; // Modelo fijo (Referencia a la tabla modelo)

        // Validación de modelo_id (si fuera necesario, pero en este caso se mantiene fijo)
        // En este caso, dado que se asigna un modelo fijo (modelo_id = 2), no hace falta verificar su existencia
        // Si quieres verificar que el modelo existe, podrías hacer una consulta a la tabla 'modelo' para asegurarte.
        // $crud = new CRUDModelo();
        // if (!$crud->existeModelo($modelo_id)) {
        //     echo json_encode(['success' => false, 'message' => 'Modelo no válido.']);
        //     exit;
        // }

        // Instanciar el CRUD
        $crud = new CRUDZapato();
        $resultado = $crud->ActualizarZapato($id, $color, $precio_comercial, $sku, $talla, $modelo_id);

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
                        <label for="precio_comercial" class="form-label">Precio Comercial</label>
                        <input type="number" step="0.01" class="form-control" id="precio_comercial" name="precio_comercial" value="<?= htmlspecialchars($zapato->precio_comercial) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" class="form-control" id="sku" name="sku" value="<?= htmlspecialchars($zapato->sku) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="talla" class="form-label">Talla</label>
                        <input type="number" step="0.1" class="form-control" id="talla" name="talla" value="<?= htmlspecialchars($zapato->talla) ?>" required>
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
