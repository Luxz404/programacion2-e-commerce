<?php
// Código en front/controllers/crear.php

session_start();

// Rutas de inclusión
include_once __DIR__ . "/../conf/db.php"; 
include_once __DIR__ . "/../model/plantas.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Obtener datos
    $nombre = $_POST['nombre'] ?? '';
    $desc = $_POST['descripcion'] ?? '';
    $precio = $_POST['precio'] ?? 0.0;
    $stock = $_POST['stock'] ?? 0;
    $id_categoria = $_POST['id_categoria'] ?? null;
    
    $imagen_url = null; // Inicializamos la ruta de la imagen

    // 2. Procesar la subida de la imagen ($_FILES)
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        
        $file_tmp_path = $_FILES['imagen']['tmp_name'];
        $file_name = $_FILES['imagen']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // 🟢 DEFINICIÓN DE LA CARPETA DE DESTINO (Debe tener permisos 777)
        // La ruta DEBE apuntar a la carpeta assets/imgs/ dentro de front/
        $upload_dir = __DIR__ . "/../assets/imgs/"; 
        
        // Generar un nombre único para el archivo
        $new_file_name = uniqid('plant_') . '.' . $file_ext;
        $dest_path = $upload_dir . $new_file_name;

        // Intentar mover el archivo temporal
        if (move_uploaded_file($file_tmp_path, $dest_path)) {
            // ÉXITO: Guardamos la ruta que es accesible desde el navegador
            $imagen_url = "assets/imgs/" . $new_file_name; 
        } else {
            // FALLO: Error de permisos o de ruta. Redirigir y salir.
            header("Location: crearViewController.php?error=file_upload_fail");
            exit;
        }
    }
    
    // 3. Insertar datos en la BD
    $insertado = insertar_planta(
        $conx, 
        $nombre, 
        $desc, 
        floatval($precio), 
        intval($stock),
        intval($id_categoria),
        $imagen_url // PASAMOS LA RUTA GENERADA (o NULL si no se subió)
    );

    // 4. Redirigir
    if ($insertado) {
        header("Location: ../controllers/PlantasControllers.php?msg=create_ok");
    } else {
        header("Location: crearViewController.php?error=db_fail"); 
    }
    exit;
} else {
    // Si acceden directamente (GET), mostrar el formulario
    require __DIR__ . '/../views/crearView.php';
}