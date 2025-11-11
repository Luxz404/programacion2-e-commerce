<?php
// front/index.php

// 1. Inicia la sesión
session_start();

// 2. Inclusiones necesarias para que el catálogo funcione
include_once __DIR__ . "/conf/db.php";
include_once __DIR__ . "/model/plantas.php"; 
include_once __DIR__ . "/model/categorias.php"; 

// 3. Lógica para obtener datos (esto debería ir en un controlador, pero lo ponemos aquí por simplicidad)
$plantas = traer_plantas($conx);
$categorias = traer_categorias($conx);

// 4. MUESTRA EL CATÁLOGO SIEMPRE POR DEFECTO
require_once __DIR__ . "/views/catalogoView.php";

// ¡IMPORTANTE!
// La redirección del administrador (si está logueado) debe manejarse internamente
// en la vista (por ejemplo, mostrando el botón "Ir al Panel Admin")
// o debe haber ocurrido en el controlador de login, NO AQUÍ.
?>