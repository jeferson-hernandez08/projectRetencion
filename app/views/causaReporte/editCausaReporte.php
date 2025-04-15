<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/causaReporte/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/causaReporte/update" method="post">
            <!-- Campos ocultos para los IDs originales -->
            <input type="hidden" name="txtOldFkIdReporte" value="<?php echo $causaReporte->fkIdReporte ?>">
            <input type="hidden" name="txtOldFkIdCausa" value="<?php echo $causaReporte->fkIdCausa ?>">

            <!-- Campo Reporte Original (solo lectura) -->
            <div class="form-group">
                <label>Reporte Actual</label>
                <input type="text" class="form-control" readonly 
                       value="Reporte #<?php echo $causaReporte->fkIdReporte ?> - <?php echo substr($causaReporte->descripcionReporte, 0, 30) ?>...">
            </div>

            <!-- Campo Causa Original (solo lectura) -->
            <div class="form-group">
                <label>Causa Actual</label>
                <input type="text" class="form-control" readonly 
                    value="<?php echo $causaReporte->causa_nombre ?>">
            </div>

            <!-- Campo Nuevo Reporte -->
            <div class="form-group">
                <label for="txtNewFkIdReporte">Nuevo Reporte</label>
                <select name="txtNewFkIdReporte" id="txtNewFkIdReporte" class="form-control" required>
                    <option value="">Selecciona un nuevo reporte</option>
                    <?php
                        if (isset($reportes) && is_array($reportes)) {
                            foreach ($reportes as $reporte) {
                                $selected = ($reporte->idReporte == $causaReporte->fkIdReporte) ? 'selected' : '';
                                echo "<option value='".$reporte->idReporte."' $selected>Reporte #".$reporte->idReporte." - ".substr($reporte->descripcion, 0, 30)."...</option>";
                            }
                        } else {
                            echo "<option value=''>No hay reportes disponibles</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- Campo Nueva Causa -->
            <div class="form-group">
                <label for="txtNewFkIdCausa">Nueva Causa</label>
                <select name="txtNewFkIdCausa" id="txtNewFkIdCausa" class="form-control" required>
                    <option value="">Selecciona una nueva causa</option>
                    <?php
                        if (isset($causas) && is_array($causas)) {
                            foreach ($causas as $causa) {
                                $selected = ($causa->idCausa == $causaReporte->fkIdCausa) ? 'selected' : '';
                                echo "<option value='".$causa->idCausa."' $selected>".$causa->causa."</option>";
                            }
                        } else {
                            echo "<option value=''>No hay causas disponibles</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Actualizar Relación</button>
            </div>
        </form>
    </div>
</div>