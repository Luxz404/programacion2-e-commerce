<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Vivero Marissi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/catalogo.css"> 
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/index.php">
                🌿 <strong>Vivero Marissi</strong>
            </a>
            
       <div class="d-flex">
                <?php 
                    // Calcular el total de artículos en el carrito
                    $num_items = isset($_SESSION['carrito']) ? array_sum(array_values($_SESSION['carrito'])) : 0;
                ?>
                
                <a href="/controllers/carritoViewController.php" class="btn btn-warning me-3 position-relative">
                    🛒 Carrito 
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php echo $num_items; ?>
                    </span>
                </a> 
                
                <?php if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin'): ?>
                    <a href="/controllers/PlantasControllers.php" class="btn btn-outline-danger me-2">
                        Panel Admin
                    </a>
                    <a href="/controllers/auth/logout.php" class="btn btn-danger">
                        Cerrar Sesión
                    </a>

                <?php elseif (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'cliente'): ?>
                    <span class="navbar-text me-3 text-dark fw-bold">
                        Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                    </span>
                    <a href="/controllers/auth/logout.php" class="btn btn-danger">
                        Cerrar Sesión
                    </a>
                
                <?php else: ?>
                    <a href="/controllers/auth/login.php" class="btn btn-outline-primary">
                        Ingresar
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="page-title text-center">Nuestra Selección Orgánica</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            
            <?php if (!empty($plantas)): ?>
                <?php foreach($plantas as $planta): ?>
                
                <div class="col">
                    <div class="card h-100 product-card shadow-sm">
                        
                        <div class="product-image-container">
                            <?php if (!empty($planta->imagen_url)): ?>
                                <img src="/<?php echo htmlspecialchars($planta->imagen_url); ?>" 
                                     alt="<?php echo htmlspecialchars($planta->planta_nombre); ?>"
                                     class="img-fluid">
                            <?php else: ?>
                                <span class="text-secondary fw-bold">Imagen no disponible</span>
                            <?php endif; ?>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="product-name"><?php echo htmlspecialchars($planta->planta_nombre); ?></h5>
                            
                            <h4 class="product-price">$<?php echo number_format($planta->planta_precio, 2); ?></h4>
                            
                            <form method="POST" action="../controllers/carrito.php">
                                <input type="hidden" name="planta_id" value="<?php echo $planta->id; ?>">
                                <input type="hidden" name="cantidad" value="1"> 
                                <div class="mt-auto">
                                    <small class="text-danger d-block mb-2">Stock: <?php echo htmlspecialchars($planta->planta_stock); ?></small>
                                    <button type="submit" class="btn btn-success w-100 mt-2" 
                                            <?php echo ($planta->planta_stock > 0) ? '' : 'disabled'; ?>>
                                        <?php echo ($planta->planta_stock > 0) ? '🛒 Añadir al Carrito' : 'Agotado'; ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">¡Lo sentimos! No hay productos disponibles en este momento.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        // JS para añadir una sombra al navbar cuando se hace scroll
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