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
                <label for="txtId"><i class="fas fa-id-card"></i> ID de la Intervención</label>
                <input type="text" readonly value="<?php echo $intervencion->id ?>" name="txtId" id="txtId" class="form-control">
            </div>

            <!-- Campo Fecha de Creación -->
            <!-- <div class="form-group">
                <label for="txtFechaCreacion">Fecha de Creación</label>
                <input type="datetime-local" value="<?php //echo date('Y-m-d\TH:i', strtotime($intervencion->fechaCreacion)) ?>" name="txtFechaCreacion" id="txtFechaCreacion" class="form-control">
            </div> -->
            
            <!-- Campo Descripción -->
            <div class="form-group">
                <label for="txtDescripcion"><i class="fas fa-align-left"></i> Descripción</label>
                <textarea name="txtDescripcion" id="txtDescripcion" class="form-control" rows="4"><?php echo $intervencion->description ?></textarea>
            </div>

            <!-- Campo Estrategia -->
            <div class="form-group">
                <label for="txtFkIdEstrategias"><i class="fas fa-chess-knight"></i> Estrategia</label>
                <select name="txtFkIdEstrategias" id="txtFkIdEstrategias" class="form-control">
                    <option value="">Selecciona una estrategia</option>
                    <?php
                        if (isset($estrategias) && is_array($estrategias)) {
                            foreach ($estrategias as $estrategia) {
                                $selected = ($intervencion->fkIdStrategies == $estrategia->id) ? 'selected' : '';
                                echo "<option value='".$estrategia->id."' $selected>".$estrategia->strategy."</option>";
                            }
                        } else {
                            echo "ERROR";
                        }
                    ?>
                </select>
            </div>

            <!-- Campo Reporte - mostrar aprendiz (ACTUALIZADO) -->
            <div class="form-group">
                <label for="txtFkIdReporte"><i class="fas fa-file-alt"></i> Reporte Relacionado</label>
                <select name="txtFkIdReporte" id="txtFkIdReporte" class="form-control" required>
                    <option value="">Selecciona un reporte</option>
                    <?php
                        if (isset($reportes) && is_array($reportes)) {
                            foreach ($reportes as $reporte) {
                                $selected = ($intervencion->fkIdReports == $reporte->id) ? 'selected' : '';
                                // Mostrar descripción del reporte y nombre del aprendiz
                                $textoOpcion = "Reporte #{$reporte->id} - Aprendiz: {$reporte->nombreAprendiz}";
                                if (!empty($reporte->description)) {
                                    $descripcionCorta = strlen($reporte->description) > 50 
                                        ? substr($reporte->description, 0, 50) . '...' 
                                        : $reporte->description;
                                    $textoOpcion .= " - Desc: {$descripcionCorta}";
                                }
                                echo "<option value='".$reporte->id."' $selected>".$textoOpcion."</option>";
                            }
                        } else {
                            echo "<option value=''>No hay reportes disponibles</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- Campo Reporte -->
            <!-- <div class="form-group">
                <label for="txtFkIdReporte">Reporte Relacionado</label>
                <select name="txtFkIdReporte" id="txtFkIdReporte" class="form-control">
                    <option value="">Selecciona un reporte</option>
                    <?php
                        if (isset($reportes) && is_array($reportes)) {
                            foreach ($reportes as $reporte) {
                                $selected = ($intervencion->fkIdReports == $reporte->id) ? 'selected' : '';
                                echo "<option value='".$reporte->id."' $selected>".$reporte->description."</option>";
                            }
                        } else {
                            echo "ERROR";
                        }
                    ?>
                </select>
            </div> -->

            <!-- Campo Usuario -->
            <!-- Campo Usuario (oculto y mostrado) -->
            <input type="hidden" name="txtFkIdUsuario" value="<?php echo $usuarioActual->id; ?>">
            <!-- Campo Usuario (mostrar en el edit) -->
            <div class="form-group">
                <label><i class="fas fa-user"></i> Usuario Resposable</label>
                <?php
                    // CORRECCIÓN: Construir el nombre completo correctamente
                    $nombreCompleto = '';
                    if (isset($usuarioActual)) {
                        $nombreCompleto = ($usuarioActual->firstName ?? '') . ' ' . ($usuarioActual->lastName ?? '');
                        $nombreCompleto = trim($nombreCompleto);
                    }
                ?>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($nombreCompleto); ?>" readonly>
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
                <button type="submit"><i class="fas fa-pen-to-square"></i> Editar Intervención</button>
            </div>
        </form>
    </div>
</div>