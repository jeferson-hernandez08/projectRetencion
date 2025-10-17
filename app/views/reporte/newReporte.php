<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/reporte/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/reporte/create" method="post">
            <!-- Campo Descripción -->
            <div class="form-group">
                <label for="txtDescripcion"><i class="fas fa-align-left"></i> Descripción</label>
                <textarea name="txtDescripcion" id="txtDescripcion" class="form-control" required></textarea>
            </div>

            <!-- *********************************************************** Commit -->
            <label for="txtFkIdReporte"><i class="fas fa-exclamation-triangle"></i> Causas</label>
            <div class="info-causa-reporte">
                <div class="new-causa-reporte">
                    <div> 
                        <!-- Campo Categoria -->
                        <div class="form-group">
                            <label for="txtFkIdCategoria"><i class="fas fa-tags"></i> Categoria</label>
                            <select name="txtFkIdCategoria" id="txtFkIdCategoria" class="form-control">
                                <option value="">Selecciona una categoria</option>
                                <?php
                                    if (isset($categorias) && is_array($categorias)) {
                                        foreach ($categorias as $categoria) {
                                            echo "<option value='".$categoria->id."'>".$categoria->name."</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No hay categorias disponibles</option>";
                                    }
                                ?>
                            </select>
                        </div>
            
                        <!-- Campo Causa -->
                        <div class="form-group">
                            <label for="txtFkIdCausa"><i class="fas fa-list-alt"></i> Causa</label>
                            <select name="txtFkIdCausa" id="txtFkIdCausa" class="form-control">
                                <option value="">Selecciona una causa</option>
                                <?php
                                    if (isset($causas) && is_array($causas)) {
                                        foreach ($causas as $causa) {
                                            echo "<option value='".$causa->id."' data-categoria='".$causa->fkIdCategories."'>".$causa->cause."</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No hay causas disponibles</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                  
                    <div>
                        <!-- Botón para agregar relación -->
                        <div class="form-group">
                            <button type="button" id="btnAgregarRelacion">Guardar</button>
                        </div>
                    </div> 
                </div>
                               
                <!-- Contenedor para las cards de relaciones -->
                <div class="info-card" id="relacionesContainer">
                    <!-- Aquí se agregarán las cards dinámicamente -->
                </div>

                <!-- Input oculto para almacenar las relaciones -->
                <input type="hidden" name="relacionesCausaReporte" id="relacionesCausaReporte">
            </div>
            <!-- ******************************************************************** -->

            <!-- Campo Direccionamiento (select) -->
            <div class="form-group">
                <label for="txtDireccionamiento"><i class="fas fa-route"></i>Direccionamiento</label>
                <select name="txtDireccionamiento" id="txtDireccionamiento" class="form-control" required>
                    <option value="" selected disabled>Seleccione un tipo de direccionamiento</option>
                    <option value="Coordinador académico">Coordinador académico</option>
                    <option value="Coordinador de formación">Coordinador de formación</option>
                </select>
            </div>

            <!-- Campo Estado (oculto) -->
            <input type="hidden" name="txtEstado" value="Registrado">

            <!-- Campo Aprendiz con búsqueda mejorada -->
            <div class="form-group">
                <label for="txtFkIdAprendiz"><i class="fas fa-user-graduate"></i> Aprendiz</label>
                <div class="custom-select-wrapper">
                    <div class="custom-select-trigger" id="selectTrigger">
                        <span id="selectedAprendiz">Selecciona un aprendiz</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="custom-select-dropdown" id="selectDropdown">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="searchAprendiz" placeholder="Buscar aprendiz..." autocomplete="off">
                        </div>
                        <div class="options-list" id="optionsList">
                            <?php
                                if (isset($aprendices) && is_array($aprendices)) {
                                    foreach ($aprendices as $aprendiz) {
                                        $nombreCompletoAprendiz = $aprendiz->firtsName . ' ' . $aprendiz->lastName;
                                        echo "<div class='custom-option' data-value='".$aprendiz->id."'>".$nombreCompletoAprendiz."</div>";
                                    }
                                } else {
                                    echo "<div class='no-options'>No hay aprendices disponibles</div>";
                                }
                            ?>
                        </div>
                    </div>
                    <input type="hidden" name="txtFkIdAprendiz" id="txtFkIdAprendiz" required>
                </div>
            </div>

            <!-- Campo Usuario (oculto) -->
            <input type="hidden" name="txtFkIdUsuario" value="<?php echo $_SESSION['id']; ?>">

            <!-- Mostrar nombre del usuario actual -->
            <div class="form-group">
                <label><i class="fas fa-user"></i> Usuario</label>
                <input type="text" class="form-control" value="<?php echo $_SESSION['nombre']; ?>" readonly>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit"><i class="fas fa-save"></i> Guardar</button>
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

<!-- JavaScript para manejar las relaciones Tabla Causa-Reporte -->
<script src="../js/relacionCausaReporte.js"></script>
<script>  
    // Script para el select personalizado con búsqueda
    document.addEventListener('DOMContentLoaded', function() {
        const trigger = document.getElementById('selectTrigger');
        const dropdown = document.getElementById('selectDropdown');
        const searchInput = document.getElementById('searchAprendiz');
        const optionsList = document.getElementById('optionsList');
        const hiddenInput = document.getElementById('txtFkIdAprendiz');
        const selectedText = document.getElementById('selectedAprendiz');
        const allOptions = Array.from(optionsList.querySelectorAll('.custom-option'));

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

        // Filtrar opciones
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            allOptions.forEach(option => {
                const text = option.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
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
                    noResults.textContent = 'No se encontraron aprendices';
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