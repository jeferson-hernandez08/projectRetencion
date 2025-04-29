<!-- <div class="login-container">
    <?php 
        if (isset($errors)) {
            echo "<div class='errors'>
                    $errors
                  </div>";
        }
    ?>
    <h2>Iniciar sesión</h2>
    <form action="/login/init" method="post">
        <div class="input-group">
            <label for="txtUser">Email</label>
            <input type="text" name="txtUser" id="txtUser" required>
        </div>
        <div class="input-group">
            <label for="txtPassword">Contraseña</label>
            <input type="password" name="txtPassword" id="txtPassword" required>
        </div>
        <button type="submit">Ingresar</button>
    </form>
</div> -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENA - Sistema de prevención de la deserción</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <div class="right-panel">
        <!-- Contenedor flex para organizar izquierda y formulario -->
        <div class="content-wrapper">
            <!-- Sección izquierda -->
            <div class="izquierda">
                <div class="logo">
                    <img src="/img/logoSenaVerde.png" alt="Logo SENA">
                </div>
                <div class="system-title">
                    <h2>Sistema de prevención de<br>la deserción</h2>
                </div>
                <div class="sena-title">
                    SENA
                </div>
                <div class="system-footer">
                    <p>Seguimiento y apoyo para aprendices</p>
                </div>
            </div>

            <!-- Sección derecha (formulario) -->
            <div class="formulario">
                <h1 class="login-title">INGRESO USUARIOS REGISTRADOS</h1>
                <form class="login-form" action="/login/init" method="post">
                    <div class="input-group">
                        <div class="icon"></div>
                        <input type="email" id="email" name="email" placeholder="Correo electronico" required>
                    </div>
                    <div class="input-group">
                        <div class="icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input type="password" id="password" name="password" placeholder="Contraseña" required>
                    </div>
                    <a href="/forgot-password" class="forgot-password">
                        <i class="fas fa-key"></i>
                        olvidé mi contraseña
                    </a>
                    <button type="submit" class="login-button">Ingresar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>