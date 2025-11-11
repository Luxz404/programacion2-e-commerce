<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - E-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
            <h2 class="card-title text-center mb-4">Iniciar Sesión</h2>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">Credenciales inválidas. Intente de nuevo.</div>
            <?php endif; ?>
            <?php if (isset($_GET['msg']) && $_GET['msg'] == 'success_register'): ?>
                <div class="alert alert-success">Registro exitoso. ¡Inicia sesión!</div>
            <?php endif; ?>

            <form method="POST" action="../../controllers/auth/login.php">
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 mb-3">Entrar</button>
            </form>
            
            <p class="text-center">
                ¿No tienes cuenta? <a href="../../controllers/auth/register.php">Regístrate aquí</a>
            </p>
        </div>
    </div>
</body>
</html>