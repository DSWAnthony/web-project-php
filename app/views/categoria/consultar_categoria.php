<?php
require_once '../../models/crud_categoria.php'; // Ajusta la ruta según tu estructura

// Manejar solicitud POST (consulta por ID)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']); // Validación básica

    $crud = new CRUDCategoria();
    $categoria = $crud->BuscarCategoriaPorId($id);

    header('Content-Type: application/json'); // Asegura respuesta JSON
    if ($categoria) {
        echo json_encode(['success' => true, 'data' => $categoria]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontró la categoría con el ID proporcionado.']);
    }
    exit;
}
?>

<!-- HTML del formulario de consulta de categoría -->
<div class="modal-header">
    <h5 class="modal-title">Consultar Categoría</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="formConsultarCategoria">
        <div class="mb-3">
            <label for="id" class="form-label">ID de la Categoría</label>
            <input type="text" class="form-control" id="id" name="id" placeholder="Ingrese el ID de la categoría" required>
        </div>
    </form>
    <div id="resultadosConsulta" class="mt-4">
        <!-- Aquí se mostrarán los detalles de la categoría -->
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="btnConsultarCategoria">Consultar</button>
</div>

<!-- JavaScript para procesar la consulta sin recargar la página -->
<script>
document.getElementById('btnConsultarCategoria').addEventListener('click', function() {
    const form = document.getElementById('formConsultarCategoria');
    const formData = new FormData(form);

    fetch('', { // Mismo archivo, por eso se deja vacío
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        const resultado = document.getElementById('resultadosConsulta');
        if (data.success) {
            const cat = data.data;
            resultado.innerHTML = `
                <h6>Detalles de la categoría:</h6>
                <p><strong>ID:</strong> ${cat.categoria_id}</p>
                <p><strong>Nombre:</strong> ${cat.nombre}</p>
                <p><strong>Descripción:</strong> ${cat.descripcion ?? 'No disponible'}</p>
            `;
        } else {
            resultado.innerHTML = `<div class="alert alert-warning">${data.message}</div>`;
        }
    })
    .catch(err => {
        document.getElementById('resultadosConsulta').innerHTML = `<div class="alert alert-danger">Error al consultar la categoría.</div>`;
        console.error(err);
    });
});
</script>
