<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <!-- Botón para regresar a la vista principal de reportes -->
            <a href="/reporte/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <!-- Formulario para editar un reporte -->
        <form action="/reporte/update" method="post">
            <!-- Campo ID (oculto) -->
            <div class="form-group">
                <label for="txtIdReporte">ID del Reporte</label>
                <input type="text" readonly value="<?php echo $reporte->idReporte ?>" name="txtIdReporte" id="txtIdReporte" class="form-control">
            </div>

            <!-- Campo Fecha de Creación -->
            <div class="form-group">
                <label for="txtFechaCreacion">Fecha de Creación</label>
                <input type="date" value="<?php echo $reporte->fechaCreacion ?>" name="txtFechaCreacion" id="txtFechaCreacion" class="form-control">
            </div>

            <!-- Campo Tipo de Reporte -->
            <div class="form-group">
                <label for="txtTipoReporte">Tipo de Reporte</label>
                <input type="text" value="<?php echo $reporte->tipoReporte ?>" name="txtTipoReporte" id="txtTipoReporte" class="form-control">
            </div>

            <!-- Campo Descripción -->
            <div class="form-group">
                <label for="txtDescripcion">Descripción</label>
                <textarea name="txtDescripcion" id="txtDescripcion" class="form-control"><?php echo $reporte->descripcion ?></textarea>
            </div>

            <!-- Campo Conclusiones -->
            <div class="form-group">
                <label for="txtConclusiones">Conclusiones</label>
                <textarea name="txtConclusiones" id="txtConclusiones" class="form-control"><?php echo $reporte->conclusiones ?></textarea>
            </div>

            <!-- Campo Aprendiz -->
            <div class="form-group">
                <label for="txtFkIdAprendiz">Aprendiz</label>
                <select name="txtFkIdAprendiz" id="txtFkIdAprendiz">
                    <option value=''>Selecciona un aprendiz</option>
                    <?php
                    if (isset($aprendices) && is_array($aprendices)) {
                        foreach ($aprendices as $aprendiz) {
                            // Selecciona el aprendiz actual si coincide con el ID
                            if ($reporte->FkIdAprendiz == $aprendiz->id) {
                                echo "<option value='" . $aprendiz->id . "' selected>" . $aprendiz->nombre . "</option>";
                            } else {
                                echo "<option value='" . $aprendiz->id . "'>" . $aprendiz->nombre . "</option>";
                            }
                        }
                    } else {
                        echo "<option value=''>No hay aprendices disponibles</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Campo Gestor -->
            <div class="form-group">
                <label for="txtFkIdGestor">Gestor</label>
                <select name="txtFkIdGestor" id="txtFkIdGestor">
                    <option value=''>Selecciona un gestor</option>
                    <?php
                    if (isset($gestores) && is_array($gestores)) {
                        foreach ($gestores as $gestor) {
                            // Selecciona el gestor actual si coincide con el ID
                            if ($reporte->FkIdGestor == $gestor->id) {
                                echo "<option value='" . $gestor->id . "' selected>" . $gestor->nombre . "</option>";
                            } else {
                                echo "<option value='" . $gestor->id . "'>" . $gestor->nombre . "</option>";
                            }
                        }
                    } else {
                        echo "<option value=''>No hay gestores disponibles</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Editar</button>
            </div>
        </form>
    </div>
</div>