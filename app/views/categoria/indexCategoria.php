<?php
require_once '../../views/layouts/header.php';

$conexion = new Conexion();
$pdo = $conexion->Conectar();

$sql = "SELECT * FROM categoria";
$stmt = $pdo->query($sql);
?>

<!-- Incluye íconos de Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">
        <i class="bi bi-journals me-2"></i>Lista de Categorías
    </h2>

    <div class="d-flex gap-2 mb-4">
        <a href="registrarCategoria.php" class="btn btn-outline-primary">
            <i class="bi bi-plus-circle me-1"></i>Registrar
        </a>
        <button class="btn btn-outline-secondary">
            <i class="bi bi-search me-1"></i>Consultar
        </button>
        <button class="btn btn-outline-info">
            <i class="bi bi-funnel-fill me-1"></i>Filtrar
        </button>
    </div>

    <table class="table table-bordered table-hover shadow-sm rounded bg-white">
        <thead style="background-color: #e8eaf6; color: #3f51b5; font-weight: bold;">
            <tr>
                <th class="text-center">N°</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php $n = 1; while ($row = $stmt->fetch()): ?>
            <tr>
                <td class="text-center"><?= $n++ ?></td>
                <td><?= $row['nombre'] ?></td>
                <td class="text-center">
                    <a href="verCategoria.php?id=<?= $row['categoria_id'] ?>" class="btn btn-outline-primary btn-sm me-1" title="Ver">
                        <i class="bi bi-eye-fill"></i>
                    </a>
                    <a href="editarCategoria.php?id=<?= $row['categoria_id'] ?>" class="btn btn-outline-success btn-sm me-1" title="Editar">
                        <i class="bi bi-pencil-fill"></i>
                    </a>
                    <a href="eliminarCategoria.php?id=<?= $row['categoria_id'] ?>" class="btn btn-outline-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">
                        <i class="bi bi-trash-fill"></i>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <footer class="text-center text-muted mt-5 small">
        <hr>
        © ZAPATILLAS ELITE S.A.C- G1<br>
        Dirección - 📞 01-452-5263<br>
        Lima - Perú
    </footer>
</div>
</body>
</html>
