// Manejar clic en el botón "Registrar"
$(document).on('click', '.btn-registrar', function () {
    const url = $(this).data('url'); // Obtener la URL del archivo a cargar

    console.log('Cargando formulario de registro desde:', url);

    // Cargar el contenido del modal desde el archivo correspondiente
    $('#modalContent').load(url, function (response, status, xhr) {
        if (status === "error") {
            console.error('Error al cargar el contenido:', xhr.status, xhr.statusText);
            $('#modalContent').html('<p>Error al cargar el formulario de registro.</p>');
        }
    });

    // Mostrar el modal
    $('#mainModal').modal('show');
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
    const url = $(this).data('url'); // Obtener la URL del archivo
    console.log('Botón Info presionado. ID:', id, 'URL:', url);

    // Mostrar el modal y cargar el contenido
    $('#mainModal').modal('show'); // Mostrar el modal
    $('#modalContent').html('<p>Cargando información de la ubicación...</p>');

    // Cargar el contenido del archivo correspondiente
    $.post(url, { id: id }, function (data) {
        $('#modalContent').html(data); // Cargar el contenido recibido en el modal
    }).fail(function () {
        $('#modalContent').html('<p>Error al cargar la información de la ubicación.</p>');
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
    $.post(url, { id: id }, function (data) {
        $('#modalContent').html(data); // Cargar el contenido recibido en el modal
    }).fail(function () {
        $('#modalContent').html('<p>Error al cargar el formulario de edición.</p>');
    });
});

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