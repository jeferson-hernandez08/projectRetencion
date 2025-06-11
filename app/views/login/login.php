<div class="login-container">
   <?php 
        if (isset($errors)) {
            echo "<div class='errors'>
                    $errors
                  </div>";
        }
    ?>
    <div class="content-wrapper">
        <div class="izquierda"></div>
        <div class="formulario">
            <div class="form-inner">
                <div class="logo">
                    <img src="/img/logoSenaProyect.png" alt="Logo SENA">
                </div>
                <div class="system-title">
                    <h2>Sistema de prevención<br><span class="subtitle-green">de la deserción</span></h2>
                </div>
                <h1 class="login-title">Ingreso usuarios registrados</h1>
                <form class="login-form" action="/login/init" method="post">
                    <div class="input-group">
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <input type="email" name="txtEmailUser" id="txtEmailUser" placeholder="Correo electrónico" required>
                    </div>
                    <div class="input-group">
                        <div class="icon"><i class="fas fa-lock"></i></div>
                        <input type="password" name="txtPasswordUser" id="txtPasswordUser" placeholder="Contraseña" required>
                    </div>
                    <button type="submit" class="login-button">Ingresar</button>
                </form>
                <div class="system-footer">
                    <p>Seguimiento y apoyo para aprendices</p>
                </div>
            </div>
        </div>
    </div>
</div>