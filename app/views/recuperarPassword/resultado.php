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

                <?php if (isset($success) && $success): ?>
                    <h1 class="login-title">¡Contraseña Restablecida!</h1>
                    
                    <div class="success-message">
                        <div class="success-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <p>Su contraseña ha sido restablecida exitosamente.</p>
                        
                        <div class="password-display">
                            <p><strong>Su nueva contraseña es:</strong></p>
                            <div class="password-box">
                                <code><?php echo htmlspecialchars($nuevaPassword); ?></code>
                                <button class="copy-btn" onclick="copiarPassword()">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="security-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <p>Por seguridad, se recomienda cambiar esta contraseña después de iniciar sesión.</p>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <a href="/login/init" class="login-button">
                            <i class="fas fa-sign-in-alt"></i> Ir al Login
                        </a>
                    </div>

                <?php else: ?>
                    <h1 class="login-title">Error en la Recuperación</h1>
                    
                    <div class="error-message">
                        <div class="error-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <p><?php echo $errors; ?></p>
                    </div>

                    <div class="action-buttons">
                        <a href="/recuperarPassword" class="login-button">
                            <i class="fas fa-redo"></i> Intentar Nuevamente
                        </a>
                        <a href="/login/init" class="back-link">
                            <i class="fas fa-arrow-left"></i> Volver al Login
                        </a>
                    </div>
                <?php endif; ?>

                <div class="system-footer">
                    <p>Seguimiento y apoyo para aprendices</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copiarPassword() {
    const password = '<?php echo $nuevaPassword; ?>';
    navigator.clipboard.writeText(password).then(function() {
        // Mostrar mensaje de copiado
        const btn = document.querySelector('.copy-btn');
        btn.innerHTML = '<i class="fas fa-check"></i>';
        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-copy"></i>';
        }, 2000);
    });
}
</script>