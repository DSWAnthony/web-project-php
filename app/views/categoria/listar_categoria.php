<?php
require_once '../../views/layouts/header.php';
require_once '../../models/crud_categoria.php';

$modeloCategoria = new CRUDCategoria();
$categorias = $modeloCategoria->ListarCategorias();
?>
<link rel="stylesheet" href="../../../public/css/style.css">

<div class="container mt-5">
    <h1><i class="fas fa-tags me-1"></i>Listado de Categorías</h1>

    <nav>
        <div class="d-flex justify-content-center mb-4">
            <div class="btn-group" role="group" aria-label="Botones de acción">
                <button 
                    type="button" 
                    class="btn btn-outline-primary btn-registrar btn-modal" 
                    data-url="registrar_categoria.php" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    title="Registrar una nueva categoría">
                    <i class="fas fa-plus"></i> Registrar
                </button>

                <button 
                    type="button" 
                    class="btn btn-outline-primary btn-consultar btn-modal" 
                    data-url="consultar_categoria.php" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    title="Consultar una categoría">
                    <i class="fas fa-search"></i> Consultar
                </button>

                <button 
                    type="button" 
                    class="btn btn-outline-primary btn-filtrar btn-modal" 
                    data-url="filtrar_categoria.php" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    title="Filtrar categorías">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
            </div>
        </div>
    </nav>

    <div class="d-flex justify-content-center">
        <div class="table-responsive" style="min-width: 600px;">
            <table class="table table-bordered table-striped mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $categoria): ?>
                        <tr>
                            <td><?= $categoria->categoria_id ?></td>
                            <td><?= $categoria->nombre ?></td>
                            <td>
                                <button 
                                    type="button" 
                                    class="btn btn-outline-info btn-sm btn-info" 
                                    data-id="<?= $categoria->categoria_id ?>" 
                                    data-url="mostrar_categoria.php">
                                    <i class="fas fa-info"></i>
                                </button>

                                <button 
                                    type="button" 
                                    class="btn btn-outline-success btn-sm btn-editar" 
                                    data-id="<?= $categoria->categoria_id ?>" 
                                    data-url="editar_categoria.php">
                                    <i class="fas fa-pen"></i>
                                </button>

                                <button 
                                    type="button" 
                                    class="btn btn-outline-danger btn-sm btn-eliminar" 
                                    data-id="<?= $categoria->categoria_id ?>" 
                                    data-url="eliminar_categoria.php">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="mainModal" tabindex="-1" aria-labelledby="mainModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modalContent">
        </div>
    </div>
</div>
<script src="../../../public/js/categoria.js"></script>
<!-- Bootstrap & jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '.btn-modal', function () {
        const url = $(this).data('url');
        const id = $(this).data('id') || null;
        $('#modalContent').load(url, { id: id });
        $('#mainModal').modal('show');
    });
</script>
</body>
<footer>
<?php
require_once '../../views/layouts/footer.php'; 
?>
</footer>
</html>
