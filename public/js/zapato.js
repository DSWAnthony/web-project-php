$(document).on('click', '.btn-registrar', function () {
    const url = $(this).data('url'); // Obtener la URL del archivo a cargar

    console.log('Cargando formulario de registro desde:', url);

    // Cargar el contenido del modal desde el archivo correspondiente
    $('#modalContent').load(url, function (response, status, xhr) {
        if (status === "error") {
            console.error('Error al cargar el contenido del modal:', xhr.status, xhr.statusText);
            $('#modalContent').html('<p>Error al cargar el formulario de registro.</p>');
        }
    });

    // Mostrar el modal
    $('#mainModal').modal('show');
});
$(document).off('click', '#btnRegistrarZapato').on('click', '#btnRegistrarZapato', function () {
    const form = $('#formRegistrarZapato'); // Seleccionar el formulario
    const formData = form.serialize(); // Serializar los datos del formulario
    const button = $(this); // Seleccionar el botón

    // Deshabilitar el botón para evitar múltiples clics
    button.prop('disabled', true);

    // Realizar el envío del formulario mediante AJAX
    $.ajax({
        url: 'registrar_zapato.php', // Archivo PHP que procesa el registro
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
            try {
                if (response.success) {
                    alert(response.message); // Mostrar mensaje de éxito
                    $('#mainModal').modal('hide'); // Cerrar el modal
                    form[0].reset(); // Limpiar el formulario
                    location.reload(); // Recargar la página para mostrar el nuevo zapato
                } else {
                    alert(response.message || 'Hubo un error desconocido al registrar el zapato.');
                }
            } catch (e) {
                console.error('Error al procesar la respuesta del servidor:', e);
                alert('Hubo un error inesperado. Por favor, inténtalo de nuevo.');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error en la solicitud AJAX:', status, error);
            console.error('Respuesta del servidor:', xhr.responseText);
            alert('Hubo un error al registrar el zapato. Por favor, revisa la consola para más detalles.');
        },
        complete: function () {
            // Rehabilitar el botón después de completar la solicitud
            button.prop('disabled', false);
        }
    });
});
// Manejar clic en el botón "Consultar"
$(document).on('click', '.btn-consultar', function () {
    const url = $(this).data('url'); // Obtener la URL del archivo
    console.log('Botón Consultar presionado. URL:', url);

    // Mostrar el modal y cargar el contenido
    $('#mainModal').modal('show'); // Mostrar el modal
    $('#modalContent').html('<p>Cargando formulario de consulta...</p>');

    // Cargar el contenido del archivo correspondiente
    $.get(url, function (data) {
        $('#modalContent').html(data); // Cargar el contenido recibido en el modal
    }).fail(function () {
        $('#modalContent').html('<p>Error al cargar el formulario de consulta.</p>');
    });
});

// Manejar clic en el botón "Filtrar"
$(document).on('click', '#btnFiltrarZapato', function () {
    const form = $('#formFiltrarZapato'); // Seleccionar el formulario
    const formData = form.serialize(); // Serializar los datos del formulario
    const resultados = $('#resultadosFiltro'); // Contenedor para los resultados

    // Limpiar resultados previos
    resultados.html('');

    // Realizar la solicitud AJAX
    $.ajax({
        url: 'filtrar_zapato.php', // Archivo PHP que procesa el filtro
        method: 'POST',
        data: formData,
        success: function (response) {
            // Mostrar los resultados en el contenedor
            resultados.html(response);
        },
        error: function (xhr, status, error) {
            console.error('Error en la solicitud AJAX:', status, error);
            resultados.html('<div class="alert alert-danger">Hubo un error al filtrar las zapatillas. Por favor, inténtelo de nuevo.</div>');
        }
    });
});

// Manejar clic en el botón "Info"
$(document).on('click', '.btn-info', function () {
    const id = $(this).data('id'); // Obtener el ID del zapato
    const url = $(this).data('url'); // Obtener la URL del archivo
    console.log('Botón Info presionado. ID:', id, 'URL:', url);

    // Mostrar el modal y cargar el contenido
    $('#mainModal').modal('show'); // Mostrar el modal
    $('#modalContent').html('<p>Cargando información del zapato...</p>');

    // Cargar el contenido del archivo correspondiente
    $.post(url, { id: id }, function (data) {
        $('#modalContent').html(data); // Cargar el contenido recibido en el modal
    }).fail(function () {
        $('#modalContent').html('<p>Error al cargar la información del zapato.</p>');
    });
});

// Manejar clic en el botón "Editar"
$(document).on('click', '.btn-editar', function () {
    const id = $(this).data('id'); // Obtener el ID del zapato
    const url = $(this).data('url'); // Obtener la URL del archivo
    console.log('Botón Editar presionado. ID:', id, 'URL:', url);

    // Mostrar el modal y cargar el contenido
    $('#mainModal').modal('show'); // Mostrar el modal
    $('#modalContent').html('<p>Cargando formulario de edición...</p>');

    // Cargar el contenido del archivo correspondiente
    $.post(url, { id: id }, function (data) {
        $('#modalContent').html(data); // Cargar el contenido recibido en el modal
    }).fail(function () {
        $('#modalContent').html('<p>Error al cargar el formulario de edición.</p>');
    });
});

$(document).on('click', '#btnGuardarCambiosZapato', function () {
    const form = $('#formEditarZapato'); // Seleccionar el formulario
    const formData = form.serialize(); // Serializar los datos del formulario
    const button = $(this); // Seleccionar el botón

    // Deshabilitar el botón para evitar múltiples clics
    button.prop('disabled', true);

    // Realizar el envío del formulario mediante AJAX
    $.ajax({
        url: 'editar_zapato.php', // Archivo PHP que procesa la edición
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                alert(response.message); // Mostrar mensaje de éxito
                $('#mainModal').modal('hide'); // Cerrar el modal
                location.reload(); // Recargar la página para reflejar los cambios
            } else {
                alert(response.message || 'Hubo un error al actualizar el zapato.');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error en la solicitud AJAX:', status, error);
            console.error('Respuesta del servidor:', xhr.responseText);
            alert('Hubo un error al actualizar el zapato. Por favor, revisa la consola para más detalles.');
        },
        complete: function () {
            // Rehabilitar el botón después de completar la solicitud
            button.prop('disabled', false);
        }
    });
});
// Manejar clic en el botón "Eliminar"
$(document).on('click', '.btn-eliminar', function () {
    const id = $(this).data('id'); // Obtener el ID del zapato
    const url = $(this).data('url'); // Obtener la URL del archivo
    console.log('Botón Eliminar presionado. ID:', id, 'URL:', url);

    // Mostrar el modal con un diseño mejorado
    $('#mainModal').modal('show'); // Mostrar el modal
    $('#modalContent').html(`
        <div class="text-center">
            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
            <h4 class="mt-3">¿Estás seguro?</h4>
            <p>Esta acción eliminará permanentemente el zapato con ID: <strong>${id}</strong>.</p>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button class="btn btn-danger btn-confirmar-eliminar me-2" data-id="${id}" data-url="${url}">
                <i class="fas fa-trash-alt"></i> Eliminar
            </button>
            <button class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="fas fa-times"></i> Cancelar
            </button>
        </div>
    `);
});

// Manejar confirmación de eliminación
$(document).on('click', '.btn-confirmar-eliminar', function () {
    const id = $(this).data('id'); // Obtener el ID del zapato
    const url = $(this).data('url'); // Obtener la URL del archivo
    console.log('Confirmación de eliminación para el ID:', id, 'URL:', url);

    // Realizar la solicitud para eliminar el zapato
    $.post(url, { id: id }, function (data) {
        $('#modalContent').html('<p>Zapato eliminado correctamente.</p>');
        $('#mainModal').modal('hide'); // Cerrar el modal después de eliminar
        location.reload(); // Recargar la página inmediatamente para reflejar los cambios
    }).fail(function () {
        $('#modalContent').html('<p>Error al intentar eliminar el zapato.</p>');
    });
});
$(document).on('click', '#btnConsultarZapato', function () {
    const form = $('#formConsultarZapato'); // Seleccionar el formulario
    const formData = form.serialize(); // Serializar los datos del formulario
    const resultados = $('#resultadosConsulta'); // Contenedor para los resultados

    // Limpiar resultados previos
    resultados.html('');

    // Realizar la solicitud AJAX
    $.ajax({
        url: 'consultar_zapato.php', // Archivo PHP que procesa la consulta
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                const zapato = response.data;

                // Crear el card con los datos del zapato
                const card = `
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title">Zapato ID: ${zapato.zapato_id}</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Color:</strong> ${zapato.color}</p>
                            <p><strong>Costo:</strong> $${parseFloat(zapato.costo).toFixed(2)}</p>
                            <p><strong>Porcentaje de Ganancia:</strong> ${zapato.porcentaje_ganancia}%</p>
                            <p><strong>Precio:</strong> $${parseFloat(zapato.precio).toFixed(2)}</p>
                            <p><strong>SKU:</strong> ${zapato.sku}</p>
                            <p><strong>Talla:</strong> ${zapato.talla}</p>
                            <p><strong>Modelo:</strong> ${zapato.modelo_nombre}</p>
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
        error: function (xhr, status, error) {
            console.error('Error en la solicitud AJAX:', status, error);
            resultados.html('<div class="alert alert-danger">Hubo un error al consultar el zapato. Por favor, inténtelo de nuevo.</div>');
        }
    });
});


$(document).on('click', '.btn-info', function () {
    const id = $(this).data('id'); // Obtener el ID del zapato
    const url = $(this).data('url'); // Obtener la URL del archivo
    console.log('Botón Info presionado. ID:', id, 'URL:', url);

    // Mostrar el modal y cargar el contenido
    $('#mainModal').modal('show'); // Mostrar el modal
    $('#modalContent').html('<p>Cargando información del zapato...</p>');

    // Cargar el contenido del archivo correspondiente
    $.post(url, { id: id }, function (data) {
        $('#modalContent').html(data); // Cargar el contenido recibido en el modal
    }).fail(function () {
        $('#modalContent').html('<p>Error al cargar la información del zapato.</p>');
    });
});
$(document).on('click', '.btn-eliminar', function () {
    const id = $(this).data('id'); // Obtener el ID del zapato
    const url = $(this).data('url'); // Obtener la URL del archivo
    console.log('Botón Eliminar presionado. ID:', id, 'URL:', url);

    // Mostrar el modal con un diseño mejorado
    $('#mainModal').modal('show'); // Mostrar el modal
    $('#modalContent').html(`
        <div class="text-center">
            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
            <h4 class="mt-3">¿Estás seguro?</h4>
            <p>Esta acción eliminará permanentemente el zapato con ID: <strong>${id}</strong>.</p>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button class="btn btn-danger btn-confirmar-eliminar me-2" data-id="${id}" data-url="${url}">
                <i class="fas fa-trash-alt"></i> Eliminar
            </button>
            <button class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="fas fa-times"></i> Cancelar
            </button>
        </div>
    `);
});

$(document).on('click', '.btn-info', function () {
    console.log('Evento del botón Info activado.');
});

$(document).on('click', '.btn-eliminar', function () {
    console.log('Evento del botón Eliminar activado.');
});