<?php
require_once '../../models/crud_zapato.php';

$modeloZapato = new CRUDZapato();

try {
    // Verificar si se recibió una solicitud POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['color']) && !empty($_POST['costo']) && !empty($_POST['porcentaje_ganancia']) && !empty($_POST['sku']) && !empty($_POST['talla']) && !empty($_POST['modelo_id'])) {
            $color = trim($_POST['color']);
            $costo = floatval($_POST['costo']);
            $porcentaje_ganancia = floatval($_POST['porcentaje_ganancia']);
            $sku = trim($_POST['sku']);
            $talla = trim($_POST['talla']);
            $modelo_id = intval($_POST['modelo_id']);

            // Registrar el zapato
            $resultado = $modeloZapato->RegistrarZapato($color, $costo, $porcentaje_ganancia, $sku, $talla, $modelo_id);

            // Respuesta en formato JSON
            echo json_encode([
                'success' => $resultado,
                'message' => $resultado ? 'Zapato registrado correctamente.' : 'Hubo un error al registrar el zapato.'
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

<!-- Modal para Registrar Zapato -->
<div class="modal-header">
    <h5 class="modal-title">Registrar Zapato</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form id="formRegistrarZapato">
    <div class="mb-3">
        <label for="color" class="form-label">Color</label>
        <input type="text" class="form-control" id="color" name="color" required>
    </div>
    <div class="mb-3">
        <label for="costo" class="form-label">Costo</label>
        <input type="number" class="form-control" id="costo" name="costo" step="0.01" required>
    </div>
    <div class="mb-3">
        <label for="porcentaje_ganancia" class="form-label">Porcentaje de Ganancia</label>
        <input type="number" class="form-control" id="porcentaje_ganancia" name="porcentaje_ganancia" step="0.01" required>
    </div>
    <div class="mb-3">
        <label for="sku" class="form-label">SKU</label>
        <input type="text" class="form-control" id="sku" name="sku" required>
    </div>
    <div class="mb-3">
        <label for="talla" class="form-label">Talla</label>
        <input type="text" class="form-control" id="talla" name="talla" required>
    </div>
    <div class="mb-3">
        <label for="modelo_id" class="form-label">Modelo ID</label>
        <input type="number" class="form-control" id="modelo_id" name="modelo_id" required>
    </div>
    <button type="button" class="btn btn-primary" id="btnRegistrarZapato">Registrar</button>
</form>
</div>

<!-- Script para manejar el envío del formulario -->
<script>
    $(document).on('click', '#btnRegistrarZapato', function () {
        const form = $('#formRegistrarZapato'); // Seleccionar el formulario
        const formData = form.serialize(); // Serializar los datos del formulario

        // Realizar el envío del formulario mediante AJAX
        $.ajax({
            url: 'registrar_zapato.php', // Archivo PHP que procesa el registro
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    alert(response.message); // Mostrar mensaje de éxito
                    $('#mainModal').modal('hide'); // Cerrar el modal
                    form[0].reset(); // Limpiar el formulario
                    location.reload(); // Recargar la página para mostrar el nuevo zapato
                } else {
                    alert(response.message); // Mostrar mensaje de error
                }
            },
            error: function () {
                alert('Hubo un error al registrar el zapato.');
            }
        });
    });
</script>