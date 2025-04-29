// Función para alternar el modo oscuro
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    // Guardar la preferencia en localStorage
    const isDarkMode = document.body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDarkMode);
}

// Función para aplicar el modo oscuro al cargar la página
function initDarkMode() {
    // Obtener la preferencia guardada
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    
    // Aplicar modo oscuro si estaba activado
    if (isDarkMode) {
        document.body.classList.add('dark-mode');
    }
}

// Inicializar al cargar la página
document.addEventListener('DOMContentLoaded', initDarkMode);