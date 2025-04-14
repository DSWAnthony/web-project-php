<?php
require_once '../../models/crud_categoria.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];

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
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="tablaResultados">
                <!-- Resultados dinámicos -->
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
    $('#btnFiltrarCategoria').on('click', function () {
        const formData = $('#formFiltrarCategoria').serialize();

        $.ajax({
            type: 'POST',
            url: 'filtrar_categoria.php',
            data: formData,
            dataType: 'json',
            success: function (response) {
                const tabla = $('#tablaResultados');
                tabla.empty();

                if (response.success) {
                    response.data.forEach(function (categoria) {
                        const fila = `
                            <tr>
                                <td>${categoria.id_categoria}</td>
                                <td>${categoria.nombre_categoria}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="mostrarDescripcion('${categoria.descripcion_categoria.replace(/'/g, "\\'")}')">Info</button>
                                </td>
                            </tr>
                        `;
                        tabla.append(fila);
                    });
                } else {
                    tabla.html(`<tr><td colspan="3" class="text-center">${response.message}</td></tr>`);
                }
            },
            error: function () {
                $('#tablaResultados').html('<tr><td colspan="3" class="text-center text-danger">Error al procesar la solicitud.</td></tr>');
            }
        });
    });
});

// Función para mostrar la descripción
function mostrarDescripcion(descripcion) {
    const contenido = `<div class="alert alert-info"><strong>Descripción:</strong> ${descripcion}</div>`;
    const modal = `
        <div class="modal fade" id="modalDescripcion" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Descripción de Categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">${contenido}</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Eliminar modal anterior si existe
    $('#modalDescripcion').remove();
    $('body').append(modal);
    const nuevoModal = new bootstrap.Modal(document.getElementById('modalDescripcion'));
    nuevoModal.show();
}
</script>
