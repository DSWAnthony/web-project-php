$(document).ready(function () {
    // Manejar clic en el botón "Eliminar Categoría"
    $(document).on('click', '.btn-confirmar-eliminar-categoria', function () {
        const id = $(this).data('id');
        const url = $(this).data('url');

        $.post(url, { id }, function (response) {
            try {
                const res = JSON.parse(response);
                if (res.success) {
                    alert('Categoría eliminada correctamente.');
                    location.reload();
                } else {
                    alert('Error: ' + (res.message || 'No se pudo eliminar la categoría.'));
                }
            } catch (e) {
                alert('Error inesperado del servidor.');
            }
        }).fail(() => {
            alert('Error al eliminar la categoría.');
        });
    });
});

$(document).ready(function () {
    // Manejar clic en el botón "Registrar"
    $(document).on('click', '#btnRegistrarCategoria', function () {
        const form = $('#formRegistrarCategoria'); // Seleccionar el formulario
        const formData = form.serialize(); // Serializar los datos del formulario

        // Validar que los campos no estén vacíos
        const nombre = $('#nombre').val().trim();
        const descripcion = $('#descripcion').val().trim();

        if (!nombre || !descripcion) {
            alert('Por favor, completa todos los campos antes de registrar.');
            return;
        }

        // Deshabilitar el botón para evitar múltiples clics
        const button = $(this);
        button.prop('disabled', true);

        // Realizar la solicitud AJAX
        $.ajax({
            type: 'POST',
            url: 'registrar_categoria.php', // Archivo PHP que procesa el registro
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    alert(response.message || 'Categoría registrada correctamente.'); // Mostrar mensaje de éxito
                    $('#mainModal').modal('hide'); // Cerrar el modal
                    form[0].reset(); // Limpiar el formulario
                    location.reload(); // Recargar la página para mostrar la nueva categoría
                } else {
                    alert(response.message || 'Hubo un error al registrar la categoría.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error en la solicitud AJAX:', status, error);
                alert('Hubo un error al registrar la categoría. Por favor, revisa la consola para más detalles.');
            },
            complete: function () {
                // Rehabilitar el botón después de completar la solicitud
                button.prop('disabled', false);
            }
        });
    });

    // Manejar clic en botones con la clase "btn-modal"
    $(document).on('click', '.btn-modal', function () {
        const url = $(this).data('url'); // Obtener la URL del archivo a cargar
        $('#modalContent').html('<p class="text-center">Cargando contenido...</p>'); // Mensaje de carga
        $('#mainModal').modal('show'); // Mostrar el modal

        // Cargar el contenido del modal
        $.ajax({
            type: 'GET',
            url: url,
            success: function (response) {
                $('#modalContent').html(response); // Cargar el contenido en el modal
            },
            error: function () {
                $('#modalContent').html('<p class="text-center text-danger">Error al cargar el contenido. Por favor, inténtelo de nuevo.</p>');
            }
        });
    });
});

    // Manejar clic en botones con la clase "btn-modal"
    $(document).on('click', '.btn-modal', function () {
        const url = $(this).data('url'); // Obtener la URL del archivo a cargar
        $('#modalContent').html('<p class="text-center">Cargando contenido...</p>'); // Mensaje de carga
        $('#mainModal').modal('show'); // Mostrar el modal

        // Cargar el contenido del modal
        $.ajax({
            type: 'GET',
            url: url,
            success: function (response) {
                $('#modalContent').html(response); // Cargar el contenido en el modal
            },
            error: function () {
                $('#modalContent').html('<p class="text-center text-danger">Error al cargar el contenido. Por favor, inténtelo de nuevo.</p>');
            }
        });
    });