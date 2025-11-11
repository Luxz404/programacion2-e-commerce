<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/admin.css"> 
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
        <div class="container">
            
            <a class="navbar-brand" href="/index.php">
                🌿 <strong>Vivero Marissi</strong> <span class="text-secondary fw-normal">| Panel Admin</span>
            </a>

            <div class="d-flex align-items-center">
                
                <?php 
                // Asegúrate de que session_start() se llama en el controlador antes de incluir esta vista
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                
                if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin'): ?>
                    
                    <span class="navbar-text me-3 text-dark fw-bold">
                        Bienvenido, **<?php echo htmlspecialchars($_SESSION['user_name']); ?>**
                    </span>
                    
                    <a href="../controllers/auth/logout.php" class="btn btn-danger">
                        Cerrar Sesión
                    </a>

                <?php else: ?>
                    
                    <a href="../controllers/auth/login.php" class="btn btn-primary">
                        Login
                    </a>

                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container mt-5"> 

        <h1 class="mb-4 text-center">Gestión de Productos</h1>
        
        <div class="mb-3 d-flex justify-content-end">
            <a href="../controllers/crearViewController.php" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Agregar Nueva Planta
            </a>
        </div>

        <div class="card shadow">
            <div class="card-body p-0">
                <table class="table table-gestion table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Imagen</th> 
                            <th>Planta</th>
                            <th>Categoría</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acciones</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($plantas)): ?>
                            <?php foreach($plantas as $p): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($p->imagen_url)): ?>
                                        <img src="/<?php echo htmlspecialchars($p->imagen_url); ?>" 
                                             alt="<?php echo htmlspecialchars($p->planta_nombre); ?>" 
                                             class="admin-thumbnail" style="object-fit: cover;">
                                    <?php else: ?>
                                        <span class="text-muted">N/A</span>
                                    <?php endif; ?>
                                </td>
                                
                                <td><?php echo htmlspecialchars($p->planta_nombre); ?></td>
                                <td><?php echo htmlspecialchars($p->categoria ?? 'Sin categoría'); ?></td>
                                <td><?php echo htmlspecialchars(substr($p->planta_desc, 0, 50)) . '...'; ?></td>
                                <td>$<?php echo number_format($p->planta_precio, 2); ?></td>
                                <td><?php echo htmlspecialchars($p->planta_stock); ?></td>
                                
                                <td>
                                    <a href="../controllers/editarViewController.php?id=<?php echo $p->id; ?>" class="btn btn-sm btn-primary">
                                        Editar
                                    </a>
                                    
                                    <a href="../controllers/eliminar.php?id=<?php echo $p->id; ?>" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('¿Estás seguro de que quieres eliminar esta planta?');">
                                        Eliminar
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No hay plantas registradas.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navbar = document.querySelector('.navbar');
            window.onscroll = function () {
                if (window.pageYOffset > 50) {
                    navbar.classList.add('shadow-lg');
                } else {
                    navbar.classList.remove('shadow-lg');
                }
            };
        });
    </script>
</body>
</html>