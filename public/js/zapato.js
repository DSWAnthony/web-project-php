$(document).ready(function () {
    // Mostrar modal para editar
    $(document).on('click', '.btn-zapato-editar', function () {
        const zapatoId = $(this).data('id');
        const url = $(this).data('url');

        $.post(url, { id: zapatoId }, function (response) {
            $('#modalContent').html(response);  // Cargar el formulario en el modal
            $('#mainModal').modal('show');  // Mostrar el modal con el formulario de edición
        });
    });

    // Mostrar información del zapato
    $(document).on('click', '.btn-zapato-info', function () {
        const zapatoId = $(this).data('id');
        const url = $(this).data('url');

        $.post(url, { id: zapatoId }, function (response) {
            $('#modalContent').html(response);  // Cargar la información en el modal
            $('#mainModal').modal('show');  // Mostrar el modal con la información del zapato
        });
    });

    // Eliminar zapato con confirmación
    $(document).on('click', '.btn-zapato-eliminar', function () {
        const zapatoId = $(this).data('id');
        const url = $(this).data('url');

        if (confirm('¿Estás seguro que deseas eliminar este zapato?')) {
            $.post(url, { id: zapatoId }, function (response) {
                const data = JSON.parse(response);
                alert(data.message);
                if (data.success) {
                    location.reload();  // Recargar la página si el zapato fue eliminado
                }
            });
        }
    });

    // Registrar zapato
    $(document).on('click', '#btnRegistrarZapato', function () {
        const formData = $('#formRegistrarZapato').serialize();  // Obtener los datos del formulario

        $.ajax({
            url: 'registrar_zapato.php',  // URL para procesar el registro
            type: 'POST',
            data: formData,  // Enviar los datos del formulario
            success: function (response) {
                const data = JSON.parse(response);  // Decodificar la respuesta JSON

                if (data.success) {
                    alert(data.message);  // Si el registro fue exitoso, mostrar el mensaje
                    $('#mainModal').modal('hide');  // Cerrar el modal
                    location.reload();  // Recargar la página para mostrar el nuevo zapato
                } else {
                    alert(data.message);  // Si hubo un error, mostrar el mensaje de error
                }
            },
            error: function () {
                alert('Hubo un error al registrar el zapato.');
            }
        });
    });

    // Manejar clic en los botones para mostrar el modal con contenido dinámico
    $(document).on('click', '.btn-modal', function() {
        var zapatoId = $(this).data('id');
        var url = $(this).data('url');

        // Hacer la solicitud AJAX para cargar el contenido en el modal
        $.ajax({
            url: url,
            type: 'POST',
            data: { id: zapatoId },
            success: function(response) {
                $('#modalContent').html(response);  // Colocar la respuesta en el modal
                $('#mainModal').modal('show');  // Mostrar el modal
            },
            error: function() {
                alert('Hubo un error al cargar el contenido.');
            }
        });
    });
});

$(document).on('click', '#btnGuardarCambiosZapato', function() {
    const form = $('#formEditarZapato');
    const formData = form.serialize(); // Serializa el formulario para enviarlo

    // Realiza el envío del formulario mediante AJAX
    $.ajax({
        url: '', // Se usa el mismo archivo PHP
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message); // Muestra mensaje de éxito
                $('#mainModal').modal('hide'); // Cierra el modal
            } else {
                alert(response.message); // Muestra mensaje de error
            }
        },
        error: function() {
            alert('Hubo un error al actualizar el zapato.');
        }
    });
});

