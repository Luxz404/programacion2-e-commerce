<?php
// crearViewController.php
include_once __DIR__ . "/../conf/db.php"; 
include_once __DIR__ . "/../model/plantas.php";  

// 1. Obtener la lista de categorías para el dropdown
$categorias = traer_categorias($conx);

// 2. Cargar la vista
require __DIR__ . '/../views/crearView.php';
?>