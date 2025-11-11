<?php
// editarViewController.php (Ubicado en controllers/admin/)

// 1. Ajustar la ruta para salir de 'admin' y de 'controllers'
// Ruta corregida: Sube 2 niveles para llegar a la raíz (front/)
include_once __DIR__ . "/../conf/db.php"; 
include_once __DIR__ . "/../model/plantas.php"; 
// Asegúrate de que $conx esté definida en db.php

// El resto de la lógica de tu controlador...

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // El error Fatal (Call to undefined function) se soluciona aquí:
    // La función ya podrá ser llamada porque el archivo 'plantas.php' estará incluido.
    $planta = traer_planta_por_id($conx, $id);

    if (!$planta) {
        header("Location: PlantasControllers.php"); 
        exit;
    }
    
    // NOTA: Revisa que la ruta a tu vista también sea correcta si la moviste
    // Si la vista está en views/admin/, la ruta debe ser:
    require __DIR__ . '/../views/editarView.php'; 

} else {
    // Manejar el error...
    header("Location: PlantasControllers.php"); 
    exit;
}
?>