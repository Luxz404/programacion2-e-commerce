<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario - E-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
            <h2 class="card-title text-center mb-4">Crear Nueva Cuenta</h2>

             <?php 
             // Mostrar mensajes de error si existen
             if (isset($_GET['error'])): ?>
                <?php if ($_GET['error'] == 'email_exists'): ?>
                    <div class="alert alert-warning">Ese email ya está registrado. Intente con otro.</div>
                <?php elseif ($_GET['error'] == 'empty_fields'): ?>
                    <div class="alert alert-danger">Por favor, rellene todos los campos.</div>
                <?php elseif ($_GET['error'] == 'db_fail'): ?>
                    <div class="alert alert-danger">Hubo un error al registrarse. Intente más tarde.</div>
                <?php endif; ?>
            <?php endif; ?>

            <form method="POST" action="../../controllers/auth/register.php">
                
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required minlength="6">
                    <small class="form-text text-muted">Mínimo 6 caracteres.</small>
                </div>
                
                <button type="submit" class="btn btn-success w-100 mb-3">Registrarse</button>
            </form>

            <p class="text-center">
                ¿Ya tienes cuenta? <a href="../../controllers/auth/login.php">Iniciar Sesión aquí</a>
            </p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>