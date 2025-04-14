<?php
require_once '../../models/crud_zapato.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibió un ID
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $zapato_id = $_POST['id'];

        // Instancia del modelo
        $modeloZapato = new CRUDZapato();

        // Obtener los datos del zapato por ID
        $zapato = $modeloZapato->BuscarZapatoPorId($zapato_id);

        // Verificar si se encontró el zapato
        if ($zapato) {
            // Respuesta en formato JSON con los datos del zapato
            echo json_encode(['success' => true, 'data' => $zapato]);
        } else {
            // Respuesta en caso de que no se encuentre el zapato
            echo json_encode(['success' => false, 'message' => 'No se encontró el zapato con el ID proporcionado.']);
        }
    } else {
        // Respuesta en caso de que no se proporcione un ID
        echo json_encode(['success' => false, 'message' => 'No se proporcionó un ID válido.']);
    }
    exit;
}
?>

<!-- Modal para ingresar el ID del zapato -->
<div class="modal-header">
    <h5 class="modal-title">Consultar Zapato</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
</div>
<div class="modal-body">
    <form id="formConsultarZapato">
        <div class="mb-3">
            <label for="id" class="form-label">ID del Zapato</label>
            <input type="number" class="form-control" id="id" name="id" placeholder="Ingrese el ID del zapato" required>
        </div>
    </form>
    <div id="resultadosConsulta" class="mt-4">
        <!-- Aquí se mostrará el card con la información del zapato -->
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="btnConsultarZapato">Consultar</button>
</div>