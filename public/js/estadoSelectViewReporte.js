document.addEventListener('DOMContentLoaded', function() {
    const selects = document.querySelectorAll('.estado-select');
    
    selects.forEach(select => {
        select.addEventListener('change', function() {
            const card = this.closest('.report-card');
            const badge = card.querySelector('.update-badge');
            const reporteId = this.getAttribute('data-id');
            const nuevoEstado = this.value;
            
            // Añadir clase de carga
            badge.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            badge.style.color = '#3498db';
            badge.style.opacity = 1;
            
            // Enviar por AJAX
            fetch(`/reporte/updateEstado/${reporteId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ estado: nuevoEstado })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar visualmente
                    badge.innerHTML = '<i class="fas fa-check"></i> Actualizado';
                    badge.style.color = '#2ecc71';
                    
                    // Ocultar después de 2 segundos
                    setTimeout(() => {
                        badge.style.opacity = 0;
                        setTimeout(() => {
                            badge.innerHTML = '';
                        }, 300);
                    }, 2000);
                } else {
                    badge.innerHTML = '<i class="fas fa-times"></i> Error';
                    badge.style.color = '#e74c3c';
                    setTimeout(() => {
                        badge.style.opacity = 0;
                        setTimeout(() => {
                            badge.innerHTML = '';
                        }, 300);
                    }, 2000);
                    // Revertir al valor anterior
                    this.value = data.oldEstado;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                badge.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Error';
                badge.style.color = '#e74c3c';
                setTimeout(() => {
                    badge.style.opacity = 0;
                    setTimeout(() => {
                        badge.innerHTML = '';
                    }, 300);
                }, 2000);
            });
        });
    });
});