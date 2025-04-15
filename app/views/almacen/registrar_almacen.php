
<?php
require_once '../../models/crud_almacen.php'; // Asegúrate de incluir el modelo

$crudAlmacen = new CRUDAlmacen(); // Crear la instancia de la clase

try {
    // Verificar si se recibió una solicitud POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['contenedor']) && !empty($_POST['estante']) && !empty($_POST['pasillo'])) {
            $contenedor = trim($_POST['contenedor']);
            $estante = trim($_POST['estante']);
            $pasillo = trim($_POST['pasillo']);

            // Registrar la ubicación
            $resultado = $crudAlmacen->CrearUbicacion($contenedor, $estante, $pasillo);

            // Respuesta en formato JSON
            echo json_encode([
                'success' => $resultado,
                'message' => $resultado ? 'Ubicación registrada correctamente.' : 'La ubicación ya existe.'
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
} catch (Exception $e) {
    // Capturar cualquier excepción y devolver un mensaje de error
    echo json_encode([
        'success' => false,
        'message' => 'Error en el servidor: ' . $e->getMessage()
    ]);
    exit;
}
?>

<!-- Modal para Registrar Ubicación -->
<div class="modal-header">
    <h5 class="modal-title">Registrar Ubicación</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="formRegistrarUbicacion">
        <div class="mb-3">
            <label for="contenedor" class="form-label">Contenedor</label>
            <input type="text" class="form-control" id="contenedor" name="contenedor" required>
        </div>
        <div class="mb-3">
            <label for="estante" class="form-label">Estante</label>
            <input type="text" class="form-control" id="estante" name="estante" required>
        </div>
        <div class="mb-3">
            <label for="pasillo" class="form-label">Pasillo</label>
            <input type="text" class="form-control" id="pasillo" name="pasillo" required>
        </div>
        <button type="button" class="btn btn-primary" id="btnRegistrarUbicacion">Registrar</button>
    </form>
</div>

<!-- Script para manejar el envío del formulario -->
<script>
    $(document).on('click', '#btnRegistrarUbicacion', function () {
        const form = $('#formRegistrarUbicacion'); // Seleccionar el formulario
        const formData = form.serialize(); // Serializar los datos del formulario

        // Realizar el envío del formulario mediante AJAX
        $.ajax({
            url: 'registrar_almacen.php', // Archivo PHP que procesa el registro
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    alert(response.message); // Mostrar mensaje de éxito
                    $('#mainModal').modal('hide'); // Cerrar el modal
                    form[0].reset(); // Limpiar el formulario
                    location.reload(); // Recargar la página para mostrar la nueva ubicación
                } else {
                    alert(response.message); // Mostrar mensaje de error
                }
            },
            error: function () {
                alert('Hubo un error al registrar la ubicación.');
            }
        });
    });
</script>