<?php
require_once '../../models/crud_almacen.php';

$crudAlmacen = new CRUDAlmacen();

try {
    // Verificar si se recibió una solicitud POST para filtrar ubicaciones
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['contenedor'])) {
            $contenedor = trim($_POST['contenedor']);

            // Filtrar ubicaciones por contenedor
            $ubicaciones = $crudAlmacen->FiltrarUbicacionesPorContenedor($contenedor);

            if (!empty($ubicaciones)) {
                // Respuesta en formato JSON con los datos de las ubicaciones
                echo json_encode([
                    'success' => true,
                    'data' => $ubicaciones
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'No se encontraron ubicaciones que coincidan con el término de búsqueda.'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'El campo Contenedor es obligatorio.'
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

<!-- Modal para Filtrar Ubicaciones -->
<div class="modal-header">
    <h5 class="modal-title">Filtrar Ubicaciones</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="formFiltrarUbicaciones">
        <div class="mb-3">
            <label for="contenedor" class="form-label">Contenedor</label>
            <input type="text" class="form-control" id="contenedor" name="contenedor" placeholder="Ingrese el nombre del contenedor" required>
        </div>
        <button type="button" class="btn btn-primary" id="btnFiltrarUbicaciones">Filtrar</button>
    </form>
    <div id="resultadosFiltro" class="mt-4"></div>
</div>

<!-- Script para manejar el filtrado -->
<script>
    $(document).on('click', '#btnFiltrarUbicaciones', function () {
        const form = $('#formFiltrarUbicaciones'); // Seleccionar el formulario
        const formData = form.serialize(); // Serializar los datos del formulario
        const resultados = $('#resultadosFiltro'); // Contenedor para los resultados

        // Limpiar resultados previos
        resultados.html('<p>Cargando resultados...</p>');

        // Realizar la solicitud AJAX
        $.ajax({
            url: 'filtrar_almacen.php', // Archivo PHP que procesa el filtrado
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    const ubicaciones = response.data;

                    // Crear la tabla de resultados
                    let tabla = `
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Contenedor</th>
                                    <th>Estante</th>
                                    <th>Pasillo</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;

                    ubicaciones.forEach(ubicacion => {
                        tabla += `
                            <tr>
                                <td>${ubicacion.ubicacion_id}</td>
                                <td>${ubicacion.contenedor}</td>
                                <td>${ubicacion.estante}</td>
                                <td>${ubicacion.pasillo}</td>
                            </tr>
                        `;
                    });

                    tabla += `
                            </tbody>
                        </table>
                    `;

                    // Mostrar la tabla en el contenedor
                    resultados.html(tabla);
                } else {
                    // Mostrar mensaje de error
                    resultados.html(`<div class="alert alert-danger">${response.message}</div>`);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error en la solicitud AJAX:', status, error);
                console.error('Respuesta del servidor:', xhr.responseText);
                resultados.html('<div class="alert alert-danger">Hubo un error al filtrar las ubicaciones. Por favor, inténtelo de nuevo.</div>');
            }
        });
    });
</script>