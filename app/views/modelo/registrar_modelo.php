<?php
require_once '../../models/crud_modelo.php'; // Asegúrate de que la ruta sea correcta

// Instanciar el CRUDModelo para obtener los datos de categorías y marcas
$crud = new CRUDModelo();
$categorias = $crud->ObtenerCategorias();
$marcas = $crud->ObtenerMarcas();

// Manejo de la solicitud POST para registrar un modelo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nombre'], $_POST['genero'], $_POST['categoria_id'], $_POST['marca_id'])) {
        $nombre = $_POST['nombre'];
        $genero = $_POST['genero'];
        $categoria_id = $_POST['categoria_id'];
        $marca_id = $_POST['marca_id'];

        $resultado = $crud->RegistrarModelo($nombre, $genero, $categoria_id, $marca_id);

        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Modelo registrado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar el modelo.']);
        }
        exit; // Detener la ejecución para evitar contenido adicional
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
        exit; // Detener la ejecución
    }
}
?>

<!-- Formulario para registrar un nuevo modelo -->
<div class="modal-header">
    <h5 class="modal-title">Registrar Nuevo Modelo</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="formRegistrarModelo">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <select class="form-select" id="genero" name="genero" required>
                <option value="">Seleccione un género</option>
                <option value="Femenino">Femenino</option>
                <option value="Masculino">Masculino</option>
                <option value="Unisex">Unisex</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría</label>
            <select class="form-select" id="categoria_id" name="categoria_id" required>
                <option value="">Seleccione una categoría</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria->categoria_id ?>"><?= $categoria->nombre ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="marca_id" class="form-label">Marca</label>
            <select class="form-select" id="marca_id" name="marca_id" required>
                <option value="">Seleccione una marca</option>
                <?php foreach ($marcas as $marca): ?>
                    <option value="<?= $marca->marca_id ?>"><?= $marca->nombre ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="button" class="btn btn-primary" id="btnRegistrarModelo" data-url="registrar_modelo.php">Registrar</button>
</div>