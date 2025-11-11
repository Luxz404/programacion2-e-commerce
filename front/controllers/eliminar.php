<?php
// eliminar.php
include_once __DIR__ . "/../conf/db.php"; 
include_once __DIR__ . "/../model/plantas.php"; 

// 1. Obtener ID de la URL
$id = $_GET['id'] ?? null; 

if ($id && is_numeric($id)) {
    // 2. Ejecutar la función de eliminación
    $eliminado = eliminar_planta($conx, intval($id));
    
    // 3. Redireccionar con un mensaje
    if ($eliminado) {
        header("Location: PlantasControllers.php?msg=planta_eliminada");
    } else {
        // Fallo: Por ejemplo, si hay una clave foránea (la planta está en un pedido)
        header("Location: PlantasControllers.php?msg=delete_fail");
    }
} else {
    // ID no válido
    header("Location: PlantasControllers.php");
}
exit;
?>