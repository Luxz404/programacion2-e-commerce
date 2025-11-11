<?php
// 1. Incluir dependencias: Conexión a la BD y funciones del Modelo
include_once __DIR__ . "/../conf/db.php"; 
include_once __DIR__ . "/../model/plantas.php"; 

// Asegúrate de que $conx esté definida en db.php

// Verificar que los datos se enviaron por el método POST (esencial)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 2. Obtener el ID de la URL (GET) y los datos del formulario (POST)
    $id = $_GET['id'] ?? null; // Si no hay ID, será null
    
    // Obtener los datos sin usar filtros avanzados (como haría un principiante)
    // NOTA: En un proyecto real, ¡usar filtros avanzados es mejor!
    $nombre = $_POST['nombre'] ?? '';
    $desc = $_POST['descripcion'] ?? '';
    $precio = $_POST['precio'] ?? 0.0;
    $stock = $_POST['stock'] ?? 0;
    
    // 4. Ejecutar la función de actualización del modelo
    // Usamos intval y floatval para asegurar el tipo de dato, aunque POST los trae como string.
    $actualizado = actualizar_planta(
        $conx, 
        intval($id), 
        $nombre, 
        $desc, 
        floatval($precio), 
        intval($stock)
    );

    // 5. Redireccionar según el resultado
    if ($actualizado) {
        // Éxito: Volver al listado principal con un mensaje (opcional)
        header("Location: PlantasControllers.php?msg=edit_ok");
    } else {
        // Fallo: Volver a la edición con un error (simple)
        // La forma más simple es redirigir a la vista de edición para que el usuario sepa que algo falló.
        header("Location: editarViewController.php?id=" . $id . "&error=db_fail"); 
    }
    
    exit;

} else {
    // Si acceden a este archivo sin enviar el formulario (directamente por URL GET)
    header("Location: PlantasControllers.php");
    exit;
}
?>