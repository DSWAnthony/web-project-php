$(document).off('click', '#btnRegistrarUbicacion').on('click', '#btnRegistrarUbicacion', function () {
    const form = $('#formRegistrarUbicacion'); // Seleccionar el formulario
    const formData = form.serialize(); // Serializar los datos del formulario
    const button = $(this); // Seleccionar el botón

    // Deshabilitar el botón para evitar múltiples clics
    button.prop('disabled', true);

    // Realizar el envío del formulario mediante AJAX
    $.ajax({
        url: 'registrar_almacen.php', // Archivo PHP que procesa el registro
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
            try {
                if (response.success) {
                    alert(response.message); // Mostrar mensaje de éxito
                    $('#mainModal').modal('hide'); // Cerrar el modal
                    form[0].reset(); // Limpiar el formulario
                    location.reload(); // Recargar la página para mostrar la nueva ubicación
                } else {
                    alert(response.message || 'Hubo un error desconocido al registrar la ubicación.');
                }
            } catch (e) {
                console.error('Error al procesar la respuesta del servidor:', e);
                alert('Hubo un error inesperado. Por favor, inténtalo de nuevo.');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error en la solicitud AJAX:', status, error);
            console.error('Respuesta del servidor:', xhr.responseText);
            alert('Hubo un error al registrar la ubicación. Por favor, revisa la consola para más detalles.');
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
$(document).on('click', '.btn-filtrar', function () {
    const url = $(this).data('url'); // Obtener la URL del archivo a cargar

    console.log('Cargando el formulario de filtrado desde:', url);

    // Cargar el contenido del modal desde el archivo correspondiente
    $('#modalContent').load(url, function (response, status, xhr) {
        if (status === "error") {
            console.error('Error al cargar el contenido:', xhr.status, xhr.statusText);
            $('#modalContent').html('<p>Error al cargar el formulario de filtrado.</p>');
        }
    });

    // Mostrar el modal
    $('#mainModal').modal('show');
});

// Manejar clic en el botón "Info"
$(document).on('click', '.btn-info', function () {
    const id = $(this).data('id'); // Obtener el ID de la ubicación
    const url = $(this).data('url'); // Obtener la URL del archivo PHP
    console.log('Cargando detalles para ID:', id);

    // Mostrar mensaje de carga en el modal
    $('#modalContent').html('<p>Cargando detalles...</p>');

    // Realizar la solicitud AJAX para cargar los detalles
    $.ajax({
        url: url,
        method: 'GET',
        data: { id: id }, // Enviar el ID de la ubicación
        success: function (data) {
            // Cargar los datos recibidos en el modal
            $('#modalContent').html(data);
            $('#mainModal').modal('show'); // Mostrar el modal
        },
        error: function (xhr, status, error) {
            console.error('Error al cargar los detalles:', status, error);
            console.error('Respuesta del servidor:', xhr.responseText);
            $('#modalContent').html('<p>Error al cargar los detalles. Por favor, inténtelo de nuevo.</p>');
        }
    });
});

// Manejar clic en el botón "Editar"


// Manejar clic en el botón "Eliminar"
$(document).on('click', '.btn-eliminar', function () {
    const id = $(this).data('id'); // Obtener el ID de la ubicación
    const url = $(this).data('url'); // Obtener la URL del archivo
    console.log('Botón Eliminar presionado. ID:', id, 'URL:', url);

    // Mostrar el modal con un diseño mejorado
    $('#mainModal').modal('show'); // Mostrar el modal
    $('#modalContent').html(`
        <div class="text-center">
            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
            <h4 class="mt-3">¿Estás seguro?</h4>
            <p>Esta acción eliminará permanentemente la ubicación con ID: <strong>${id}</strong>.</p>
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
    const id = $(this).data('id'); // Obtener el ID de la ubicación
    const url = $(this).data('url'); // Obtener la URL del archivo
    console.log('Confirmación de eliminación para el ID:', id, 'URL:', url);

    // Realizar la solicitud para eliminar la ubicación
    $.post(url, { id: id }, function (data) {
        $('#modalContent').html('<p>Ubicación eliminada correctamente.</p>');
        $('#mainModal').modal('hide'); // Cerrar el modal después de eliminar
        location.reload(); // Recargar la página inmediatamente para reflejar los cambios
    }).fail(function () {
        $('#modalContent').html('<p>Error al intentar eliminar la ubicación.</p>');
    });
});
// Manejar clic en el botón "Editar"
$(document).on('click', '.btn-editar', function () {
    const id = $(this).data('id'); // Obtener el ID de la ubicación
    const url = $(this).data('url'); // Obtener la URL del archivo
    console.log('Botón Editar presionado. ID:', id, 'URL:', url);

    // Mostrar el modal y cargar el contenido
    $('#mainModal').modal('show'); // Mostrar el modal
    $('#modalContent').html('<p>Cargando formulario de edición...</p>');

    // Cargar el contenido del archivo correspondiente
    $.ajax({
        url: url, // URL del archivo PHP que devuelve el formulario
        method: 'GET',
        data: { id: id }, // Enviar el ID de la ubicación
        success: function (data) {
            $('#modalContent').html(data); // Cargar el contenido recibido en el modal
        },
        error: function (xhr, status, error) {
            console.error('Error al cargar el formulario de edición:', status, error);
            console.error('Respuesta del servidor:', xhr.responseText);
            $('#modalContent').html('<p>Error al cargar el formulario de edición.</p>');
        }
    });
});

// Manejar clic en el botón "Guardar Cambios"
$(document).on('click', '#btnGuardarCambiosUbicacion', function () {
    const form = $('#formEditarUbicacion'); // Seleccionar el formulario
    const formData = form.serialize(); // Serializar los datos del formulario
    const button = $(this); // Seleccionar el botón
    console.log('Datos enviados:', formData); // Verificar los datos enviados

    // Deshabilitar el botón para evitar múltiples clics
    button.prop('disabled', true);

    // Realizar el envío del formulario mediante AJAX
    $.ajax({
        url: 'editar_almacen.php', // Archivo PHP que procesa la edición
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
            try {
                if (response.success) {
                    alert(response.message); // Mostrar mensaje de éxito
                    $('#mainModal').modal('hide'); // Cerrar el modal
                    location.reload(); // Recargar la página para reflejar los cambios
                } else {
                    alert(response.message || 'Hubo un error al actualizar la ubicación.');
                }
            } catch (e) {
                console.error('Error al procesar la respuesta del servidor:', e);
                alert('Hubo un error inesperado. Por favor, inténtalo de nuevo.');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error en la solicitud AJAX:', status, error);
            console.error('Respuesta del servidor:', xhr.responseText);
            alert('Hubo un error al actualizar la ubicación. Por favor, revisa la consola para más detalles.');
        },
        complete: function () {
            // Rehabilitar el botón después de completar la solicitud
            button.prop('disabled', false);
        }
    });
});