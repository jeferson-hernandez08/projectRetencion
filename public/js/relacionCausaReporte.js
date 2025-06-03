document.addEventListener('DOMContentLoaded', function() {
    const relaciones = [];
    const categoriaSelect = document.getElementById('txtFkIdCategoria');
    const causaSelect = document.getElementById('txtFkIdCausa');
    const form = document.querySelector('form');

    // Función principal de filtrado
    const filtrarCausas = () => {
        const categoriaId = categoriaSelect.value;
        const causas = causaSelect.querySelectorAll('option');
        
        causas.forEach(option => {
            // Siempre mostrar la opción por defecto
            if (option.value === '') {
                option.style.display = '';
                return;
            }
            
            // Mostrar/ocultar según corresponda
            if (categoriaId) {
                option.style.display = option.dataset.categoria === categoriaId ? '' : 'none';
            } else {
                option.style.display = ''; // Mostrar todas si no hay categoría seleccionada
            }
        });

        // Seleccionar primera opción válida
        const primeraValida = Array.from(causas).find(opt => 
            opt.style.display === '' && opt.value !== ''
        );
        causaSelect.value = primeraValida ? primeraValida.value : '';
    };

    // Eventos
    categoriaSelect.addEventListener('change', filtrarCausas);
    
    document.getElementById('btnAgregarRelacion').addEventListener('click', () => {
        const categoriaId = categoriaSelect.value;
        const causaId = causaSelect.value;
        
        // Validación básica
        if (!categoriaId || !causaId) {
            alert('Selecciona una categoría y causa válidas');
            return;
        }

        // Obtener textos
        const categoriaNombre = categoriaSelect.options[categoriaSelect.selectedIndex].text;
        const causaNombre = causaSelect.options[causaSelect.selectedIndex].text;

        // Verificar duplicados
        const existe = relaciones.some(rel => 
            rel.categoriaId === categoriaId && rel.causaId === causaId
        );
        
        if (existe) {
            alert('Esta combinación ya existe');
            return;
        }

        // Agregar a la lista
        relaciones.push({
            categoriaId,
            categoriaNombre,
            causaId,
            causaNombre
        });

        actualizarVista();
        resetearSelects();
    });

    // Eliminar relación
    document.getElementById('relacionesContainer').addEventListener('click', (e) => {
        const botonEliminar = e.target.closest('.btn-eliminar');
        if (botonEliminar) {
            relaciones.splice(botonEliminar.dataset.index, 1);
            actualizarVista();
        }
    });

    // Validar envío
    form.addEventListener('submit', (e) => {
        if (relaciones.length === 0) {
            e.preventDefault();
            alert('Agrega al menos una relación categoría-causa');
            document.getElementById('relacionesContainer').scrollIntoView({
                behavior: 'smooth'
            });
        }
    });

    // Funciones auxiliares
    const actualizarVista = () => {
        const container = document.getElementById('relacionesContainer');
        container.innerHTML = relaciones.map((rel, index) => `
            <div class="causa-card">
                <div class="card-content">
                    <h4>${rel.categoriaNombre}</h4>
                    <p>${rel.causaNombre}</p>
                </div>
                <button type="button" class="btn-eliminar" data-index="${index}">
                    <img src="../img/btn-borrar.png" alt="Eliminar">
                </button>
            </div>
        `).join('') || '<p>No hay relaciones agregadas</p>';
        
        document.getElementById('relacionesCausaReporte').value = JSON.stringify(relaciones);
    };

    const resetearSelects = () => {
        categoriaSelect.value = '';
        causaSelect.value = '';
        filtrarCausas(); // Vuelve a mostrar todas las causas
    };

    // Inicialización
    filtrarCausas();
});