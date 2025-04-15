<?php
require_once '../../models/crud_categoria.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nombre'])) {
        $nombre = trim($_POST['nombre']); // Limpiar el nombre recibido

        $crud = new CRUDCategoria();
        $categorias = $crud->FiltrarCategoriasPorNombre($nombre);

        if ($categorias) {
            echo json_encode(['success' => true, 'data' => $categorias]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se encontraron categorías con ese nombre.']);
        }
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'No se proporcionó un nombre para buscar.']);
        exit;
    }
}
?>

<!-- Modal HTML para Filtrar Categorías -->
<div class="modal-header">
    <h5 class="modal-title">Filtrar Categorías</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="formFiltrarCategoria">
        <div class="mb-3">
            <label for="nombre" class="form-label">Buscar por Nombre o Letra</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese un nombre o letra" required>
        </div>
    </form>
    <div id="resultadosFiltro" class="mt-4">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody id="tablaResultados">
                <!-- Los resultados se cargarán aquí dinámicamente -->
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="btnFiltrarCategoria">Buscar</button>
</div>

<script>
$(document).ready(function () {
    // Manejar el clic en el botón "Buscar"
    $('#btnFiltrarCategoria').on('click', function () {
        const formData = $('#formFiltrarCategoria').serialize(); // Serializar los datos del formulario

        // Realizar la solicitud AJAX
        $.ajax({
            type: 'POST',
            url: 'filtrar_categoria.php', // Archivo PHP que procesa la búsqueda
            data: formData,
            dataType: 'json',
            success: function (response) {
                const tabla = $('#tablaResultados');
                tabla.empty(); // Limpiar resultados previos

                if (response.success) {
                    // Si se encontraron categorías, mostrarlas en la tabla
                    response.data.forEach(function (categoria) {
                        const fila = `
                            <tr>
                                <td>${categoria.nombre}</td>
                                <td>${categoria.descripcion}</td>
                            </tr>
                        `;
                        tabla.append(fila);
                    });
                } else {
                    // Si no se encontraron categorías, mostrar un mensaje
                    tabla.html(`<tr><td colspan="2" class="text-center">${response.message}</td></tr>`);
                }
            },
            error: function () {
                // Manejar errores en la solicitud AJAX
                $('#tablaResultados').html('<tr><td colspan="2" class="text-center text-danger">Error al procesar la solicitud.</td></tr>');
            }
        });
    });
});
</script>