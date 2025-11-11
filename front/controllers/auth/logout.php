<?php
// controllers/auth/logout.php

// 1. Iniciar la sesión (necesario para poder destruirla)
session_start();

// 2. Destruir todas las variables de sesión
$_SESSION = array();

// 3. Destruir la cookie de sesión del lado del cliente
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Destruir la sesión actual
session_destroy();

// 5. Redirigir al Login (usando la constante de ruta BASE_URL)
// ¡Asegúrate de que BASE_URL esté definida en conf/db.php!
include_once __DIR__ . "/../../conf/db.php"; 

header("Location: /../../views/auth/loginView.php?msg=logout_success");
exit;
?>