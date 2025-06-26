<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/reporte/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/reporte/create" method="post">
            <!-- Campo Fecha de Creación -->
            <!-- <div class="form-group">
                <label for="txtFechaCreacion">Fecha de Creación</label>
                <input type="datetime-local" name="txtFechaCreacion" id="txtFechaCreacion" class="form-control" required >
            </div> -->
            
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

<!-- JavaScript para manejar las relaciones Tabla Causa-Reporte -->
<script src="../js/relacionCausaReporte.js"></script>    <!--  Es con uno solo ../ ENSAYAR COMO EL IMG BORRAR-->
<script>  
    // Pegar aquí para realizar pruebas
    
</script>