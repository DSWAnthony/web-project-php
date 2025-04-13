<?php 

require_once '../../views/layouts/header.php'; // Asegúrate de que la ruta sea correcta

$conexion = new Conexion();
$pdo = $conexion->Conectar();

$sql = "SELECT * FROM ubicacion_almacen";
$stmt = $pdo->query($sql);

?>

<body class="bg-info-subtle">

<div class="container mt-5">
    <h2 class="mb-4">📦 Listado de Ubicaciones</h2>
    <div class="mb-3">
        <a href="registrar.php" class="btn btn-primary">+ Registrar</a>
    </div>

    <table class="table table-bordered bg-white">
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
    <?php while ($row = $stmt->fetch()): ?>
        <tr>
            <td><?= $row['ubicacion_id'] ?></td>
            <td><?= $row['contenedor'] ?></td>
            <td><?= $row['estante'] ?></td>
            <td><?= $row['pasillo'] ?></td>
            <td>
                <a href="ver.php?id=<?= $row['ubicacion_id'] ?>" class="btn btn-info btn-sm">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="editar.php?id=<?= $row['ubicacion_id'] ?>" class="btn btn-success btn-sm">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="eliminar.php?id=<?= $row['ubicacion_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
</div>
</body>
</html>