<?php
require_once '../../models/crud_categoria.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    header('Content-Type: application/json');

    $id = isset($_POST['id']) && is_numeric($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        $crud = new CRUDCategoria();
        $categoria = $crud->BuscarCategoriaId($id);

        if ($categoria) {
            echo json_encode([
                'success' => true,
                'data' => $categoria
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No se encontró la categoría con ese ID.'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'ID inválido o vacío.'
        ]);
    }
    exit;
}
?>

<!-- HTML + Modal -->
<div class="modal-header">
    <h5 class="modal-title">Consultar Categoría</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="formConsultarCategoria">
        <div class="mb-3">
            <label for="id" class="form-label">ID de la Categoría</label>
            <input type="number" class="form-control" id="id" name="id" placeholder="Ingrese el ID de la categoría" required>
        </div>
    </form>
    <div id="resultadosConsulta" class="mt-4"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="btnConsultarCategoria">Consultar</button>
</div>

<script>
$(document).ready(function () {
    // Manejar el clic en el botón "Consultar"
    $('#btnConsultarCategoria').on('click', function () {
        const formData = $('#formConsultarCategoria').serialize(); // Serializar los datos del formulario
        const resultados = $('#resultadosConsulta'); // Contenedor para los resultados

        // Limpiar resultados previos
        resultados.html('');

        // Realizar la solicitud AJAX
        $.ajax({
            type: 'POST',
            url: 'consultar_categoria.php', // Archivo PHP que procesa la consulta
            data: formData + '&ajax=1', // Agregar el indicador de solicitud AJAX
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    const categoria = response.data;

                    // Crear el card con los datos de la categoría
                    const card = `
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title">Categoría ID: ${categoria.categoria_id}</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Nombre:</strong> ${categoria.nombre}</p>
                                <p><strong>Descripción:</strong> ${categoria.descripcion}</p>
                            </div>
                        </div>
                    `;

                    // Mostrar el card en el contenedor
                    resultados.html(card);
                } else {
                    // Mostrar mensaje de error
                    resultados.html(`<div class="alert alert-danger">${response.message}</div>`);
                }
            },
            error: function () {
                // Manejar errores en la solicitud AJAX
                resultados.html('<div class="alert alert-danger">Hubo un error al procesar la solicitud. Por favor, inténtelo de nuevo.</div>');
            }
        });
    });
});
</script>