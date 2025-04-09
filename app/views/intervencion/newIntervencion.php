<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/intervencion/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/intervencion/create" method="post">
            <!-- Campo Fecha de Creación -->
            <div class="form-group">
                <label for="txtFechaCreacion">Fecha de Creación</label>
                <input type="datetime-local" name="txtFechaCreacion" id="txtFechaCreacion" class="form-control" required>
            </div>
            
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
                                echo "<option value='".$estrategia->idEstrategias."'>".$estrategia->estrategia."</option>";
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
                <select name="txtFkIdReporte" id="txtFkIdReporte" class="form-control" required>
                    <option value="">Selecciona un reporte</option>
                    <?php
                        if (isset($reportes) && is_array($reportes)) {
                            foreach ($reportes as $reporte) {
                                echo "<option value='".$reporte->idReporte."'>".$reporte->descripcion."</option>";
                            }
                        } else {
                            echo "ERROR";
                        }
                    ?>
                </select>
            </div>

            <!-- Campo Usuario -->
            <div class="form-group">
                <label for="txtFkIdUsuario">Usuario Responsable</label>
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