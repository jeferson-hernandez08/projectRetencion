<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $title ?> </title>
    <link rel="shortcut icon" href="/img/logoSenaGreen.png" type="image/x-icon"> <!-- Icono de la pestaña del navegador -->
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/styles_admin_layout.css">
    <!-- Añadiendo Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-content">
                <div class="logo">
                    <img src="/img/logoSenaProyect.png" alt="logoImg">  <!--  ../../../public -->
                    <span class="logo-text">RetencionCPIC</span>
                </div>
                <nav class="menu">
                    <ul>
                        <li><a href="/main"><i class="fas fa-home"></i><span class="info-text">Inicio</span></a></li>
                        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 4): ?>   <!-- Instructor -->
                            <li><a href="/reporte/view"><i class="fas fa-chart-line"></i><span class="info-text">Reportes</span></a></li>
                            <li><a href="/intervencion/view"><i class="fas fa-hand-holding-heart"></i><span class="info-text">Intervenciones</span></a></li>
                            <li><a href="/aprendiz/view"><i class="fas fa-user-graduate"></i><span class="info-text">Aprendices</span></a></li>
                            <li><a href="/grupo/view"><i class="fas fa-graduation-cap"></i><span class="info-text">Grupos</span></a></li>        
                        <?php endif ?>   
                        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 5): ?>   <!-- Coordinador Academico  -->
                            <li><a href="/programaFormacion/view"><i class="fas fa-chalkboard-teacher"></i><span class="info-text">Programas</span></a></li>
                            <li><a href="/grupo/view"><i class="fas fa-graduation-cap"></i><span class="info-text">Grupos</span></a></li>
                            <li><a href="/aprendiz/view"><i class="fas fa-user-graduate"></i><span class="info-text">Aprendices</span></a></li>
                            <li><a href="/reporte/view"><i class="fas fa-chart-line"></i><span class="info-text">Reportes</span></a></li>
                            <li><a href="/usuario/view"><i class="fas fa-users"></i><span class="info-text">Usuarios</span></a></li> 
                        <?php endif ?>
                        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 6): ?>   <!-- Coordinador de Formacion (Profesional de Bienestar) -->
                            <li><a href="/categoria/view"><i class="fas fa-tags"></i><span class="info-text">Categorias</span></a></li>
                            <li><a href="/causa/view"><i class="fas fa-question-circle"></i><span class="info-text">Causas</span></a></li>
                            <li><a href="/estrategias/view"><i class="fas fa-lightbulb"></i><span class="info-text">Estrategias</span></a></li>
                            <li><a href="/intervencion/view"><i class="fas fa-hand-holding-heart"></i><span class="info-text">Intervenciones</span></a></li>
                            <li><a href="/reporte/view"><i class="fas fa-chart-line"></i><span class="info-text">Reportes</span></a></li>
                            <li><a href="/aprendiz/view"><i class="fas fa-user-graduate"></i><span class="info-text">Aprendices</span></a></li>
                        <?php endif ?>
                        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 9): ?>   <!-- Vocero -->
                            <li><a href="/reporte/view"><i class="fas fa-chart-line"></i><span class="info-text">Reportes</span></a></li>
                            <li><a href="/aprendiz/view"><i class="fas fa-user-graduate"></i><span class="info-text">Aprendices</span></a></li>
                        <?php endif ?>
                        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 18): ?>   <!-- Administrador -->
                            <li><a href="/rol/view"><i class="fas fa-users-cog"></i><span class="info-text">Roles</span></a></li>
                        <?php endif ?>
                        <!-- <li><a href="/main"><i class="fas fa-home"></i><span class="info-text">Inicio</span></a></li>
                        <li><a href="/rol/view"><i class="fas fa-users-cog"></i><span class="info-text">Roles</span></a></li>
                        <li><a href="/usuario/view"><i class="fas fa-users"></i><span class="info-text">Usuarios</span></a></li>
                        <li><a href="/programaFormacion/view"><i class="fas fa-chalkboard-teacher"></i><span class="info-text">Programas</span></a></li> -->
                        <!-- <li><a href="/grupo/view"><i class="fas fa-graduation-cap"></i><span class="info-text">Grupos</span></a></li> -->
                        <!-- <li><a href="/aprendiz/view"><i class="fas fa-user-graduate"></i><span class="info-text">Aprendices</span></a></li> -->
                        <!-- <li><a href="/reporte/view"><i class="fas fa-chart-line"></i><span class="info-text">Reportes</span></a></li> -->
                        <!-- <li><a href="/estrategias/view"><i class="fas fa-lightbulb"></i><span class="info-text">Estrategias</span></a></li>
                        <li><a href="/categoria/view"><i class="fas fa-tags"></i><span class="info-text">Categorias</span></a></li>
                        <li><a href="/causa/view"><i class="fas fa-question-circle"></i><span class="info-text">Causas</span></a></li> -->
                        <!-- <li><a href="/intervencion/view"><i class="fas fa-hand-holding-heart"></i><span class="info-text">Intervenciones</span></a></li> -->
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
                    <div class="search-container">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Buscar...">
                    </div>
                    <div class="header-icons">
                        <a href="#" class="icon-link"><i class="fas fa-user-circle"></i></a>
                        <a href="#" class="icon-link"><i class="fas fa-bell"></i></a>
                        <a href="#" class="icon-link" id="theme-toggle-link" onclick="toggleDarkMode(); return false;"><i class="fas fa-moon"></i></a>
                    </div>
                </div>
            </header>
            <div class="content">
                <?php include_once $content; ?>
            </div>
        </main>
    </div>
    
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <div class="footer-logo">
                    <img src="/img/logoSenaProyect.png" alt="Logo RetencionCPIC">
                    <div class="footer-logo-text">RetencionCPIC</div>
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
                    <li><a href="/reporte/view"><i class="fas fa-chart-line"></i> Reportes</a></li>
                    <li><a href="/intervencion/view"><i class="fas fa-hand-holding-heart"></i> Intervenciones</a></li>
                    <li><a href="/aprendiz/view"><i class="fas fa-user-graduate"></i> Aprendices</a></li>
                    <li><a href="/grupo/view"><i class="fas fa-graduation-cap"></i> Grupos</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Contacto</h3>
                <div class="footer-contact">
                    <p><i class="fas fa-map-marker-alt"></i> Kilometro 10 vía al magdalena, Centro de Procesos Industriales y Construcción, SENA Regional Caldas</p>
                    <p><i class="fas fa-phone"></i> +57 (4) 123 4567</p>
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
        // Función para cambiar el icono
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

        // Función para alternar el modo oscuro
        function toggleDarkMode() {
            const isDarkMode = document.body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', isDarkMode);
            updateThemeIcon(isDarkMode);
        }

        // Aplicar el tema guardado al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            const isDarkMode = localStorage.getItem('darkMode') === 'true';
            if (isDarkMode) {
                document.body.classList.add('dark-mode');
                updateThemeIcon(true);
            }
        });

        // Event listeners
        document.querySelector('#menu-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('sidebar-hidden');
        });


        // ***************** Footer y Modo Oscuro ******************
         // Función para cambiar el modo oscuro/claro
        function toggleDarkMode() {
            const body = document.body;
            body.classList.toggle('dark-mode');
            
            // Actualizar icono
            const themeIcon = document.querySelector('#theme-toggle i');
            if (body.classList.contains('dark-mode')) {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
                localStorage.setItem('darkMode', 'true');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
                localStorage.setItem('darkMode', 'false');
            }
        }
        
        // Aplicar el tema guardado al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            const isDarkMode = localStorage.getItem('darkMode') === 'true';
            if (isDarkMode) {
                document.body.classList.add('dark-mode');
                const themeIcon = document.querySelector('#theme-toggle i');
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            }
            
            // Evento para el botón de cambio de tema
            document.getElementById('theme-toggle').addEventListener('click', toggleDarkMode);
        });
    </script>
</body>

</html>