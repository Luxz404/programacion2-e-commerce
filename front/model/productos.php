
<?php
function obtenerTodosLosProductos($search_term = '', $category_id = 0) {
    global $conx;
    
    $sql = "SELECT p.id, p.nombre, p.precio, p.stock, p.imagen_url, 
                   c.nombre AS nombre_categoria 
            FROM productos p 
            LEFT JOIN categorias c ON (p.id_categoria = c.id) 
            WHERE 1=1 ";
    
    $params = [];

    // Filtro por Nombre/Término de Búsqueda
    if (!empty($search_term)) {
        $sql .= " AND p.nombre LIKE :search_term";
        $params[':search_term'] = '%' . $search_term . '%';
    }
    
    // Filtro por Categoría
    if ($category_id > 0) {
        $sql .= " AND p.id_categoria = :category_id";
        $params[':category_id'] = $category_id;
    }
    
    $sql .= " ORDER BY p.nombre ASC";
    
    $stmt = $conx->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function traer_categorias($conx){
    $query = "SELECT id, nombre FROM categorias ORDER BY nombre ASC";
    $stmt = $conx->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
