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
                        <!-- Botón de Guardar -->
                        <div class="form-group">
                            <button type="submit">Guardar Relación</button>
                        </div>
                    </div> 
                </div>
                               
                <!-- View causa-reporte -->
                <div class="info-card">
                    <?php
                        if (empty($causasReportes)) {
                            echo '<br>No se encuentran relaciones causa-reporte en la base de datos';
                        } else {
                            foreach ($causasReportes as $relacion) {
                                echo
                                "<div class='record'>
                                    <span>Reporte #$relacion->fkIdReporte - Causa: $relacion->causa_nombre</span>
                                    <div class='buttons'> 
                                        <a href='/causaReporte/delete/$relacion->fkIdReporte/$relacion->fkIdCausa' 
                                        onclick='return confirm(\"¿Está seguro de eliminar esta relación?\")'>     <button>Eliminar</button> </a> 
                                    </div>
                                </div>";
                            }
                        }
                    ?>
                </div>
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