$(document).ready(function () {
    // Quitar el foco de todos los botones al cargar la página
    $('button').blur();

    // Mostrar formularios en modal (registrar, editar)
    $(document).on('click', '.btn-registrar, .btn-editar', function () {
        const url = $(this).data('url');
        const id = $(this).data('id') || null;

        $('#mainModal').modal('show');
        $('#modalContent').html('<p>Cargando contenido...</p>');

        $.post(url, { id }, function (data) {
            $('#modalContent').html(data);
        }).fail(function () {
            $('#modalContent').html('<p>Error al cargar el contenido.</p>');
        });
    });

    // Función genérica para enviar formularios
    function enviarFormulario(formSelector, url, mensajeExito = 'Operación realizada correctamente.') {
        const formData = $(formSelector).serialize();

        $.post(url, formData, function (response) {
            try {
                const res = JSON.parse(response);
                if (res.success) {
                    $('#mainModal').modal('hide');
                    location.reload();
                } else {
                    alert(res.message || 'Ocurrió un error.');
                }
            } catch (e) {
                alert('Respuesta del servidor no válida.');
            }
        }).fail(function () {
            alert('Error al procesar la solicitud.');
        });
    }

    // Registrar entidad
    $(document).on('click', '[id^="btnRegistrar"]', function () {
        const entidad = this.id.replace('btnRegistrar', '');
        enviarFormulario(`#formRegistrar${entidad}`, `registrar_${entidad.toLowerCase()}.php`);
    });

    // Guardar cambios (editar)
    $(document).on('click', '[id^="btnGuardarCambios"]', function () {
        const entidad = this.id.replace('btnGuardarCambios', '');
        enviarFormulario(`#formEditar${entidad}`, `editar_${entidad.toLowerCase()}.php`);
    });

    // Consultar entidad
    $(document).on('click', '[id^="btnConsultar"]', function () {
        const entidad = this.id.replace('btnConsultar', '');
        const formData = $(`#formConsultar${entidad}`).serialize();

        $.post(`consultar_${entidad.toLowerCase()}.php`, formData, function (response) {
            try {
                const res = JSON.parse(response);
                if (res.success) {
                    let html = '<table class="table table-striped table-bordered">';
                    for (const [clave, valor] of Object.entries(res.data)) {
                        html += `<tr><th>${clave}</th><td>${valor ?? '(sin datos)'}</td></tr>`;
                    }
                    html += '</table>';
                    $('#resultadosConsulta').html(html);
                } else {
                    $('#resultadosConsulta').html(`<div class="alert alert-danger">${res.message}</div>`);
                }
            } catch (e) {
                $('#resultadosConsulta').html('<div class="alert alert-danger">Error en el servidor.</div>');
            }
        }).fail(function () {
            $('#resultadosConsulta').html('<div class="alert alert-danger">No se pudo procesar la consulta.</div>');
        });
    });

    // Filtrar entidad
    $(document).on('click', '[id^="btnFiltrar"]', function () {
        const entidad = this.id.replace('btnFiltrar', '');
        const formData = $(`#formFiltrar${entidad}`).serialize();

        $.post(`filtrar_${entidad.toLowerCase()}.php`, formData, function (response) {
            try {
                const res = JSON.parse(response);
                if (res.success) {
                    let html = '<table class="table table-striped"><thead><tr>';
                    if (res.data.length > 0) {
                        const columnas = Object.keys(res.data[0]);
                        columnas.forEach(col => html += `<th>${col}</th>`);
                        html += '</tr></thead><tbody>';
                        res.data.forEach(row => {
                            html += '<tr>';
                            columnas.forEach(col => {
                                html += `<td>${row[col]}</td>`;
                            });
                            html += '</tr>';
                        });
                        html += '</tbody></table>';
                    } else {
                        html = '<p>No se encontraron resultados.</p>';
                    }
                    $('#resultadosFiltro').html(html);
                } else {
                    $('#resultadosFiltro').html(`<p>${res.message}</p>`);
                }
            } catch (e) {
                $('#resultadosFiltro').html('<p>Error inesperado del servidor.</p>');
            }
        }).fail(function () {
            $('#resultadosFiltro').html('<p>Error al procesar el filtro.</p>');
        });
    });

    // Confirmar eliminación
    $(document).on('click', '.btn-eliminar', function () {
        const id = $(this).data('id');
        const url = $(this).data('url');

        $('#mainModal').modal('show');
        $('#modalContent').html(`
            <div class="text-center">
                <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                <h4 class="mt-3">¿Estás seguro?</h4>
                <p>Se eliminará el registro con ID: <strong>${id}</strong>.</p>
                <div class="d-flex justify-content-center mt-4">
                    <button class="btn btn-danger btn-confirmar-eliminar me-2" data-id="${id}" data-url="${url}">
                        <i class="fas fa-trash-alt"></i> Eliminar
                    </button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                </div>
            </div>
        `);
    });

    // Ejecutar eliminación
    $(document).on('click', '.btn-confirmar-eliminar', function () {
        const id = $(this).data('id');
        const url = $(this).data('url');

        $.post(url, { id }, function () {
            $('#mainModal').modal('hide');
            location.reload();
        }).fail(function () {
            $('#modalContent').html('<p>Error al eliminar el registro.</p>');
        });
    });
});
