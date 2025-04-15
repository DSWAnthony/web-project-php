<?php
require_once '../../models/crud_almacen.php';

$crudAlmacen = new CRUDAlmacen();

try {
    // Verificar si se recibió una solicitud POST para actualizar la ubicación
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        error_log('Datos recibidos: ' . print_r($_POST, true)); // Registrar los datos recibidos
    
        if (!empty($_POST['id']) && !empty($_POST['contenedor']) && !empty($_POST['estante']) && !empty($_POST['pasillo'])) {
            $id = intval($_POST['id']);
            $contenedor = trim($_POST['contenedor']);
            $estante = trim($_POST['estante']);
            $pasillo = trim($_POST['pasillo']);
    
            // Actualizar la ubicación
            $resultado = $crudAlmacen->ActualizarUbicacion($id, $contenedor, $estante, $pasillo);
    
            // Respuesta en formato JSON
            echo json_encode([
                'success' => $resultado,
                'message' => $resultado ? 'Ubicación actualizada correctamente.' : 'Hubo un error al actualizar la ubicación.'
            ]);
            exit;
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Todos los campos son obligatorios.'
            ]);
            exit;
        }
    }

    // Verificar si se recibió una solicitud GET para cargar los datos de la ubicación
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['id'])) {
        $id = intval($_GET['id']);
        $ubicacion = $crudAlmacen->BuscarUbicacionPorId($id);

        if ($ubicacion) {
            // Mostrar el formulario con los datos de la ubicación
            ?>
            <div class="modal-header">
                <h5 class="modal-title">Editar Ubicación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarUbicacion">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($ubicacion->ubicacion_id) ?>">
                    <div class="mb-3">
                        <label for="contenedor" class="form-label">Contenedor</label>
                        <input type="text" class="form-control" id="contenedor" name="contenedor" value="<?= htmlspecialchars($ubicacion->contenedor) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="estante" class="form-label">Estante</label>
                        <input type="text" class="form-control" id="estante" name="estante" value="<?= htmlspecialchars($ubicacion->estante) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="pasillo" class="form-label">Pasillo</label>
                        <input type="text" class="form-control" id="pasillo" name="pasillo" value="<?= htmlspecialchars($ubicacion->pasillo) ?>" required>
                    </div>
                    <button type="button" class="btn btn-primary" id="btnGuardarCambiosUbicacion">Guardar Cambios</button>
                </form>
            </div>
            <?php
        } else {
            echo '<p>No se encontró la ubicación.</p>';
        }
        exit;
    }
} catch (Exception $e) {
    // Capturar cualquier excepción y devolver un mensaje de error
    echo json_encode([
        'success' => false,
        'message' => 'Error en el servidor: ' . $e->getMessage()
    ]);
    exit;
}
?>