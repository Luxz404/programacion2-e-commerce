<?php
// front/controllers/carrito.php
session_start();

// Rutas de inclusión: Sube 2 niveles para llegar a la raíz (front/)
include_once __DIR__ . "/../conf/db.php";
include_once __DIR__ . "/../model/plantas.php"; // Ahora contiene obtenerStockProducto

// El carrito almacena solo la ID y la CANTIDAD
$carrito = $_SESSION['carrito_ids'] ?? []; // Usamos un nombre diferente para evitar conflictos
$accion = $_POST['accion'] ?? 'agregar'; 

// Tomar el ID del producto
$idProducto = (int)($_POST['id'] ?? $_POST['eliminar'] ?? $_POST['agregarUno'] ?? $_POST['eliminarUno'] ?? 0);

if ($accion === 'agregar' && $idProducto > 0) {
    $cantidad_a_agregar = (int)($_POST['cantidad'] ?? 1);
    $max_stock = obtenerStockProducto($idProducto);

    $nueva_cantidad = ($carrito[$idProducto] ?? 0) + $cantidad_a_agregar;

    if ($nueva_cantidad <= $max_stock) {
        $carrito[$idProducto] = $nueva_cantidad;
    } else {
        $carrito[$idProducto] = $max_stock;
        $_SESSION['mensaje_error'] = "Solo quedan " . $max_stock . " unidades en stock.";
    }

} elseif ($accion === 'eliminar_uno' && $idProducto > 0) {
    if (isset($carrito[$idProducto])) {
        $carrito[$idProducto]--;
        if ($carrito[$idProducto] <= 0) unset($carrito[$idProducto]);
    }

} elseif ($accion === 'agregar_uno' && $idProducto > 0) {
    if (isset($carrito[$idProducto])) {
        $max_stock = obtenerStockProducto($idProducto);
        if ($carrito[$idProducto] < $max_stock) {
            $carrito[$idProducto]++;
        } else {
            $_SESSION['mensaje_error'] = "Has alcanzado el límite de stock (" . $max_stock . ").";
        }
    }

} elseif ($accion === 'eliminar' && $idProducto > 0) {
    unset($carrito[$idProducto]);

} elseif ($accion === 'actualizar' && isset($_POST['cantidades'])) {
    foreach ($_POST['cantidades'] as $id => $nueva_cantidad) {
        $id = (int)$id;
        $nueva_cantidad = (int)$nueva_cantidad;
        if ($nueva_cantidad <= 0) unset($carrito[$id]);
        else {
            $max_stock = obtenerStockProducto($id);
            $carrito[$id] = min($nueva_cantidad, $max_stock);
        }
    }
}

$_SESSION['carrito_ids'] = $carrito;
header('Location: carritoViewController.php');
exit;
