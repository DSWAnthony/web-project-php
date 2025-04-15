<?php
require_once '../../views/layouts/header.php';
 // Asegúrate de que la ruta sea correcta

require_once '../../models/crud_provedor.php';

// Instancia del modeloin
$modeloProvedor = new CRUDProveedor();

// Obtiene los proveedores desde la base de datos
$proveedores = $modeloProvedor->ListarProveedores();
?>
<link rel="stylesheet" href="../../../public/css/style.css">

    <div class="container mt-5">
        <h1><i class="fa-solid fa-caravan"></i> Listado de Proveedores</h1>

        <nav>
    <div class="d-flex justify-content-center mb-4">
        <div class="btn-group" role="group" aria-label="Basic outlined example">
            <!-- Botón Registrar -->
            <button 
    type="button" 
    class="btn btn-outline-primary btn-registrar" 
    data-url="registrar_provedor.php" 
    data-bs-toggle="tooltip" 
    data-bs-placement="top" 
    title="Registrar un nuevo proveedor">
    <i class="fas fa-plus"></i> Registrar
</button>

<!-- Botón Consultar -->
<button 
    type="button" 
    class="btn btn-outline-primary btn-consultar" 
    data-url="consultar_provedor.php" 
    data-bs-toggle="tooltip" 
    data-bs-placement="top" 
    title="Consultar un proveedor">
    <i class="fas fa-search"></i> Consultar
</button>

<!-- Botón Filtrar -->
<button 
    type="button" 
    class="btn btn-outline-primary btn-filtrar" 
    data-url="filtrar_provedor.php" 
    data-bs-toggle="tooltip" 
    data-bs-placement="top" 
    title="Filtrar proveedores">
    <i class="fas fa-filter"></i> Filtrar
</button>
        </div>
    </div>
</nav>
        <!-- Tabla de proveedores -->
        <div class="d-flex justify-content-center">
            <div class="table-responsive" style="min-width: 600px;">
                <table class="table table-bordered table-striped mt-4">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($proveedores as $proveedor): ?>
                            <tr>
                                <td><?= $proveedor->proveedor_id ?></td>
                                <td><?= $proveedor->nombre ?></td>
                                <td><?= $proveedor->telefono ?></td>
                                <td>
    <!-- Botón Info -->
    <button 
    type="button" 
    class="btn btn-outline-info btn-sm btn-info" 
    data-id="<?= $proveedor->proveedor_id ?>" 
    data-url="mostrar_provedor.php">
    <i class="fas fa-info"></i>
</button>

    <!-- Botón Editar -->
    <button 
        type="button" 
        class="btn btn-outline-success btn-sm btn-editar" 
        data-id="<?= $proveedor->proveedor_id ?>"
        data-url="editar_provedor.php">
        <i class="fa-solid fa-pen"></i>
    </button>

    <!-- Botón Eliminar -->
    <button 
        type="button" 
        class="btn btn-outline-danger btn-sm btn-eliminar" 
        data-id="<?= $proveedor->proveedor_id ?>"
        data-url="eliminar_provedor.php">
        <i class="fa-solid fa-trash"></i>
    </button>
</td>
                            </tr>
                        <?php endforeach; ?>
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

    <!-- Script para cargar contenido dinámico en el modal -->
    <script>
        $(document).on('click', '.btn-modal', function () {
            const url = $(this).data('url'); // Obtener la URL del archivo a cargar
            const id = $(this).data('id'); // Obtener el ID del proveedor (si existe)

            // Cargar el contenido del modal desde el archivo correspondiente
            $('#modalContent').load(url, { id: id });
        });
    </script>
</body>
<footer>
<?php
require_once '../../views/layouts/footer.php'; // Asegúrate de que la ruta sea correcta
?>
</footer>
</html>

<css ?>