<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/causaReporte/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/causaReporte/create" method="post">
            <!-- Campo Reporte -->
            <div class="form-group">
                <label for="txtFkIdReporte">Reporte</label>
                <select name="txtFkIdReporte" id="txtFkIdReporte" class="form-control" required>
                    <option value="">Selecciona un reporte</option>
                    <?php
                        if (isset($reportes) && is_array($reportes)) {
                            foreach ($reportes as $reporte) {
                                echo "<option value='".$reporte->idReporte."'>Reporte #".$reporte->idReporte." - ".substr($reporte->descripcion, 0, 30)."...</option>";
                            }
                        } else {
                            echo "<option value=''>No hay reportes disponibles</option>";
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

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Guardar Relación</button>
            </div>
        </form>
    </div>
</div>