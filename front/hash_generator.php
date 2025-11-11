<?php
$password_plana = 'admin123';
$hash_generado = password_hash($password_plana, PASSWORD_DEFAULT);
echo "Contraseña: " . $password_plana . "<br>";
echo "Hash para insertar: " . $hash_generado;
// EJEMPLO DE SALIDA: Hash para insertar: $2y$10$wT0nC... (una cadena larga)
?>