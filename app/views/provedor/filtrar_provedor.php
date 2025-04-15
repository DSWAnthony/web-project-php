<?php
require_once '../../models/crud_provedor.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Caso 1: Procesar la búsqueda
    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];

       
        $crud = new CRUDProveedor();
        $proveedores = $crud->FiltrarProveedoresPorNombre($nombre);

        if ($proveedores) {
            echo json_encode(['success' => true, 'data' => $proveedores]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se encontraron proveedores con ese nombre.']);
        }
        exit; 
    } else {
        echo json_encode(['success' => false, 'message' => 'No se proporcionó un nombre para buscar.']);
        exit; 
    }
}


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
           
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="btnFiltrarProveedor">Buscar</button>
</div>