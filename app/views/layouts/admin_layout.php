<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $title ?> </title>
    <link rel="shortcut icon" href="/img/logoSenaGreen.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/styles_admin_layout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Estilos del buscador para tema claro */
        .header-search-reportes .search-wrapper-reportes {
            background-color: #f5f5f5;
            border: 1px solid #e0e0e0;
            border-radius: 25px;
        }

        .header-search-reportes .search-input-reportes {
            background-color: transparent;
            color: #333;
        }

        .header-search-reportes .search-input-reportes::placeholder {
            color: #999;
        }

        .header-search-reportes .search-icon-reportes {
            color: #666;
        }

        .header-search-reportes .clear-btn-reportes {
            color: #666;
        }

        .header-search-reportes .clear-btn-reportes:hover {
            color: #333;
            background-color: #e0e0e0;
        }

        /* Estilos del buscador para tema oscuro - mantener como está */
        body.dark-mode .header-search-reportes .search-wrapper-reportes {
            background-color: #2d3748;
            border: 1px solid #4a5568;
            border-radius: 25px;
        }

        body.dark-mode .header-search-reportes .search-input-reportes {
            background-color: transparent;
            color: #e2e8f0;
        }

        body.dark-mode .header-search-reportes .search-input-reportes::placeholder {
            color: #a0aec0;
        }

        body.dark-mode .header-search-reportes .search-icon-reportes {
            color: #cbd5e0;
        }

        body.dark-mode .header-search-reportes .clear-btn-reportes {
            color: #cbd5e0;
        }

        body.dark-mode .header-search-reportes .clear-btn-reportes:hover {
            color: #e2e8f0;
            background-color: #4a5568;
        }
    </style>
</head>

<body>
    <div class="container">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-content">
                <div class="logo">
                    <img src="/img/logoSenaProyect7.png" alt="logoImg">
                </div>
                <nav class="menu">
                    <ul>
                        <li><a href="/main"><i class="fas fa-home"></i><span class="info-text">Inicio</span></a></li>
                        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 2): ?>  <!-- Instructor -->
                            <li><a href="/aprendiz/view"><i class="fas fa-user-graduate"></i><span class="info-text">Aprendices</span></a></li>
                            <li><a href="/reporte/view"><i class="fas fa-chart-line"></i><span class="info-text">Reportes</span></a></li> 
                        <?php endif ?>   
                        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 3): ?>  <!-- Coordinador Academico  -->
                            <li><a href="/programaFormacion/view"><i class="fas fa-chalkboard-teacher"></i><span class="info-text">Programas</span></a></li>
                            <li><a href="/grupo/view"><i class="fas fa-graduation-cap"></i><span class="info-text">Grupos</span></a></li>
                            <li><a href="/aprendiz/view"><i class="fas fa-user-graduate"></i><span class="info-text">Aprendices</span></a></li>
                            <li><a href="/usuario/view"><i class="fas fa-users"></i><span class="info-text">Usuarios</span></a></li> 
                            <li><a href="/categoria/view"><i class="fas fa-tags"></i><span class="info-text">Categorias</span></a></li>
                            <li><a href="/causa/view"><i class="fas fa-question-circle"></i><span class="info-text">Causas</span></a></li>
                            <li><a href="/estrategias/view"><i class="fas fa-lightbulb"></i><span class="info-text">Estrategias</span></a></li>
                            <li><a href="/reporte/view"><i class="fas fa-chart-line"></i><span class="info-text">Reportes</span></a></li>
                            <li><a href="/intervencion/view"><i class="fas fa-hand-holding-heart"></i><span class="info-text">Intervenciones</span></a></li>
                        <?php endif ?>
                        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 4): ?>  <!-- Coordinador de Formacion (Profesional de Bienestar) -->
                            <li><a href="/programaFormacion/view"><i class="fas fa-chalkboard-teacher"></i><span class="info-text">Programas</span></a></li>
                            <li><a href="/grupo/view"><i class="fas fa-graduation-cap"></i><span class="info-text">Grupos</span></a></li>
                            <li><a href="/aprendiz/view"><i class="fas fa-user-graduate"></i><span class="info-text">Aprendices</span></a></li>
                            <li><a href="/usuario/view"><i class="fas fa-users"></i><span class="info-text">Usuarios</span></a></li> 
                            <li><a href="/categoria/view"><i class="fas fa-tags"></i><span class="info-text">Categorias</span></a></li>
                            <li><a href="/causa/view"><i class="fas fa-question-circle"></i><span class="info-text">Causas</span></a></li>
                            <li><a href="/estrategias/view"><i class="fas fa-lightbulb"></i><span class="info-text">Estrategias</span></a></li>
                            <li><a href="/reporte/view"><i class="fas fa-chart-line"></i><span class="info-text">Reportes</span></a></li>
                            <li><a href="/intervencion/view"><i class="fas fa-hand-holding-heart"></i><span class="info-text">Intervenciones</span></a></li>
                        <?php endif ?>
                        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 5): ?>  <!-- Vocero -->
                            <li><a href="/aprendiz/view"><i class="fas fa-user-graduate"></i><span class="info-text">Aprendices</span></a></li>
                            <li><a href="/reporte/view"><i class="fas fa-chart-line"></i><span class="info-text">Reportes</span></a></li>
                        <?php endif ?>
                        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 1): ?>  <!-- Administrador -->
                            <li><a href="/rol/view"><i class="fas fa-users-cog"></i><span class="info-text">Roles</span></a></li>
                            <li><a href="/usuario/view"><i class="fas fa-users"></i><span class="info-text">Usuarios</span></a></li>
                        <?php endif ?>
                        <?php if(isset($_SESSION['nombre'])) {  ?> 
                            <li>
                                <a href="/login/logout">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span class="info-text">Cerrar sesión (<?php echo $_SESSION['nombre'] ?? "";?>)</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </aside>
        <main class="main-content">
            <header class="header">
                <div class="header-container">
                    <button class="menu-toggle" id="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1> <?php echo $title ?> </h1>
                    
                    <div class="header-search-reportes" id="header-search-reportes">
                        <div class="search-wrapper-reportes">
                            <i class="fas fa-search search-icon-reportes"></i>
                            <input type="text" id="searchAprendizHeader" placeholder="Buscar aprendiz..." class="search-input-reportes">
                            <button id="clearSearchHeader" class="clear-btn-reportes">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="header-icons">
                        <div class="user-dropdown">
                            <a href="#" class="icon-link" id="user-menu-toggle">
                                <i class="fas fa-user-circle"></i>
                            </a>
                            <div class="dropdown-content" id="user-dropdown-content">
                                <div class="dropdown-header">
                                    <i class="fas user-card fa-user-circle"></i>
                                    <h3><?php echo $rolUsuario; ?></h3>
                                    <p><?php echo $nombreUsuario; ?></p>
                                </div>
                                <div class="dropdown-body">
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-user"></i> Mi Perfil
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-cog"></i> Configuración
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-question-circle"></i> Ayuda
                                    </a>
                                </div>
                                <div class="dropdown-footer">
                                    <a href="/login/logout" class="logout-btn">
                                        <span class="info-text">Cerrar sesión</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <a href="#" class="icon-link" id="theme-toggle-link" onclick="toggleDarkMode(); return false;"><i class="fas fa-moon"></i></a>
                    </div>
                </div>
            </header>

            <div class="notificaciones-container" id="notificaciones-container">
                <div class="notificaciones-header">
                    <h3>Notificaciones</h3>
                    <a href="#" id="marcar-todas-leidas">Marcar todas como leídas</a>
                </div>
                <div class="notificaciones-body" id="notificaciones-body">
                </div>
                <div class="notificaciones-footer">
                    <a href="#">Ver todas las notificaciones</a>
                </div>
            </div>

            <div class="content">
                <?php include_once $content; ?>
            </div>
        </main>
    </div>
    
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section footer-logo-container">
                <div class="footer-logo">
                    <img src="/img/logoProyect2.png" alt="Logo RetencionCPIC">
                </div>
                <p>Sistema integral para mejorar la retención de aprendices en el Centro de Procesos Industriales y Construcción (CPIC) del SENA.</p>
                <div class="footer-social">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Enlaces Rápidos</h3>
                <ul class="footer-links">
                    <li><a href="/main"><i class="fas fa-home"></i> Inicio</a></li>
                    <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 2): ?>
                        <li><a href="/aprendiz/view"><i class="fas fa-user-graduate"></i> Aprendices</a></li>
                        <li><a href="/reporte/view"><i class="fas fa-chart-line"></i> Reportes</a></li>       
                    <?php endif ?>
                    <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 3): ?>
                        <li><a href="/programaFormacion/view"><i class="fas fa-chalkboard-teacher"></i> Programas</a></li>
                        <li><a href="/grupo/view"><i class="fas fa-graduation-cap"></i> Grupos</a></li>
                        <li><a href="/aprendiz/view"><i class="fas fa-user-graduate"></i> Aprendices</a></li>
                        <li><a href="/categoria/view"><i class="fas fa-tags"></i> Categorias</a></li>
                        <li><a href="/causa/view"><i class="fas fa-question-circle"></i> Causas</a></li>
                        <li><a href="/estrategias/view"><i class="fas fa-lightbulb"></i> Estrategias</a></li>
                        <li><a href="/reporte/view"><i class="fas fa-chart-line"></i> Reportes</a></li>
                        <li><a href="/intervencion/view"><i class="fas fa-hand-holding-heart"></i> Intervenciones</a></li>
                        <li><a href="/usuario/view"><i class="fas fa-users"></i> Usuarios</a></li> 
                    <?php endif ?>
                    <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 4): ?>
                        <li><a href="/programaFormacion/view"><i class="fas fa-chalkboard-teacher"></i> Programas</a></li>
                        <li><a href="/grupo/view"><i class="fas fa-graduation-cap"></i> Grupos</a></li>
                        <li><a href="/aprendiz/view"><i class="fas fa-user-graduate"></i> Aprendices</a></li>
                        <li><a href="/categoria/view"><i class="fas fa-tags"></i> Categorias</a></li>
                        <li><a href="/causa/view"><i class="fas fa-question-circle"></i> Causas</a></li>
                        <li><a href="/estrategias/view"><i class="fas fa-lightbulb"></i> Estrategias</a></li>
                        <li><a href="/reporte/view"><i class="fas fa-chart-line"></i> Reportes</a></li>
                        <li><a href="/intervencion/view"><i class="fas fa-hand-holding-heart"></i> Intervenciones</a></li>
                        <li><a href="/usuario/view"><i class="fas fa-users"></i> Usuarios</a></li>
                    <?php endif ?>
                    <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 5): ?>
                        <li><a href="/reporte/view"><i class="fas fa-chart-line"></i> Reportes</a></li>
                        <li><a href="/aprendiz/view"><i class="fas fa-user-graduate"></i> Aprendices</a></li>
                    <?php endif ?>
                    <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 1): ?>
                        <li><a href="/rol/view"><i class="fas fa-users-cog"></i> Roles</a></li>
                        <li><a href="/usuario/view"><i class="fas fa-users"></i><span class="info-text">Usuarios</span></a></li>
                    <?php endif ?>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Contacto</h3>
                <div class="footer-contact">
                    <p><i class="fas fa-map-marker-alt"></i> Kilometro 10 vía al magdalena, Centro de Procesos Industriales y Construcción, SENA Regional Caldas</p>
                    <p><i class="fas fa-phone"></i> (606) 8748444 </p>
                    <p><i class="fas fa-envelope"></i> soporte@retencioncpic.edu.co</p>
                    <p><i class="fas fa-clock"></i> Lunes a Viernes: 7:00 AM - 6:00 PM</p>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> RetencionCPIC. Todos los derechos reservados.</p>
            <p>Desarrollado por ADSO 28873711 para el SENA</p>

            <div class="theme-toggle" id="theme-toggle">
                <i class="fas fa-moon"></i>
            </div>
        </div>
        
    </footer>
    
    <script>
        // Mostrar buscador en páginas de reportes e intervenciones
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const searchReportes = document.getElementById('header-search-reportes');
            
            if (currentPath.includes('/reporte/view') || currentPath.includes('/intervencion/view')) {
                searchReportes.classList.add('active');
            }
        });
    
        function updateThemeIcon(isDark) {
            const themeIcon = document.querySelector('#theme-toggle-link i');
            if (isDark) {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        }

        function toggleDarkMode() {
            const isDarkMode = document.body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', isDarkMode);
            updateThemeIcon(isDarkMode);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const isDarkMode = localStorage.getItem('darkMode') === 'true';
            if (isDarkMode) {
                document.body.classList.add('dark-mode');
                updateThemeIcon(true);
            }
        });

        function setSidebarState(isHidden) {
            localStorage.setItem('sidebarHidden', isHidden ? '1' : '0');
        }
        function getSidebarState() {
            return localStorage.getItem('sidebarHidden') === '1';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const isMobile = window.innerWidth <= 768;
            
            if (!isMobile) {
                if (getSidebarState()) {
                    sidebar.classList.add('sidebar-hidden');
                } else {
                    sidebar.classList.remove('sidebar-hidden');
                }
            }

            document.querySelector('#menu-toggle').addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('sidebar-visible');
                } else {
                    sidebar.classList.toggle('sidebar-hidden');
                    setSidebarState(sidebar.classList.contains('sidebar-hidden'));
                }
            });

            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(e.target) && 
                        !e.target.closest('#menu-toggle') &&
                        sidebar.classList.contains('sidebar-visible')) {
                        sidebar.classList.remove('sidebar-visible');
                    }
                }
            });

            const menuLinks = sidebar.querySelectorAll('.menu a');
            menuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        sidebar.classList.remove('sidebar-visible');
                    }
                });
            });

            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('sidebar-visible');
                    if (getSidebarState()) {
                        sidebar.classList.add('sidebar-hidden');
                    }
                } else {
                    sidebar.classList.remove('sidebar-hidden');
                }
            });
        });

        function toggleDarkMode() {
            const body = document.body;
            const isDark = body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', isDark);

            const headerIcon = document.querySelector('#theme-toggle-link i');
            if (headerIcon) {
                headerIcon.classList.toggle('fa-moon', !isDark);
                headerIcon.classList.toggle('fa-sun', isDark);
            }

            const footerIcon = document.querySelector('#theme-toggle i');
            if (footerIcon) {
                footerIcon.classList.toggle('fa-moon', !isDark);
                footerIcon.classList.toggle('fa-sun', isDark);
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const isDarkMode = localStorage.getItem('darkMode') === 'true';
            if (isDarkMode) {
                document.body.classList.add('dark-mode');
                const themeIcon = document.querySelector('#theme-toggle i');
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            }
            
            document.getElementById('theme-toggle').addEventListener('click', toggleDarkMode);
        });

        const userMenuToggle = document.getElementById('user-menu-toggle');
        const userDropdownContent = document.getElementById('user-dropdown-content');
        
        userMenuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            userDropdownContent.style.display = userDropdownContent.style.display === 'block' ? 'none' : 'block';
        });
        
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.user-dropdown')) {
                userDropdownContent.style.display = 'none';
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const notificacionesToggle = document.getElementById('notificaciones-toggle');
            const notificacionesContainer = document.getElementById('notificaciones-container');
            const notificacionesBody = document.getElementById('notificaciones-body');
            const notificationBadge = document.getElementById('notification-badge');
            const marcarTodasBtn = document.getElementById('marcar-todas-leidas');

            function cargarNotificaciones() {
                fetch('/notificacion/get')
                    .then(response => response.json())
                    .then(data => {
                        notificacionesBody.innerHTML = '';
                        notificationBadge.textContent = data.noLeidas || 0;

                        if (!data.notificaciones || data.notificaciones.length === 0) {
                            notificacionesBody.innerHTML = '<div class="notificacion-item">No hay notificaciones</div>';
                            return;
                        }

                        data.notificaciones.forEach(notificacion => {
                            const fecha = new Date(notificacion.fecha);
                            const fechaFormateada = fecha.toLocaleDateString('es-ES', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            });

                            const notificacionItem = document.createElement('div');
                            notificacionItem.className = `notificacion-item ${notificacion.leida ? '' : 'no-leida'}`;
                            notificacionItem.dataset.id = notificacion.idNotificacion;
                            notificacionItem.innerHTML = `
                                <div class="notificacion-titulo">${notificacion.mensaje}</div>
                                <div class="notificacion-fecha">${fechaFormateada}</div>
                            `;
                            
                            notificacionItem.addEventListener('click', function() {
                                marcarComoLeida(notificacion.idNotificacion);
                                window.location.href = `/reporte/viewReporte/${notificacion.fkIdReporte}`;
                            });
                            
                            notificacionesBody.appendChild(notificacionItem);
                        });
                    })
                    .catch(error => {
                        console.error('Error cargando notificaciones:', error);
                    });
            }

            function marcarComoLeida(id) {
                fetch(`/notificacion/marcar-leida/${id}`, { method: 'POST' })
                    .then(() => cargarNotificaciones())
                    .catch(error => console.error('Error marcando como leída:', error));
            }

            if (notificacionesToggle) {
                notificacionesToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    notificacionesContainer.classList.toggle('show');
                    if (notificacionesContainer.classList.contains('show')) {
                        cargarNotificaciones();
                    }
                });
            }

            if (marcarTodasBtn) {
                marcarTodasBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    fetch('/notificacion/marcar-todas-leidas', { method: 'POST' })
                        .then(() => cargarNotificaciones())
                        .catch(error => console.error('Error marcando todas como leídas:', error));
                });
            }

            document.addEventListener('click', function(e) {
                if (notificacionesContainer && notificacionesToggle &&
                    !notificacionesContainer.contains(e.target) && 
                    !notificacionesToggle.contains(e.target) &&
                    notificacionesContainer.classList.contains('show')) {
                    notificacionesContainer.classList.remove('show');
                }
            });

            if (notificacionesToggle) {
                setInterval(cargarNotificaciones, 30000);
                cargarNotificaciones();
            }
        });
    </script>
</body>

</html>