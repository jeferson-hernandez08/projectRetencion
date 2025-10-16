<!-- Al principio del archivo -->
<?php
$reporteSeleccionado = $_GET['reporteId'] ?? null;
?>

<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/intervencion/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/intervencion/create" method="post">
            <!-- Campo Descripción -->
            <div class="form-group">
                <label for="txtDescripcion">Descripción</label>
                <textarea name="txtDescripcion" id="txtDescripcion" class="form-control" rows="4" required></textarea>
            </div>

            <!-- Campo Estrategia -->
            <div class="form-group">
                <label for="txtFkIdEstrategias">Estrategia</label>
                <select name="txtFkIdEstrategias" id="txtFkIdEstrategias" class="form-control" required>
                    <option value="">Selecciona una estrategia</option>
                    <?php
                        if (isset($estrategias) && is_array($estrategias)) {
                            foreach ($estrategias as $estrategia) {
                                echo "<option value='".$estrategia->id."'>".$estrategia->strategy."</option>";
                            }
                        } else {
                            echo "ERROR";
                        }
                    ?>
                </select>
            </div>

            <!-- Campo Reporte con búsqueda mejorada -->
            <div class="form-group">
                <label for="txtFkIdReporte">Reporte Relacionado</label>
                <div class="custom-select-wrapper">
                    <div class="custom-select-trigger" id="selectReporteTrigger">
                        <span id="selectedReporte">Selecciona un reporte</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="custom-select-dropdown" id="selectReporteDropdown">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="searchReporte" placeholder="Buscar por aprendiz..." autocomplete="off">
                        </div>
                        <div class="options-list" id="optionsReporteList">
                            <?php
                                if (isset($reportes) && is_array($reportes)) {
                                    foreach ($reportes as $reporte) {
                                        $selected = ($reporteSeleccionado == $reporte->id) ? 'selected' : '';
                                        $textoOpcion = "Reporte #{$reporte->id} - Aprendiz: {$reporte->nombreAprendiz}";
                                        if (!empty($reporte->description)) {
                                            $descripcionCorta = strlen($reporte->description) > 50 
                                                ? substr($reporte->description, 0, 50) . '...' 
                                                : $reporte->description;
                                            $textoOpcion .= " - Desc: {$descripcionCorta}";
                                        }
                                        $selectedClass = $selected ? 'selected' : '';
                                        echo "<div class='custom-option {$selectedClass}' data-value='".$reporte->id."' data-aprendiz='".$reporte->nombreAprendiz."'>".$textoOpcion."</div>";
                                    }
                                } else {
                                    echo "<div class='no-options'>No hay reportes disponibles</div>";
                                }
                            ?>
                        </div>
                    </div>
                    <input type="hidden" name="txtFkIdReporte" id="txtFkIdReporte" required>
                </div>
            </div>

            <!-- Campo Usuario (oculto) -->
            <input type="hidden" name="txtFkIdUsuario" value="<?php echo $_SESSION['id']; ?>">

            <!-- Mostrar nombre del usuario responsable actual -->
             <div class="form-group">
                <label>Usuario Responsable</label>
                <input type="text" class="form-control" value="<?php echo $_SESSION['nombre']; ?>" readonly>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>

<style>
    .custom-select-wrapper {
        position: relative;
        width: 100%;
    }

    .custom-select-trigger {
        width: 100%;
        padding: 10px 15px;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 4px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
    }

    .custom-select-trigger:hover {
        border-color: #39a900;
    }

    .custom-select-trigger.active {
        border-color: #39a900;
        box-shadow: 0 0 0 3px rgba(57, 169, 0, 0.1);
    }

    .custom-select-trigger i {
        transition: transform 0.3s ease;
        color: #666;
    }

    .custom-select-trigger.active i {
        transform: rotate(180deg);
    }

    .custom-select-dropdown {
        position: absolute;
        top: calc(100% + 5px);
        left: 0;
        width: 100%;
        background: white;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        display: none;
        z-index: 1000;
        max-height: 300px;
        overflow: hidden;
    }

    .custom-select-dropdown.show {
        display: block;
    }

    .search-box {
        padding: 10px;
        border-bottom: 1px solid #eee;
        display: flex;
        align-items: center;
        gap: 8px;
        background-color: #f9f9f9;
    }

    .search-box i {
        color: #666;
        font-size: 14px;
    }

    .search-box input {
        flex: 1;
        border: none;
        outline: none;
        padding: 5px;
        font-size: 14px;
        background: transparent;
    }

    .options-list {
        max-height: 240px;
        overflow-y: auto;
    }

    .custom-option {
        padding: 10px 15px;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .custom-option:hover {
        background-color: #f0f0f0;
    }

    .custom-option.selected {
        background-color: #39a900;
        color: white;
    }

    .no-options {
        padding: 15px;
        text-align: center;
        color: #999;
    }

    /* Estilos para tema oscuro */
    body.dark-mode .custom-select-trigger {
        background-color: #2d3748;
        border-color: #4a5568;
        color: #e2e8f0;
    }

    body.dark-mode .custom-select-trigger:hover {
        border-color: #39a900;
    }

    body.dark-mode .custom-select-dropdown {
        background-color: #2d3748;
        border-color: #4a5568;
    }

    body.dark-mode .search-box {
        background-color: #1a202c;
        border-bottom-color: #4a5568;
    }

    body.dark-mode .search-box input {
        color: #e2e8f0;
    }

    body.dark-mode .custom-option:hover {
        background-color: #4a5568;
    }

    body.dark-mode .custom-option.selected {
        background-color: #39a900;
        color: white;
    }
</style>

<script>  
    // Script para el select personalizado con búsqueda por aprendiz
    document.addEventListener('DOMContentLoaded', function() {
        const trigger = document.getElementById('selectReporteTrigger');
        const dropdown = document.getElementById('selectReporteDropdown');
        const searchInput = document.getElementById('searchReporte');
        const optionsList = document.getElementById('optionsReporteList');
        const hiddenInput = document.getElementById('txtFkIdReporte');
        const selectedText = document.getElementById('selectedReporte');
        const allOptions = Array.from(optionsList.querySelectorAll('.custom-option'));

        // Si hay un reporte preseleccionado, mostrarlo
        const preselectedOption = optionsList.querySelector('.custom-option.selected');
        if (preselectedOption) {
            hiddenInput.value = preselectedOption.getAttribute('data-value');
            selectedText.textContent = preselectedOption.textContent;
        }

        // Toggle dropdown
        trigger.addEventListener('click', function(e) {
            e.stopPropagation();
            trigger.classList.toggle('active');
            dropdown.classList.toggle('show');
            if (dropdown.classList.contains('show')) {
                searchInput.focus();
            }
        });

        // Cerrar dropdown al hacer clic fuera
        document.addEventListener('click', function(e) {
            if (!trigger.contains(e.target) && !dropdown.contains(e.target)) {
                trigger.classList.remove('active');
                dropdown.classList.remove('show');
            }
        });

        // Filtrar opciones por nombre del aprendiz
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            allOptions.forEach(option => {
                const aprendizNombre = option.getAttribute('data-aprendiz').toLowerCase();
                const textoCompleto = option.textContent.toLowerCase();
                
                // Buscar en el nombre del aprendiz o en el texto completo
                if (aprendizNombre.includes(searchTerm) || textoCompleto.includes(searchTerm)) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });

            // Verificar si hay resultados
            const visibleOptions = allOptions.filter(opt => opt.style.display !== 'none');
            if (visibleOptions.length === 0) {
                if (!optionsList.querySelector('.no-results')) {
                    const noResults = document.createElement('div');
                    noResults.className = 'no-options no-results';
                    noResults.textContent = 'No se encontraron reportes';
                    optionsList.appendChild(noResults);
                }
            } else {
                const noResults = optionsList.querySelector('.no-results');
                if (noResults) {
                    noResults.remove();
                }
            }
        });

        // Seleccionar opción
        allOptions.forEach(option => {
            option.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                const text = this.textContent;
                
                // Actualizar valores
                hiddenInput.value = value;
                selectedText.textContent = text;
                
                // Remover selección previa
                allOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                
                // Cerrar dropdown
                trigger.classList.remove('active');
                dropdown.classList.remove('show');
                
                // Limpiar búsqueda
                searchInput.value = '';
                allOptions.forEach(opt => opt.style.display = 'block');
                const noResults = optionsList.querySelector('.no-results');
                if (noResults) noResults.remove();
            });
        });

        // Prevenir que el dropdown se cierre al hacer clic en la búsqueda
        searchInput.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
</script>