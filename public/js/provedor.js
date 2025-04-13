// Manejar clic en el botón "Registrar"

$(document).ready(function () {
    // Quitar el foco de todos los botones al cargar la página
    $('button').blur();
});
$(document).on('click', '.btn-filtrar', function () {
    const url = $(this).data('url'); // Obtener la URL del archivo a cargar

    console.log('Cargando contenido dinámico desde:', url);

    // Cargar el contenido del modal desde el archivo correspondiente
    $('#modalContent').load(url, function (response, status, xhr) {
        if (status === "error") {
            console.error('Error al cargar el contenido:', xhr.status, xhr.statusText);
            $('#modalContent').html('<p>Error al cargar el contenido.</p>');
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
// Manejar clic en el botón "Filtrar Proveedor"
$(document).on('click', '#btnFiltrarProveedor', function () {
    const formData = $('#formFiltrarProveedor').serialize(); // Serializar los datos del formulario
    const url = 'filtrar_provedor.php'; // Ruta al archivo PHP que procesará la búsqueda

    console.log('Buscando proveedores...');
    $.post(url, formData, function (response) {
        console.log('Respuesta del servidor:', response); // Depurar la respuesta del servidor
        try {
            const res = JSON.parse(response); // Parsear la respuesta JSON
            if (res.success) {
                // Mostrar los resultados en el contenedor
                let html = '<table class="table table-striped">';
                html += '<thead><tr><th>ID</th><th>Nombre</th><th>Contacto</th><th>Dirección</th><th>Email</th><th>Teléfono</th><th>RUC</th></tr></thead><tbody>';
                res.data.forEach(proveedor => {
                    html += `<tr>
                        <td>${proveedor.proveedor_id}</td>
                        <td>${proveedor.nombre}</td>
                        <td>${proveedor.contacto}</td>
                        <td>${proveedor.direccion}</td>
                        <td>${proveedor.email}</td>
                        <td>${proveedor.telefono}</td>
                        <td>${proveedor.ruc}</td>
                    </tr>`;
                });
                html += '</tbody></table>';
                $('#resultadosFiltro').html(html);
            } else {
                $('#resultadosFiltro').html(`<p>${res.message}</p>`);
            }
        } catch (e) {
            console.error('Error al parsear la respuesta JSON:', e);
            $('#resultadosFiltro').html('<p>Error inesperado en el servidor.</p>');
        }
    }).fail(function () {
        $('#resultadosFiltro').html('<p>Error al intentar buscar proveedores.</p>');
    });
});

// Manejar clic en el botón "Info"
$(document).on('click', '.btn-info', function () {
    const id = $(this).data('id'); // Obtener el ID del proveedor
    const url = $(this).data('url'); // Obtener la URL del archivo
    console.log('Botón Info presionado. ID:', id, 'URL:', url);

    // Mostrar el modal y cargar el contenido
    $('#mainModal').modal('show'); // Mostrar el modal
    $('#modalContent').html('<p>Cargando información del proveedor...</p>');

    // Cargar el contenido del archivo correspondiente
    $.post(url, { id: id }, function (data) {
        $('#modalContent').html(data); // Cargar el contenido recibido en el modal
    }).fail(function () {
        $('#modalContent').html('<p>Error al cargar la información del proveedor.</p>');
    });
});

// Manejar clic en el botón "Editar"
$(document).on('click', '.btn-editar', function () {
    const id = $(this).data('id'); // Obtener el ID del proveedor
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
    const id = $(this).data('id'); // Obtener el ID del proveedor
    const url = $(this).data('url'); // Obtener la URL del archivo
    console.log('Botón Eliminar presionado. ID:', id, 'URL:', url);

    // Mostrar el modal y cargar el contenido
    $('#mainModal').modal('show'); // Mostrar el modal
    $('#modalContent').html(`
        <p>¿Estás seguro de que deseas eliminar el proveedor con ID: ${id}?</p>
        <button class="btn btn-danger btn-confirmar-eliminar" data-id="${id}" data-url="${url}">Eliminar</button>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    `);
});

// Manejar confirmación de eliminación
$(document).on('click', '.btn-eliminar', function () {
    const id = $(this).data('id'); // Obtener el ID del proveedor
    const url = $(this).data('url'); // Obtener la URL del archivo
    console.log('Botón Eliminar presionado. ID:', id, 'URL:', url);

    // Mostrar el modal con un diseño mejorado
    $('#mainModal').modal('show'); // Mostrar el modal
    $('#modalContent').html(`
        <div class="text-center">
            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
            <h4 class="mt-3">¿Estás seguro?</h4>
            <p>Esta acción eliminará permanentemente el proveedor con ID: <strong>${id}</strong>.</p>
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
    const id = $(this).data('id'); // Obtener el ID del proveedor
    const url = $(this).data('url'); // Obtener la URL del archivo
    console.log('Confirmación de eliminación para el ID:', id, 'URL:', url);

    // Realizar la solicitud para eliminar el proveedor
    $.post(url, { id: id }, function (data) {
        $('#modalContent').html('<p>Proveedor eliminado correctamente.</p>');
        $('#mainModal').modal('hide'); // Cerrar el modal después de eliminar
        location.reload(); // Recargar la página inmediatamente para reflejar los cambios
    }).fail(function () {
        $('#modalContent').html('<p>Error al intentar eliminar el proveedor.</p>');
    });
});

// Manejar clic en el botón "Guardar Cambios" en el formulario de edición
$(document).on('click', '#btnGuardarCambios', function () {
    const formData = $('#formEditarProveedor').serialize(); // Serializar los datos del formulario
    const url = 'editar_provedor.php'; // Ruta al archivo PHP que procesará la actualización

    console.log('Guardando cambios para el proveedor...');
    $.post(url, formData, function (response) {
        const res = JSON.parse(response); // Parsear la respuesta JSON
        if (res.success) {
            alert('Proveedor actualizado correctamente.');
            $('#mainModal').modal('hide'); // Cerrar el modal
            location.reload(); // Recargar la página para reflejar los cambios
        } else {
            alert(res.message || 'Error al actualizar el proveedor.');
        }
    }).fail(function () {
        alert('Error al intentar guardar los cambios.');
    });
});



$(document).on('click', '#btnRegistrarProveedor', function () {
    const formData = $('#formRegistrarProveedor').serialize(); // Serializar los datos del formulario
    const url = 'registrar_provedor.php'; // Ruta al archivo PHP que procesará el registro

    console.log('Enviando datos para registrar un nuevo proveedor...');
    $.post(url, formData, function (response) {
        console.log('Respuesta del servidor:', response); // Depurar la respuesta del servidor
        try {
            const res = JSON.parse(response); // Parsear la respuesta JSON
            if (res.success) {
                alert(res.message);
                $('#mainModal').modal('hide'); // Cerrar el modal
                location.reload(); // Recargar la página para reflejar los cambios
            } else {
                alert(res.message || 'Error al registrar el proveedor.');
            }
        } catch (e) {
            console.error('Error al parsear la respuesta JSON:', e);
            alert('Error inesperado en el servidor.');
        }
    }).fail(function () {
        alert('Error al intentar registrar el proveedor.');
    });
});

$(document).on('click', '.btn-registrar', function () {
    const url = $(this).data('url'); // Obtener la URL del archivo a cargar

    // Cargar el contenido del modal desde el archivo correspondiente
    $('#modalContent').load(url, function (response, status, xhr) {
        if (status === "error") {
            $('#modalContent').html('<p>Error al cargar el contenido.</p>');
        }
    });

    // Mostrar el modal
    $('#mainModal').modal('show');
});

// Manejar clic en el botón "Filtrar" desde listar_provedor.php
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

// Manejar clic en el botón "Consultar Proveedor"
$(document).on('click', '#btnConsultarProveedor', function () {
    const formData = $('#formConsultarProveedor').serialize(); // Serializar los datos del formulario
    const url = 'consultar_provedor.php'; // Ruta al archivo PHP que procesará la consulta

    console.log('Consultando proveedor...');
    $.post(url, formData, function (response) {
        console.log('Respuesta del servidor:', response); // Depurar la respuesta del servidor
        try {
            const res = JSON.parse(response); // Parsear la respuesta JSON
            if (res.success) {
                // Mostrar los detalles del proveedor en el contenedor
                const proveedor = res.data;
                let html = `
                    <table class="table table-striped table-bordered">
                        <tr><th>ID</th><td>${proveedor.proveedor_id}</td></tr>
                        <tr><th>Nombre</th><td>${proveedor.nombre}</td></tr>
                        <tr><th>Contacto</th><td>${proveedor.contacto}</td></tr>
                        <tr><th>Dirección</th><td>${proveedor.direccion}</td></tr>
                        <tr><th>Email</th><td>${proveedor.email}</td></tr>
                        <tr><th>Teléfono</th><td>${proveedor.telefono}</td></tr>
                        <tr><th>RUC</th><td>${proveedor.ruc}</td></tr>
                    </table>
                `;
                $('#resultadosConsulta').html(html);
            } else {
                $('#resultadosConsulta').html(`<p>${res.message}</p>`);
            }
        } catch (e) {
            console.error('Error al parsear la respuesta JSON:', e);
            $('#resultadosConsulta').html('<p>Error inesperado en el servidor.</p>');
        }
    }).fail(function () {
        $('#resultadosConsulta').html('<p>Error al intentar consultar el proveedor.</p>');
    });
});