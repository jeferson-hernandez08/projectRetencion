<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/reporte/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/reporte/create" method="post">
            <!-- Campo Fecha de Creación -->
            <div class="form-group">
                <label for="txtFechaCreacion">Fecha de Creación</label>
                <input type="datetime-local" name="txtFechaCreacion" id="txtFechaCreacion" class="form-control" required >
            </div>
            
            <!-- Campo Descripción -->
            <div class="form-group">
                <label for="txtDescripcion">Descripción</label>
                <textarea name="txtDescripcion" id="txtDescripcion" class="form-control" required></textarea>
            </div>

            <!-- *********************************************************** Commit -->
            <label for="txtFkIdReporte">Causas</label>
            <div class="info-causa-reporte">
                <div class="new-causa-reporte">
                    <div> 
                        <!-- Campo Categoria -->
                        <div class="form-group">
                            <label for="txtFkIdCategoria">Categoria</label>
                            <select name="txtFkIdCategoria" id="txtFkIdCategoria" class="form-control" required>
                                <option value="">Selecciona una categoria</option>
                                <?php
                                    if (isset($categorias) && is_array($categorias)) {
                                        foreach ($categorias as $categoria) {
                                            echo "<option value='".$categoria->idCategoria."'>".$categoria->nombre."</option>";  // Aqui era el ERROR nombre de la colomna nombre
                                        }
                                    } else {
                                        echo "<option value=''>No hay categorias disponibles</option>";
                                    }
                                ?>
                            </select>
                        </div>
            
                        <!-- Campo Causa -->
                        <div class="form-group">
                            <label for="txtFkIdCausa">Causa</label>
                            <select name="txtFkIdCausa" id="txtFkIdCausa" class="form-control" required>
                                <option value="">Selecciona una causa</option>
                                <?php
                                    if (isset($causas) && is_array($causas)) {
                                        foreach ($causas as $causa) {
                                            //echo "<option value='".$causa->idCausa."'>".$causa->causa."</option>";
                                            echo "<option value='".$causa->idCausa."' data-categoria='".$causa->fkIdCategoria."'>".$causa->causa."</option>";    // Se agrega data-categoria con el ID de su categoría correspondiente, esto es para el filtrado.
                                        }
                                    } else {
                                        echo "<option value=''>No hay causas disponibles</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                  
                    <div>
                        <!-- Botón para agregar relación (cambiado a button type="button") -->
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
                <label for="txtDireccionamiento">Direccionamiento</label>
                <select name="txtDireccionamiento" id="txtDireccionamiento" class="form-control" required>
                    <option value="" selected disabled>Seleccione un tipo de direccionamiento</option>
                    <option value="Coordinador académico">Coordinador académico</option>
                    <option value="Coordinador de formación">Coordinador de formación</option>
                </select>
            </div>

            <!-- Campo Estado (select) -->
            <div class="form-group">
                <label for="txtEstado">Estado</label>
                <select name="txtEstado" id="txtEstado" class="form-control" required>
                    <option value="" selected disabled>Seleccione un estado</option>
                    <option value="Registrado">Registrado</option>
                    <option value="En proceso">En proceso</option>
                    <option value="Retenido">Retenido</option>
                    <option value="Desertado">Desertado</option>
                </select>
            </div>

            <!-- Campo Aprendiz -->
            <div class="form-group">
                <label for="txtFkIdAprendiz">Aprendiz</label>
                <select name="txtFkIdAprendiz" id="txtFkIdAprendiz" class="form-control" required>
                    <option value="">Selecciona un aprendiz</option>
                    <?php
                        if (isset($aprendices) && is_array($aprendices)) {
                            foreach ($aprendices as $aprendiz) {
                                echo "<option value='".$aprendiz->idAprendiz."'>".$aprendiz->nombre."</option>";
                            }
                        } else {
                            echo "ERROR";
                        }
                    ?>
                </select>
            </div>

            <!-- Campo Usuario -->
            <div class="form-group">
                <label for="txtFkIdUsuario">Usuario</label>
                <select name="txtFkIdUsuario" id="txtFkIdUsuario" class="form-control" required>
                    <option value="">Selecciona un usuario</option>
                    <?php
                        if (isset($usuarios) && is_array($usuarios)) {
                            foreach ($usuarios as $usuario) {
                                echo "<option value='".$usuario->idUsuario."'>".$usuario->nombre."</option>";
                            }
                        } else {
                            echo "ERROR";
                        }
                    ?>
                </select>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript para manejar las relaciones -->
<!-- <script src="../../../public/js/relacionCausaReporte.js"></script> Es con uno solo ../ ENSAYAR COMO EL IMG BORRAR-->
<script>
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
</script>