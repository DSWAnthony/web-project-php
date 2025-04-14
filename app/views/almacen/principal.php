<?php
require_once '../../views/layouts/header.php';
require_once '../../models/crud_almacen.php';

// Instancia del modelo
$crudAlmacen = new CRUDAlmacen();

// Obtener todas las ubicaciones del almacén
$ubicaciones = $crudAlmacen->ListarUbicaciones();
?>
<link rel="stylesheet" href="../../../public/css/style.css">

<div class="container mt-5">
    <h1><i class="fas fa-map-marker-alt"></i> Listado de Ubicaciones del Almacén</h1>

    <nav>
        <div class="d-flex justify-content-center mb-4">
            <div class="btn-group" role="group" aria-label="Botones Ubicaciones">
                <!-- Botón Registrar -->
                <button 
                    type="button" 
                    class="btn btn-outline-primary btn-registrar" 
                    data-url="registrar_ubicacion.php" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    title="Registrar una nueva ubicación">
                    <i class="fas fa-plus"></i> Registrar
                </button>

                <!-- Botón Consultar -->
                <button 
                    type="button" 
                    class="btn btn-outline-primary btn-consultar" 
                    data-url="consultar_ubicacion.php" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    title="Consultar una ubicación">
                    <i class="fas fa-search"></i> Consultar
                </button>

                <!-- Botón Filtrar -->
                <button 
                    type="button" 
                    class="btn btn-outline-primary btn-filtrar" 
                    data-url="filtrar_ubicacion.php" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    title="Filtrar ubicaciones por contenedor">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
            </div>
        </div>
    </nav>

    <!-- Tabla de ubicaciones -->
    <div class="d-flex justify-content-center">
        <div class="table-responsive" style="min-width: 800px;">
            <table class="table table-bordered table-striped mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Contenedor</th>
                        <th>Estante</th>
                        <th>Pasillo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($ubicaciones)): ?>
                        <?php foreach ($ubicaciones as $ubicacion): ?>
                            <tr>
                                <td><?= htmlspecialchars($ubicacion->ubicacion_id) ?></td>
                                <td><?= htmlspecialchars($ubicacion->contenedor) ?></td>
                                <td><?= htmlspecialchars($ubicacion->estante) ?></td>
                                <td><?= htmlspecialchars($ubicacion->pasillo) ?></td>
                                <td>
                                    <!-- Botón Información -->
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-info btn-sm btn-info" 
                                        data-id="<?= $ubicacion->ubicacion_id ?>" 
                                        data-url="mostrar_ubicacion.php">
                                        <i class="fas fa-info"></i>
                                    </button>

                                    <!-- Botón Editar -->
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-success btn-sm btn-editar" 
                                        data-id="<?= $ubicacion->ubicacion_id ?>" 
                                        data-url="editar_ubicacion.php">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>

                                    <!-- Botón Eliminar -->
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-danger btn-sm btn-eliminar" 
                                        data-id="<?= $ubicacion->ubicacion_id ?>" 
                                        data-url="eliminar_ubicacion.php">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No se encontraron ubicaciones.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal principal -->
<div class="modal fade" id="mainModal" tabindex="-1" aria-labelledby="mainModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modalContent">
            <!-- El contenido del modal se cargará dinámicamente -->
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery (necesario para AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="../../../public/js/almacen.js"></script>
<script>
    $(document).on('click', '.btn-modal', function () {
        const url = $(this).data('url'); // Obtener la URL del archivo a cargar
        const id = $(this).data('id'); // Obtener el ID de la ubicación (si existe)

        // Cargar el contenido del modal desde el archivo correspondiente
        $('#modalContent').load(url, { id: id });
    });
</script>
</body>
</html>