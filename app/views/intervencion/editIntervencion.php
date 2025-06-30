<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/intervencion/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/intervencion/update" method="post">
            <!-- Campo ID (oculto) -->
            <div class="form-group">
                <label for="txtId">ID de la Intervención</label>
                <input type="text" readonly value="<?php echo $intervencion->idIntervencion ?>" name="txtId" id="txtId" class="form-control">
            </div>

            <!-- Campo Fecha de Creación -->
            <!-- <div class="form-group">
                <label for="txtFechaCreacion">Fecha de Creación</label>
                <input type="datetime-local" value="<?php //echo date('Y-m-d\TH:i', strtotime($intervencion->fechaCreacion)) ?>" name="txtFechaCreacion" id="txtFechaCreacion" class="form-control">
            </div> -->
            
            <!-- Campo Descripción -->
            <div class="form-group">
                <label for="txtDescripcion">Descripción</label>
                <textarea name="txtDescripcion" id="txtDescripcion" class="form-control" rows="4"><?php echo $intervencion->descripcion ?></textarea>
            </div>

            <!-- Campo Estrategia -->
            <div class="form-group">
                <label for="txtFkIdEstrategias">Estrategia</label>
                <select name="txtFkIdEstrategias" id="txtFkIdEstrategias" class="form-control">
                    <option value="">Selecciona una estrategia</option>
                    <?php
                        if (isset($estrategias) && is_array($estrategias)) {
                            foreach ($estrategias as $estrategia) {
                                $selected = ($intervencion->fkIdEstrategias == $estrategia->idEstrategias) ? 'selected' : '';
                                echo "<option value='".$estrategia->idEstrategias."' $selected>".$estrategia->estrategia."</option>";
                            }
                        } else {
                            echo "ERROR";
                        }
                    ?>
                </select>
            </div>

            <!-- Campo Reporte -->
            <div class="form-group">
                <label for="txtFkIdReporte">Reporte Relacionado</label>
                <select name="txtFkIdReporte" id="txtFkIdReporte" class="form-control">
                    <option value="">Selecciona un reporte</option>
                    <?php
                        if (isset($reportes) && is_array($reportes)) {
                            foreach ($reportes as $reporte) {
                                $selected = ($intervencion->fkIdReporte == $reporte->idReporte) ? 'selected' : '';
                                echo "<option value='".$reporte->idReporte."' $selected>".$reporte->descripcion."</option>";
                            }
                        } else {
                            echo "ERROR";
                        }
                    ?>
                </select>
            </div>

            <!-- Campo Usuario -->
            <!-- Campo Usuario (oculto y mostrado) -->
            <input type="hidden" name="txtFkIdUsuario" value="<?php echo $usuarioActual->idUsuario; ?>">
            <!-- Campo Usuario (mostrar en el edit) -->
            <div class="form-group">
                <label>Usuario Resposable</label>
                <input type="text" class="form-control" value="<?php echo $usuarioActual->nombre; ?>" readonly>
            </div>
            
            <!-- <div class="form-group">
                <label for="txtFkIdUsuario">Usuario Responsable</label>
                <select name="txtFkIdUsuario" id="txtFkIdUsuario" class="form-control">
                    <option value="">Selecciona un usuario</option>
                    <?php
                        // if (isset($usuarios) && is_array($usuarios)) {
                        //     foreach ($usuarios as $usuario) {
                        //         $selected = ($intervencion->fkIdUsuario == $usuario->idUsuario) ? 'selected' : '';
                        //         echo "<option value='".$usuario->idUsuario."' $selected>".$usuario->nombre."</option>";
                        //     }
                        // } else {
                        //     echo "ERROR";
                        // }
                    ?>
                </select>
            </div> -->

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Actualizar</button>
            </div>
        </form>
    </div>
</div>