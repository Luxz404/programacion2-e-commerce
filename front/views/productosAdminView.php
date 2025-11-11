<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin | Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/admin.css"> 
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/index.php">
                🌿 <strong>ECO-MARKET</strong> <span class="text-secondary fw-normal">| Panel Admin</span>
            </a>
            <div class="d-flex align-items-center">
                <span class="navbar-text me-3 text-dark fw-bold">
                    Bienvenido, **<?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Admin'); ?>**
                </span>
                <a href="/controllers/auth/logout.php" class="btn btn-danger">
                    Cerrar Sesión
                </a>
            </div>
        </div>
    </nav>
    <div class="container mt-5"> 
        <h1 class="mb-4 text-center">Gestión de Productos</h1>
        
        <?php if (isset($_GET['status']) && $_GET['status'] === 'saved'): ?>
            <div class="alert alert-success">Producto guardado/actualizado exitosamente.</div>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'delete_failed'): ?>
            <div class="alert alert-warning">No se pudo eliminar el producto (puede estar en un pedido).</div>
        <?php endif; ?>

        <div class="mb-4 d-flex justify-content-end">
            <a href="/controllers/admin/crearProductoController.php" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Agregar Nuevo Producto
            </a>
        </div>

        <div class="card shadow">
            <div class="card-body p-0">
                <table class="table table-gestion table-hover mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th> 
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acciones</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($productos)): ?>
                            <?php foreach($productos as $p): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($p->id); ?></td>
                                <td>
                                    <?php if (!empty($p->imagen_url)): ?>
                                        <img src="/<?php echo htmlspecialchars($p->imagen_url); ?>" 
                                             alt="<?php echo htmlspecialchars($p->nombre); ?>" 
                                             class="admin-thumbnail" style="object-fit: cover;">
                                    <?php else: ?>
                                        <span class="text-muted">N/A</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($p->nombre); ?></td>
                                <td><?php echo htmlspecialchars($p->nombre_categoria ?? 'Sin Categoría'); ?></td>
                                <td>$<?php echo number_format($p->precio, 2); ?></td>
                                <td><?php echo htmlspecialchars($p->stock); ?></td>
                                
                                <td>
                                    <a href="/controllers/admin/editarProductoController.php?id=<?php echo $p->id; ?>" class="btn btn-sm btn-primary mb-1">
                                        Editar
                                    </a>
                                    
                                    <form method="POST" action="/controllers/admin/productosController.php" style="display:inline;" onsubmit="return confirm('¿Confirma la eliminación de <?php echo htmlspecialchars($p->nombre); ?>?');">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $p->id; ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No hay productos registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>