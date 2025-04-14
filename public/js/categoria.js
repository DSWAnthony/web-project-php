$(document).ready(function () {
    // Función genérica para cargar modales
    function cargarModal(url, data = {}) {
        console.log('Cargando modal desde:', url, 'con datos:', data);
        $('#modalContent').html('<p class="text-center">Cargando...</p>');
        $('#mainModal').modal('show');

        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (response) {
                $('#modalContent').html(response);
            },
            error: function (xhr) {
                console.error('Error:', xhr.status, xhr.statusText);
                $('#modalContent').html('<div class="alert alert-danger text-center">Error al cargar el contenido.</div>');
            }
        });
    }

    // Abrir modal para registrar, consultar, editar
    $(document).on('click', '.btn-registrar-categoria, .btn-consultar-categoria, .btn-editar-categoria', function () {
        const url = $(this).data('url');
        const id = $(this).data('id');
        const data = id ? { id } : {};
        cargarModal(url, data);
    });

    // Mostrar confirmación para eliminar
    $(document).on('click', '.btn-eliminar-categoria', function () {
        const id = $(this).data('id');
        const url = $(this).data('url');

        const contenido = `
            <div class="text-center">
                <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                <h4 class="mt-3">¿Estás seguro?</h4>
                <p>Eliminarás la categoría con ID: <strong>${id}</strong>.</p>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button class="btn btn-danger btn-confirmar-eliminar-categoria me-2" data-id="${id}" data-url="${url}">
                    <i class="fas fa-trash-alt"></i> Eliminar
                </button>
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Cancelar
                </button>
            </div>
        `;
        $('#modalContent').html(contenido);
        $('#mainModal').modal('show');
    });

    // Confirmar eliminación
    $(document).on('click', '.btn-confirmar-eliminar-categoria', function () {
        const id = $(this).data('id');
        const url = $(this).data('url');

        $.post(url, { id }, function (response) {
            try {
                const res = JSON.parse(response);
                if (res.success) {
                    $('#modalContent').html(`<div class="alert alert-success">${res.message}</div>`);
                    setTimeout(() => location.reload(), 1000);
                } else {
                    $('#modalContent').html(`<div class="alert alert-danger">${res.message}</div>`);
                }
            } catch (e) {
                $('#modalContent').html('<div class="alert alert-danger">Error inesperado del servidor.</div>');
            }
        }).fail(() => {
            $('#modalContent').html('<div class="alert alert-danger">Error al eliminar la categoría.</div>');
        });
    });

    // Filtrar categoría
    $(document).on('click', '#btnFiltrarCategoria', function () {
        const formData = $('#formFiltrarCategoria').serialize();

        $.ajax({
            type: 'POST',
            url: 'views/categoria/filtrar_categoria.php',
            data: formData,
            dataType: 'json',
            success: function (response) {
                const tabla = $('#tablaResultados');
                tabla.empty();

                if (response.success && response.data.length > 0) {
                    response.data.forEach(categoria => {
                        const fila = `
                            <tr>
                                <td>${categoria.id_categoria}</td>
                                <td>${categoria.nombre_categoria}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="mostrarDescripcion('${categoria.descripcion_categoria.replace(/'/g, "\\'")}')">Info</button>
                                </td>
                            </tr>`;
                        tabla.append(fila);
                    });
                } else {
                    tabla.html(`<tr><td colspan="3" class="text-center">${response.message}</td></tr>`);
                }
            },
            error: function () {
                $('#tablaResultados').html('<tr><td colspan="3" class="text-danger text-center">Error al procesar la solicitud.</td></tr>');
            }
        });
    });

    // ✅ CONSULTAR CATEGORÍA - Ruta corregida
    $(document).on('click', '#btnConsultarCategoria', function () {
        const formData = $('#formConsultarCategoria').serialize();
        const url = 'views/categoria/consultar_categoria.php'; // <- Ruta corregida
    
        $.post(url, formData, function (response) {
            try {
                const res = JSON.parse(response);
                if (res.success) {
                    const categoria = res.data;
                    let html = `
                        <table class="table table-bordered">
                            <tr><th>ID</th><td>${categoria.id_categoria}</td></tr>
                            <tr><th>Nombre</th><td>${categoria.nombre_categoria}</td></tr>
                            <tr><th>Descripción</th><td>${categoria.descripcion_categoria || 'No especificada'}</td></tr>
                        </table>
                    `;
                    $('#resultadosConsulta').html(html);
                } else {
                    $('#resultadosConsulta').html(`<div class="alert alert-warning">${res.message}</div>`);
                }
            } catch (e) {
                $('#resultadosConsulta').html('<div class="alert alert-danger">Error inesperado del servidor.</div>');
            }
        }).fail(function () {
            $('#resultadosConsulta').html('<div class="alert alert-danger">Error al intentar consultar la categoría.</div>');
        });
    });
});

// Mostrar descripción en modal separado
function mostrarDescripcion(descripcion) {
    const modalHtml = `
        <div class="modal fade" id="modalDescripcion" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Descripción de Categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <strong>Descripción:</strong> ${descripcion}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    $('#modalDescripcion').remove(); // eliminar modal anterior si existe
    $('body').append(modalHtml);
    new bootstrap.Modal(document.getElementById('modalDescripcion')).show();
}
