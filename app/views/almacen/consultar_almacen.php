<?php
require_once '../../models/crud_almacen.php';

$crudAlmacen = new CRUDAlmacen();

try {
    // Verificar si se recibió una solicitud POST para consultar la ubicación
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['id'])) {
            $id = intval($_POST['id']);

            // Buscar la ubicación por ID
            $ubicacion = $crudAlmacen->BuscarUbicacionPorId($id);

            if ($ubicacion) {
                // Respuesta en formato JSON con los datos de la ubicación
                echo json_encode([
                    'success' => true,
                    'data' => $ubicacion
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'No se encontró la ubicación con el ID proporcionado.'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'El campo ID es obligatorio.'
            ]);
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

<!-- Modal para Consultar Ubicación -->
<div class="modal-header">
    <h5 class="modal-title">Consultar Ubicación</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="formConsultarUbicacion">
        <div class="mb-3">
            <label for="id" class="form-label">ID de la Ubicación</label>
            <input type="number" class="form-control" id="id" name="id" required>
        </div>
        <button type="button" class="btn btn-primary" id="btnConsultarUbicacion">Consultar</button>
    </form>
    <div id="resultadosConsulta" class="mt-4"></div>
</div>

<!-- Script para manejar la consulta -->
<script>
    $(document).on('click', '#btnConsultarUbicacion', function () {
        const form = $('#formConsultarUbicacion'); // Seleccionar el formulario
        const formData = form.serialize(); // Serializar los datos del formulario
        const resultados = $('#resultadosConsulta'); // Contenedor para los resultados

        // Limpiar resultados previos
        resultados.html('<p>Cargando...</p>');

        // Realizar la solicitud AJAX
        $.ajax({
            url: 'consultar_almacen.php', // Archivo PHP que procesa la consulta
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    const ubicacion = response.data;

                    // Mostrar los detalles de la ubicación
                    resultados.html(`
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title">Detalles de la Ubicación</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>ID:</strong> ${ubicacion.ubicacion_id}</p>
                                <p><strong>Contenedor:</strong> ${ubicacion.contenedor}</p>
                                <p><strong>Estante:</strong> ${ubicacion.estante}</p>
                                <p><strong>Pasillo:</strong> ${ubicacion.pasillo}</p>
                            </div>
                        </div>
                    `);
                } else {
                    // Mostrar mensaje de error
                    resultados.html(`<div class="alert alert-danger">${response.message}</div>`);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error en la solicitud AJAX:', status, error);
                console.error('Respuesta del servidor:', xhr.responseText);
                resultados.html('<div class="alert alert-danger">Hubo un error al consultar la ubicación. Por favor, inténtelo de nuevo.</div>');
            }
        });
    });
</script>