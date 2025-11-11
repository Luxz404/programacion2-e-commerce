<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Vivero Marissi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/index.php">🌿 <strong>Vivero Marissi</strong></a>
        <div class="d-flex">
            <a href="/index.php" class="btn btn-outline-primary me-3">Volver al Catálogo</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="mb-4">Tu Carrito de Compras</h1>
    <hr>

    <?php 
    $carrito = $_SESSION['carrito_ids'] ?? [];
    $subtotal = 0;

    if (empty($carrito)): ?>
        
        <div class="alert alert-info text-center" role="alert">
            Tu carrito está vacío.
        </div>
        <p class="text-center">
            <a href="/index.php" class="btn btn-success">Explorar Productos</a>
        </p>

    <?php else: ?>
        <!-- … tu vista sigue igual … -->
    <?php endif; ?>
</div>

</body>
</html>
