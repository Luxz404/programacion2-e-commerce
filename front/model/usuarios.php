<?php

function registrar_usuario($conx, $nombre, $email, $password_hash) {
    // Inserta un nuevo usuario con rol 'cliente' por defecto
    $query = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, 'cliente')";
    $stmt = $conx->prepare($query);
    return $stmt->execute([$nombre, $email, $password_hash]);
}

function existe_email($conx, $email) {
    // Verifica si el email ya existe en la base de datos
    $query = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
    $stmt = $conx->prepare($query);
    $stmt->execute([$email]);
    return $stmt->fetchColumn() > 0;
}

function obtener_usuario_por_email($conx, $email) {
    // Obtiene los datos del usuario para el login
    $query = "SELECT id, nombre, password, rol FROM usuarios WHERE email = ?";
    $stmt = $conx->prepare($query);
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}