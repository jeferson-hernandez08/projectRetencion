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
                    <p>Como <strong>Administrador</strong>, tienes acceso completo al sistema para gestionar roles y usuarios.</p>
                <?php elseif($rolUsuario == 'Instructor'): ?>
                    <p>Como <strong>Instructor</strong>, puedes hacer seguimiento a casos de aprendices y reportar situaciones de los aprendices.</p>
                <?php elseif($rolUsuario == 'Coordinador'): ?>
                    <p>Como <strong>Coordinador</strong>, puedes administrar programas, grupos, aprendices, gestionar categorías, causas, estrategias de intervención, realizar reportes, intervenciones, gestion de usuarios y seguimiento institucional.</p>
                <?php elseif($rolUsuario == 'Profesional de Bienestar'): ?>
                    <p>Como <strong>Profesional de Bienestar</strong>, puedes administrar programas, grupos, aprendices, gestionar categorías, causas, estrategias de intervención, realizar reportes, intervenciones, gestion de usuarios y seguimiento institucional.</p>
                <?php elseif($rolUsuario == 'Aprendiz Vocero'): ?>
                    <p>Como <strong>Vocero</strong>, puedes hacer seguimiento a casos de aprendices y reportar situaciones de los aprendices. </p>
                <?php else: ?>
                    <p>Como <strong><?php echo $rolUsuario; ?></strong>, tienes acceso a funciones específicas del sistema de retención estudiantil.</p>
                <?php endif; ?>
            </div>
            
            <p class="parrafo">
                ¡Bienvenido al Sistema de Retención Estudiantil SENA! Este espacio está diseñado para acompañarte en tu proceso de formación, brindándote el apoyo necesario para superar cualquier desafío que pueda afectar tu permanencia en la institución.
            </p>
            
            <div class="acciones-rapidas">
                <h3>Acciones rápidas:</h3>
                <div class="botones">
                    <?php if($rolUsuario == 'Administrador'): ?>
                        <a href="/rol/view" class="btn-accion"><i class="fas fa-user-cog"></i> Administrar Roles</a>
                        <a href="/usuario/view" class="btn-accion"><i class="fas fa-users"></i> Gestionar Usuarios</a>
                    <?php elseif($rolUsuario == 'Instructor'): ?>
                        <a href="/aprendiz/view" class="btn-accion"><i class="fas fa-user-graduate"></i> Ver Aprendices</a>
                        <a href="/reporte/new" class="btn-accion"><i class="fas fa-chart-line"></i> Nuevo Reporte</a>
                    <?php elseif($rolUsuario == 'Coordinador'): ?>
                        <a href="/programaFormacion/view" class="btn-accion"><i class="fas fa-chalkboard-teacher"></i> Programas</a>
                        <a href="/grupo/view" class="btn-accion"><i class="fas fa-graduation-cap"></i> Grupos</a>
                        <a href="/aprendiz/new" class="btn-accion"><i class="fas fa-user-graduate"></i> Crear Aprendices</a>
                        <a href="/categoria/new" class="btn-accion"><i class="fas fa-tags"></i> Nueva Categoria</a>
                        <a href="/causa/new" class="btn-accion"><i class="fas fa-question-circle"></i> Nueva Causa</a>
                        <a href="/estrategias/new" class="btn-accion"><i class="fas fa-lightbulb"></i> Nueva Estrategia</a>
                        <a href="/reporte/view" class="btn-accion"><i class="fas fa-chart-line"></i> Ver Reportes</a>
                        <a href="/intervencion/new" class="btn-accion"><i class="fas fa-hand-holding-heart"></i> Nueva Intervención</a>
                        <a href="/usuario/view" class="btn-accion"><i class="fas fa-users"></i> Gestionar Usuarios</a>
                    <?php elseif($rolUsuario == 'Profesional de Bienestar'): ?>
                        <a href="/programaFormacion/view" class="btn-accion"><i class="fas fa-chalkboard-teacher"></i> Ver Programas</a>
                        <a href="/grupo/view" class="btn-accion"><i class="fas fa-graduation-cap"></i> Ver Grupos</a>
                        <a href="/aprendiz/new" class="btn-accion"><i class="fas fa-user-graduate"></i> Crear Aprendices</a>
                        <a href="/categoria/new" class="btn-accion"><i class="fas fa-tags"></i> Nueva Categoria</a>
                        <a href="/causa/new" class="btn-accion"><i class="fas fa-question-circle"></i> Nueva Causa</a>
                        <a href="/estrategias/new" class="btn-accion"><i class="fas fa-lightbulb"></i> Nueva Estrategia</a>
                        <a href="/reporte/view" class="btn-accion"><i class="fas fa-chart-line"></i> Ver Reportes</a>
                        <a href="/intervencion/new" class="btn-accion"><i class="fas fa-hand-holding-heart"></i> Nueva Intervención</a>
                        <a href="/usuario/view" class="btn-accion"><i class="fas fa-users"></i> Gestionar Usuarios</a>
                    <?php elseif($rolUsuario == 'Aprendiz Vocero'): ?>
                        <a href="/reporte/new" class="btn-accion"><i class="fas fa-flag"></i> Nuevo Reporte</a>
                        <a href="/aprendiz/view" class="btn-accion"><i class="fas fa-user-graduate"></i> Aprendices</a>
                    <?php endif; ?>
                    <!-- <a href="/reporte/view" class="btn-accion"><i class="fas fa-list"></i> Ver Reportes</a> -->
                </div>
            </div>
        </div>

        <!-- Elementos decorativos -->
        <div class="circulo verde1"></div>
        <div class="circulo verde2">
            <img src="/img/logoSenaWhite.png" alt="Logo Sena" class="logo-sena-bienvenida">
        </div>
        <div class="circulo verde3"></div>
        <div class="circulo verde4"></div>
        <div class="circulo verde5"></div>
        <div class="circulo verde6"></div>
        <div class="circulo verde7"></div>
        
        <!-- Animación de bienvenida -->
        <div class="animacion-bienvenida">
            <!-- Los confetis se generan dinámicamente con JS -->
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const animacion = document.querySelector('.animacion-bienvenida');
        
        // Paleta de colores vibrantes
            const colores = [
                '#FF5252', // Rojo vibrante
                '#4CAF50', // Verde SENA
                '#2196F3', // Azul brillante
                '#FFD600', // Amarillo vibrante
                '#9C27B0', // Morado
                '#FF9800', // Naranja
                '#00BCD4', // Turquesa
                '#E91E63'  // Rosa
            ];
        
        // Crear 15 confetis
        for (let i = 0; i < 25; i++) {
            const confeti = document.createElement('div');

            confeti.classList.add('confeti');
            confeti.style.left = Math.random() * 100 + '%';
            confeti.style.background = colores[Math.floor(Math.random() * colores.length)];
            confeti.style.animationDelay = Math.random() * 5 + 's';
            confeti.style.animationDuration = (Math.random() * 5 + 5) + 's';

            // Rotación aleatoria inicial efecto de confetis arriba
            confeti.style.transform = `rotate(${Math.random() * 360}deg)`;

            animacion.appendChild(confeti);
        }
    });
</script>