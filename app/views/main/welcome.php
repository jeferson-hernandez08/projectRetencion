<link rel="stylesheet" href="/css/bienvenida.css">
<div class="contenedor-principal">
    <div class="contenido-caja">
        <div class="contenido-texto">
            <h1 class="titulo-principal">¡Bienvenido!</h1>
            
            <!-- Mensaje personalizado con rol -->
            <div class="rol-badge">
                <i class="fas fa-user-tag"></i>
                <span><?php echo $rolUsuario; ?></span>
            </div>
            
            <h2 class="subtitulo"><?php echo $nombreUsuario; ?></h2>
            
            <div class="mensaje-rol">
                <?php if($rolUsuario == 'Administrador'): ?>
                    <p>Como <strong>Administrador</strong>, tienes acceso completo al sistema para gestionar usuarios, roles y configuraciones.</p>
                <?php elseif($rolUsuario == 'Instructor'): ?>
                    <p>Como <strong>Instructor</strong>, puedes gestionar reportes, intervenciones y seguimiento de aprendices.</p>
                <?php elseif($rolUsuario == 'Coordinador'): ?>
                    <p>Como <strong>Coordinador</strong>, puedes administrar programas, grupos y seguimiento institucional.</p>
                <?php elseif($rolUsuario == 'Profesional Bienestar'): ?>
                    <p>Como <strong>Profesional de Bienestar</strong>, puedes gestionar categorías, causas y estrategias de intervención.</p>
                <?php elseif($rolUsuario == 'Vocero'): ?>
                    <p>Como <strong>Vocero</strong>, puedes reportar situaciones y hacer seguimiento a casos de aprendices.</p>
                <?php else: ?>
                    <p>Tu rol te permite acceder a funciones específicas del sistema de retención.</p>
                <?php endif; ?>
            </div>
            
            <p class="parrafo">
                ¡Bienvenido al Sistema de Retención Estudiantil SENA! Este espacio está diseñado para acompañarte en tu proceso de formación, brindándote el apoyo necesario para superar cualquier desafío que pueda afectar tu permanencia en la institución.
            </p>
            
            <div class="acciones-rapidas">
                <h3>Acciones rápidas:</h3>
                <div class="botones">
                    <?php if($rolUsuario == 'Administrador'): ?>
                        <a href="/usuario/view" class="btn-accion"><i class="fas fa-users"></i> Gestionar Usuarios</a>
                        <a href="/rol/view" class="btn-accion"><i class="fas fa-user-cog"></i> Administrar Roles</a>
                    <?php elseif($rolUsuario == 'Instructor'): ?>
                        <a href="/reporte/new" class="btn-accion"><i class="fas fa-flag"></i> Nuevo Reporte</a>
                        <a href="/aprendiz/view" class="btn-accion"><i class="fas fa-user-graduate"></i> Ver Aprendices</a>
                    <?php elseif($rolUsuario == 'Coordinador'): ?>
                        <a href="/programaFormacion/view" class="btn-accion"><i class="fas fa-chalkboard-teacher"></i> Programas</a>
                        <a href="/grupo/view" class="btn-accion"><i class="fas fa-graduation-cap"></i> Grupos</a>
                    <?php elseif($rolUsuario == 'Profesional Bienestar'): ?>
                        <a href="/causa/view" class="btn-accion"><i class="fas fa-question-circle"></i> Causas</a>
                        <a href="/estrategias/view" class="btn-accion"><i class="fas fa-lightbulb"></i> Estrategias</a>
                    <?php elseif($rolUsuario == 'Vocero'): ?>
                        <a href="/reporte/new" class="btn-accion"><i class="fas fa-flag"></i> Nuevo Reporte</a>
                        <a href="/aprendiz/view" class="btn-accion"><i class="fas fa-user-graduate"></i> Aprendices</a>
                    <?php endif; ?>
                    <a href="/reporte/view" class="btn-accion"><i class="fas fa-list"></i> Ver Reportes</a>
                </div>
            </div>
        </div>

        <!-- Elementos decorativos -->
        <div class="circulo verde1"></div>
        <div class="circulo verde2">
            <img src="/img/logoSenaWhite.png" alt="Logo Sena" class="logo">
        </div>
        <div class="circulo verde3"></div>
        
        <!-- Animación de bienvenida -->
        <div class="animacion-bienvenida">
            <div class="confeti"></div>
            <div class="confeti"></div>
            <div class="confeti"></div>
            <div class="confeti"></div>
            <div class="confeti"></div>
        </div>
    </div>
</div>