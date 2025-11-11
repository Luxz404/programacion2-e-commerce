<?php
session_start();

// Rutas corregidas: Sube 2 niveles para llegar a la raíz
include_once __DIR__ . "/../../conf/db.php"; 
include_once __DIR__ . "/../../model/usuarios.php"; // Archivo de funciones de usuario

// Asegúrate de que $conx esté definida en db.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // --- Validación y Sanitización Básica ---
    if (empty($nombre) || empty($email) || strlen($password) < 6) {
        // Redirigir de vuelta al formulario con error
        header("Location: ../../views/auth/registerView.php?error=empty_fields");
        exit;
    }
    
    // 1. Comprobar si el email ya existe
    if (existe_email($conx, $email)) {
        header("Location: ../../views/auth/registerView.php?error=email_exists");
        exit;
    }

    // 2. Hashear la contraseña (CRUCIAL)
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // 3. Registrar usuario
    if (registrar_usuario($conx, $nombre, $email, $password_hash)) {
        // Éxito: Redirigir al login
        header("Location: ../../controllers/auth/login.php?msg=success_register");
    } else {
        // Fallo en la BD
        header("Location: ../../views/auth/registerView.php?error=db_fail");
    }
    exit;

} else {
    // Si acceden a la URL directamente (GET), mostrar el formulario
    // La vista está en views/auth/
    require __DIR__ . '/../../views/auth/registerView.php';
}