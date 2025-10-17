<div class="login-container">
    <div class="content-wrapper">
        <div class="izquierda"></div>
        <div class="formulario">
            <div class="form-inner">
                <div class="logo">
                    <img src="/img/logoSenaProyect8.png" alt="Logo SENA">
                </div>
                <div class="system-title">
                    <h2>Sistema de prevención<br><span class="subtitle-green">de la deserción</span></h2>
                </div>
                
                <h1 class="login-title">Recuperar Contraseña</h1>
                <p class="login-subtitle">Ingresa tu correo institucional y documento para restablecer tu acceso.</p>

                <?php 
                if (isset($errors)) {
                    echo "<div class='errors'>
                            $errors
                          </div>";
                }
                ?>

                <form class="login-form" action="/recuperarPassword/procesar" method="post">
                    <div class="input-group">
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <input type="email" name="txtEmail" id="txtEmail" placeholder="Email Institucional" required 
                               value="<?php echo isset($_POST['txtEmail']) ? htmlspecialchars($_POST['txtEmail']) : ''; ?>">
                    </div>
                    
                    <div class="input-group">
                        <div class="icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <input type="text" name="txtDocumento" id="txtDocumento" placeholder="Número de documento" required
                               value="<?php echo isset($_POST['txtDocumento']) ? htmlspecialchars($_POST['txtDocumento']) : ''; ?>">
                    </div>
                    
                    <button type="submit" class="login-button">RECUPERAR CONTRASEÑA</button>
                </form>

                <div class="links">
                    <a href="/login/init" class="back-link">
                        <i class="fas fa-arrow-left"></i> Volver al Login
                    </a>
                </div>

                <div class="system-footer">
                    <p>Seguimiento y apoyo para aprendices</p>
                </div>
            </div>
        </div>
    </div>
</div>