<?php

function traer_plantas($conx){
    $query = "SELECT P.id AS id, P.nombre AS planta_nombre, P.descripcion AS planta_desc, P.precio AS planta_precio,
    P.stock AS planta_stock, C.nombre AS categoria 
    FROM plantas P 
    INNER JOIN categorias C ON (P.id_categoria = C.id)";
    $stmt = $conx->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function obtener_planta_por_id($conx, $id) {
    try {
        $query = "SELECT id, nombre, precio, stock, imagen_url FROM plantas WHERE id = :id";
        $stmt = $conx->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error obtener_planta_por_id: " . $e->getMessage());
        return null;
    }
}

function obtenerProductosPorListaDeIds($product_ids) {
    global $conx;
    if (empty($product_ids)) return [];

    // placeholders
    $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
    $sql = "
        SELECT p.id, p.nombre, p.precio, p.stock, p.imagen_url,
               c.nombre AS nombre_categoria
        FROM plantas p
        LEFT JOIN categorias c ON p.id_categoria = c.id
        WHERE p.id IN ({$placeholders})
    ";
    $stmt = $conx->prepare($sql);
    $stmt->execute(array_values($product_ids));
    $productos = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $productos[(int)$row['id']] = $row;
    }
    return $productos;
}

function obtenerStockProducto($id) {
    global $conx;
    try {
        $stmt = $conx->prepare("SELECT stock FROM plantas WHERE id = :id_producto");
        $stmt->bindParam(':id_producto', $id, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res && isset($res['stock'])) return (int)$res['stock'];
    } catch (PDOException $e) {
        error_log("Error al obtener stock del producto ID {$id}: " . $e->getMessage());
    }
    return 0; // mejor 0 que un número mágico
}


// Asegúrate de que tu función traer_plantas() también esté en este archivo.
/*function obtener_planta_por_id($conx, $id) {
    try {
        $stmt = $conx->prepare("SELECT 
            id, 
            nombre AS planta_nombre, 
            precio AS planta_precio, 
            stock AS planta_stock, 
            imagen_url 
            FROM plantas 
            WHERE id = :id");
            
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Devolvemos el objeto, que contendrá los datos si se encuentra
        return $stmt->fetch(PDO::FETCH_OBJ); 
        
    } catch (PDOException $e) {
        // En un entorno de desarrollo, muestra el error de SQL para diagnosticar:
        // die("Error SQL al obtener planta: " . $e->getMessage()); 
        return null;
    }
}
*/
function actualizar_planta($conx, $id, $nombre, $desc, $precio, $stock) {
    $query = "UPDATE plantas 
              SET nombre = ?, descripcion = ?, precio = ?, stock = ? 
              WHERE id = ?";
    $stmt = $conx->prepare($query);
    // Bindear los parámetros en el orden de los signos de interrogación
    return $stmt->execute([$nombre, $desc, $precio, $stock, $id]); 
}

function eliminar_planta($conx, $id) {
    // Consulta preparada para borrar por ID. ¡Es crucial por seguridad!
    $query = "DELETE FROM plantas WHERE id = ?";
    $stmt = $conx->prepare($query);
    return $stmt->execute([$id]); 
}

function insertar_planta($conx, $nombre, $descripcion, $precio, $stock, $id_categoria, $imagen_url = null) {
    // La consulta INSERT debe incluir el nuevo campo 'imagen_url'
    $query = "INSERT INTO plantas (nombre, descripcion, precio, stock, id_categoria, imagen_url) 
              VALUES (?, ?, ?, ?, ?, ?)";
              
    $stmt = $conx->prepare($query);
    
    // El orden de los parámetros es CRUCIAL y debe coincidir con la consulta
    return $stmt->execute([$nombre, $descripcion, $precio, $stock, $id_categoria, $imagen_url]); 
}

// Nota: Necesitamos una función simple para traer TODAS las categorías
function traer_categorias($conx){
    $query = "SELECT id, nombre FROM categorias ORDER BY nombre ASC";
    $stmt = $conx->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}