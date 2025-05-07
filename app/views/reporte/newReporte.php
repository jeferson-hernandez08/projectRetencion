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
                                            echo "<option value='".$causa->idCausa."'>".$causa->causa."</option>";
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
                            <button type="button" id="btnAgregarRelacion">Guardar Relación</button>
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


<!-- SE ELIMINA DESDE AQUÍ PARA QUE RENDERIZE CAUSA, REVISAR JS -->
<!-- JavaScript para manejar las relaciones -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Variables globales
    const relaciones = [];
    
    // Filtrar causas según categoría seleccionada
    document.getElementById('txtFkIdCategoria').addEventListener('change', function() {
        const categoriaId = this.value;
        const causasSelect = document.getElementById('txtFkIdCausa');
        const causasOptions = causasSelect.querySelectorAll('option');
        
        // Mostrar todas las opciones primero
        causasOptions.forEach(option => {
            option.style.display = '';
        });
        
        if (categoriaId) {
            // Ocultar causas que no pertenecen a la categoría seleccionada
            causasOptions.forEach(option => {
                if (option.value !== '' && option.dataset.categoria !== categoriaId) {
                    option.style.display = 'none';
                }
            });
            
            // Seleccionar la primera opción visible
            const primeraOpcionVisible = Array.from(causasOptions).find(option => 
                option.style.display !== 'none' && option.value !== ''
            );
            if (primeraOpcionVisible) {
                causasSelect.value = primeraOpcionVisible.value;
            }
        }
    });
    
    // Agregar relación
    document.getElementById('btnAgregarRelacion').addEventListener('click', function() {
        const categoriaId = document.getElementById('txtFkIdCategoria').value;
        const categoriaNombre = document.getElementById('txtFkIdCategoria').options[document.getElementById('txtFkIdCategoria').selectedIndex].text;
        const causaId = document.getElementById('txtFkIdCausa').value;
        const causaNombre = document.getElementById('txtFkIdCausa').options[document.getElementById('txtFkIdCausa').selectedIndex].text;
        
        if (!categoriaId || !causaId) {
            alert('Por favor selecciona una categoría y una causa');
            return;
        }
        
        // Verificar si la relación ya existe
        const relacionExistente = relaciones.find(r => r.categoriaId === categoriaId && r.causaId === causaId);
        if (relacionExistente) {
            alert('Esta relación ya ha sido agregada');
            return;
        }
        
        // Agregar a la lista de relaciones
        const relacion = {
            categoriaId,
            categoriaNombre,
            causaId,
            causaNombre
        };
        relaciones.push(relacion);
        
        // Actualizar la vista
        actualizarRelacionesView();
        
        // Limpiar selección
        document.getElementById('txtFkIdCategoria').value = '';
        document.getElementById('txtFkIdCausa').value = '';
    });
    
    // Actualizar la vista de relaciones
    function actualizarRelacionesView() {
        const container = document.getElementById('relacionesContainer');
        container.innerHTML = '';
        
        if (relaciones.length === 0) {
            container.innerHTML = '<p>No hay relaciones agregadas</p>';
            return;
        }
        
        relaciones.forEach((relacion, index) => {
            const card = document.createElement('div');
            card.className = 'causa-card';
            card.innerHTML = `
                <div class="card-content">
                    <h4>${relacion.categoriaNombre}</h4>
                    <p>${relacion.causaNombre}</p>
                </div>
                <button type="button" class="btn-eliminar" data-index="${index}">
                    <img src="/img/delete.svg" alt="Eliminar">
                </button>
            `;
            container.appendChild(card);
        });
        
        // Actualizar el input oculto con las relaciones
        document.getElementById('relacionesCausaReporte').value = JSON.stringify(relaciones);
    }
    
    // Eliminar relación
    document.getElementById('relacionesContainer').addEventListener('click', function(e) {
        if (e.target.closest('.btn-eliminar')) {
            const index = e.target.closest('.btn-eliminar').dataset.index;
            relaciones.splice(index, 1);
            actualizarRelacionesView();
        }
    });
    
    // Validar antes de enviar el formulario
    document.getElementById('reporteForm').addEventListener('submit', function(e) {
        if (relaciones.length === 0) {
            e.preventDefault();
            alert('Debes agregar al menos una relación categoría-causa');
        }
    });
});
</script>

<!-- Estilos para las cards -->
<style>
.causa-card {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.causa-card .card-content {
    flex: 1;
}

.causa-card .btn-eliminar {
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px;
}

.causa-card .btn-eliminar img {
    width: 20px;
    height: 20px;
}

.info-card {
    margin-top: 20px;
}
</style>