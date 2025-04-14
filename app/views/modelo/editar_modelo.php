<?php
require_once '../../models/crud_modelo.php';

// Verifica si se están enviando los datos para actualizar el modelo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modelo_id'], $_POST['nombre'], $_POST['genero'], $_POST['categoria_id'], $_POST['marca_id'])) {
    $modeloId = $_POST['modelo_id'];
    $nombre = $_POST['nombre'];
    $genero = $_POST['genero'];
    $categoriaId = $_POST['categoria_id'];
    $marcaId = $_POST['marca_id'];

    $crudModelo = new CRUDModelo();
    $resultado = $crudModelo->ActualizarModelo($modeloId, $nombre, $genero, $categoriaId, $marcaId);

    if ($resultado) {
        echo json_encode(['success' => true, 'message' => 'Modelo actualizado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el modelo.']);
    }
    exit; // Detener la ejecución del resto del script
}

// Verifica si se recibió un ID por POST para cargar el formulario
if (isset($_POST['id'])) {
    $modeloId = $_POST['id'];

    // Instancia del modelo
    $crudModelo = new CRUDModelo();

    // Obtiene los datos del modelo por ID
    $modelo = $crudModelo->BuscarModeloPorId($modeloId);

    // Verifica si se encontró el modelo
    if ($modelo): ?>
        <form id="formEditarModelo">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $modelo->nombre_modelo ?>" required>
            </div>
            <div class="mb-3">
                <label for="genero" class="form-label">Género</label>
                <select class="form-select" id="genero" name="genero" required>
                    <option value="Femenino" <?= $modelo->genero === 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                    <option value="Masculino" <?= $modelo->genero === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                    <option value="Unisex" <?= $modelo->genero === 'Unisex' ? 'selected' : '' ?>>Unisex</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="categoria_id" class="form-label">Categoría</label>
                <select class="form-select" id="categoria_id" name="categoria_id" required>
                    <?php
                    // Obtiene todas las categorías
                    $categorias = $crudModelo->ObtenerCategorias();
                    foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria->categoria_id ?>" <?= $modelo->categoria_id == $categoria->categoria_id ? 'selected' : '' ?>>
                            <?= $categoria->nombre ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="marca_id" class="form-label">Marca</label>
                <select class="form-select" id="marca_id" name="marca_id" required>
                <?php
$marcas = $crudModelo->ObtenerMarcas();
foreach ($marcas as $marca): ?>
    <option value="<?= $marca->marca_id ?>" <?= $modelo->marca_id == $marca->marca_id ? 'selected' : '' ?>>
        <?= $marca->nombre ?>
    </option>
<?php endforeach; ?>
                    } else {
                        echo '<option value="">No hay marcas disponibles</option>';
                    } ?>
                </select>
            </div>
            <input type="hidden" name="modelo_id" value="<?= $modelo->modelo_id ?>">
            <button type="button" class="btn btn-primary" id="btnGuardarCambiosModelo" data-url="editar_modelo.php">Guardar Cambios</button>
        </form>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            No se encontró el modelo con el ID proporcionado.
        </div>
    <?php endif;
} else { ?>
    <div class="alert alert-danger" role="alert">
        No se proporcionó un ID válido para el modelo.
    </div>
<?php } ?>