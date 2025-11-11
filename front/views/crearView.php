<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Planta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/index.php">
                🌿 <strong>Vivero Marissi</strong>
            </a>
            
            <div class="d-flex">
                <?php 
                    // Calcular el total de artículos en el carrito para mostrar en el botón
                    $num_items = isset($_SESSION['carrito']) ? array_sum(array_column($_SESSION['carrito'], 'cantidad')) : 0;
                ?>
                
                <a href="carritoView.php" class="btn btn-warning me-3">
                    🛒 Carrito (<?php echo $num_items; ?>)
                </a> 
                
                <a href="../controllers/auth/login.php" class="btn btn-outline-primary">
                    Ingresar
                </a>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        
        <h1 class="mb-4">Agregar Nueva Planta</h1>

        <form method="POST" action="../controllers/crear.php" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Planta</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            
            <div class="mb-3">
                <label for="id_categoria" class="form-label">Categoría</label>
                <select class="form-select" id="id_categoria" name="id_categoria" required>
                    <option value="" selected disabled>Seleccione una categoría</option>
                    <?php 
                    if (!empty($categorias)):
                        foreach ($categorias as $c): ?>
                        <option value="<?php echo htmlspecialchars($c->id); ?>">
                            <?php echo htmlspecialchars($c->nombre); ?>
                        </option>
                    <?php 
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen de la Planta</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/jpeg, image/png">
                <small class="form-text text-muted">Archivos JPG o PNG. Opcional.</small>
            </div>
            
            <button type="submit" class="btn btn-success me-2">
                <i class="bi bi-plus-circle"></i> Crear Planta
            </button>
            <a href="../controllers/PlantasControllers.php" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Cancelar
            </a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>