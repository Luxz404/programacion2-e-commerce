<?php
// controllers/auth/login.php

// 1. INICIAR LA SESIÓN
session_start();

// 2. INCLUIR DEPENDENCIAS
// Rutas de inclusión: Sube 2 niveles para llegar a la raíz (front/)
include_once __DIR__ . "/../../conf/db.php"; 
include_once __DIR__ . "/../../model/usuarios.php";; 

// Asumimos que $conx está definida en db.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // --- Lógica de Verificación ---
    $usuario = obtener_usuario_por_email($conx, $email);

    // 2. Verificar existencia del usuario Y la contraseña hasheada
    if ($usuario && password_verify($password, $usuario->password)) {
        
        // --- LOGIN EXITOSO ---
        
        // 3. CREAR VARIABLES DE SESIÓN 
        $_SESSION['user_id'] = $usuario->id;
        $_SESSION['user_name'] = $usuario->nombre;
        $_SESSION['user_rol'] = $usuario->rol;
        
        // 4. REDIRECCIÓN SIMPLIFICADA
        // Todos los roles redirigen al verificador principal (index.php)
        // La ruta absoluta '/index.php' funciona desde cualquier parte del Host Virtual
        header("Location: /index.php"); 
        exit;
        
    } else {
        // --- FALLO EN EL LOGIN ---
        // Redirigir de vuelta al formulario de login con un error
        // Ruta corregida: Sube de controllers/auth/ y entra en views/auth/
        header("Location: ../../views/auth/loginView.php?error=invalid_credentials");
        exit;
    }

} else {
    // Si acceden a la URL directamente (GET), mostrar el formulario
    // Ruta corregida: Sube de controllers/auth/ y entra en views/auth/
    require __DIR__ . '/../../views/auth/loginView.php';
}