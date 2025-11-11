<?php
include_once __DIR__ . "/../conf/db.php";
include_once __DIR__ . "/../model/plantas.php"; 
session_start();

// ... incluye tu modelo de usuarios y plantas

// --- GUARDAIL DE ADMINISTRADOR ---
// Verifica que hay sesión y que el rol es 'admin'
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
    // Redirige al login si no es admin
    header("Location:  views/auth/loginView.php"); 
    exit;
}

function mostrar_plantas($conx) {
    $plantas = traer_plantas($conx);
    require __DIR__ . '/../views/plantasviews.php';
}

mostrar_plantas($conx);

