<?php
require_once '../../models/crud_zapato.php';

$modeloZapato = new CRUDZapato();

// El modelo está fijado, por ejemplo, a "2" (Reebok Classic)
$modelo_id = 2;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['color']) && !empty($_POST['precio_comercial']) && !empty($_POST['sku']) && !empty($_POST['talla'])) {
        $color = trim($_POST['color']);
        $precio_comercial = floatval($_POST['precio_comercial']);
        $sku = trim($_POST['sku']);
        $talla = trim($_POST['talla']);

        // El modelo_id ya está fijado aquí, no se recibe desde el formulario
        $resultado = $modeloZapato->RegistrarZapato($color, $precio_comercial, $sku, $talla, $modelo_id);

        // Respuesta en formato JSON
        echo json_encode([
            'success' => $resultado,
            'message' => $resultado ? 'Zapato registrado correctamente.' : 'Hubo un error al registrar el zapato.'
        ]);
    }
}
?>

<!-- Modal para Registrar Zapato -->
<div class="modal fade" id="mainModal" tabindex="-1" aria-labelledby="mainModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modalContent">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Zapato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formRegistrarZapato" method="POST">
                    <!-- Los campos del formulario van aquí -->
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control" id="color" name="color" required>
                    </div>
                    <div class="mb-3">
                        <label for="precio_comercial" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precio_comercial" name="precio_comercial" required>
                    </div>
                    <div class="mb-3">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" class="form-control" id="sku" name="sku" required>
                    </div>
                    <div class="mb-3">
                        <label for="talla" class="form-label">Talla</label>
                        <input type="text" class="form-control" id="talla" name="talla" required>
                    </div>

                    <button type="button" class="btn btn-primary" id="btnRegistrarZapato">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (para AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script para manejar el envío del formulario con AJAX -->
<script>
    $(document).on('click', '#btnRegistrarZapato', function() {
        const form = $('#formRegistrarZapato');
        const formData = form.serialize(); // Serializar el formulario para enviarlo

        // Realizar el envío del formulario mediante AJAX
        $.ajax({
            url: window.location.href,  // Usamos la URL actual del archivo PHP
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message); // Mostrar mensaje de éxito
                    $('#mainModal').modal('hide'); // Cerrar el modal
                    form[0].reset(); // Resetear el formulario
                } else {
                    alert(response.message); // Mostrar mensaje de error
                }
            },
            error: function() {
                alert('Hubo un error al registrar el zapato.');
            }
        });
    });
</script>

</body>
</html>
