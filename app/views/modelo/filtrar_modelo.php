<?php
require_once '../../models/crud_modelo.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se recibió el parámetro 'nombre'
    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];

        // Instanciar el CRUD y filtrar los modelos por nombre
        $crud = new CRUDModelo();
        $modelos = $crud->FiltrarModelosPorNombre($nombre);

        if ($modelos) {
            // Devuelve los resultados como una lista HTML
            foreach ($modelos as $modelo) {
                echo "<p><strong>ID:</strong> {$modelo->modelo_id} - <strong>Nombre:</strong> {$modelo->nombre}</p>";
            }
        } else {
            echo "<p>No se encontraron modelos con el nombre proporcionado.</p>";
        }
        exit; // Detener la ejecución para evitar contenido adicional
    } else {
        echo "<p>No se proporcionó un nombre para filtrar.</p>";
        exit; // Detener la ejecución
    }
}
?>

<!-- Formulario para filtrar modelos -->
<div class="modal-header">
    <h5 class="modal-title">Filtrar Modelos</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="formFiltrarModelo">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Modelo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del modelo" required>
        </div>
    </form>
    <div id="resultadosFiltro" class="mt-4">
        <!-- Aquí se mostrarán los resultados del filtro -->
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="btnFiltrarModelo">Filtrar</button>
</div>