<div class="login-container">

    <?php 
        if (isset($errors)) {
            echo "<div class='errors'>
                    $errors
                  </div>";
        }
    ?>
    <!-- Contenedor flex para organizar izquierda y formulario -->
    <div class="content-wrapper">
        <!-- Sección izquierda -->
        <div class="izquierda">
            <div class="logo">
                <img src="/img/logoSenaGreen.png" alt="Logo SENA">
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
                    <div class="icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <input type="email"  name="txtEmailUser" id="txtEmailUser" placeholder="Correo electronico" required>
                </div>
                <div class="input-group">
                    <div class="icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input type="password" name="txtPasswordUser" id="txtPasswordUser" placeholder="Contraseña" required>
                </div>
                <a href="/forgot-password" class="forgot-password">
                    <i class="fas fa-key"></i>
                    Olvidé mi contraseña ?
                </a>
                <button type="submit" class="login-button">Ingresar</button>
            </form>
        </div>
    </div>
</div>