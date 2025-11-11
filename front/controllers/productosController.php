<?php
// Inclusiones
include_once __DIR__ . "/../../conf/db.php";
include_once __DIR__ . "/../../model/productos.php";

// 1. CONTROL DE ACCESO (Seguridad)
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
    // Si no es admin, redirigir al catálogo principal
    header("Location: /index.php"); 
    exit;
}

// 2. LÓGICA DE ELIMINACIÓN (Manejada por POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = $_POST['id'] ?? 0;
    
    if ($id > 0) {
        if (eliminarProducto($id)) {
            header("Location: /controllers/admin/productosController.php?status=deleted");
            exit;
        } else {
            // Error, posiblemente por una restricción de clave foránea (si está en un pedido)
            header("Location: /controllers/admin/productosController.php?error=delete_failed");
            exit;
        }
    }
}

// 3. CARGA DE DATOS
$productos = obtenerTodosLosProductos();

// Carga la vista de categorías y datos
$categorias = obtenerCategorias();

// 4. CARGA LA VISTA
require __DIR__ . '/../../views/admin/productosAdminView.php';
?>