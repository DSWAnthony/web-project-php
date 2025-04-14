<?php
require_once '../../models/crud_modelo.php';

// Verifica si se recibió un ID por POST
if (isset($_POST['id'])) {
    $modeloId = $_POST['id'];

    // Instancia del modelo
    $crudModelo = new CRUDModelo();

    // Obtiene los datos del modelo por ID
    $modelo = $crudModelo->BuscarModeloPorId($modeloId);

    // Verifica si se encontró el modelo
    if ($modelo): ?>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Información del Modelo</h5>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> <?= $modelo->modelo_id ?></p>
                <p><strong>Nombre:</strong> <?= $modelo->nombre_modelo ?></p>
                <p><strong>Género:</strong> <?= $modelo->genero ?></p>
                <p><strong>Categoría:</strong> <?= $modelo->nombre_categoria ?></p>
                <p><strong>Marca:</strong> <?= $modelo->nombre_marca ?></p>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            No se encontró el modelo con el ID proporcionado.
        </div>
    <?php endif;
} else { ?>
    <div class="alert alert-danger" role="alert">
        No se proporcionó un ID válido para el modelo.
    </div>
<?php } ?>