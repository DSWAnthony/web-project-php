<?php
require_once '../../models/crud_provedor.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Caso 1: Procesar la búsqueda
    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];

        // Instanciar el CRUD y filtrar los proveedores por nombre
        $crud = new CRUDProveedor();
        $proveedores = $crud->FiltrarProveedoresPorNombre($nombre);

        if ($proveedores) {
            echo json_encode(['success' => true, 'data' => $proveedores]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se encontraron proveedores con ese nombre.']);
        }
        exit; // Detener la ejecución para evitar contenido adicional
    } else {
        echo json_encode(['success' => false, 'message' => 'No se proporcionó un nombre para buscar.']);
        exit; // Detener la ejecución
    }
}

// Caso 2: Mostrar el formulario de búsqueda
?>
<div class="modal-header">
    <h5 class="modal-title">Filtrar Proveedores</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="formFiltrarProveedor">
        <div class="mb-3">
            <label for="nombre" class="form-label">Buscar por Nombre o Letra</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese un nombre o letra" required>
        </div>
    </form>
    <div id="resultadosFiltro" class="mt-4">
        <!-- Aquí se mostrarán los resultados de la búsqueda -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Contacto</th>
                    <th>Dirección</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>RUC</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los resultados se cargarán aquí dinámicamente -->
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="btnFiltrarProveedor">Buscar</button>
</div>