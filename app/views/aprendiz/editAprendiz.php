<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/aprendiz/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/aprendiz/update" method="post">
            <!-- Campo ID (oculto) -->
            <div class="form-group">
                <label for="txtId">Id del aprendiz</label>
                <input type="text" readonly value="<?php echo $aprendiz->idAprendiz ?>" name="txtId" id="txtId" class="form-control">
            </div>

            <!-- Campo Nombre del aprendiz -->
            <div class="form-group">
                <label for="txtNombre">Nombre del aprendiz</label>
                <input type="text" value="<?php echo $aprendiz->nombre ?>" name="txtNombre" id="txtNombre" class="form-control" required>
            </div>

            <!-- Campo Email del aprendiz -->
            <div class="form-group">
                <label for="txtEmail">Email del aprendiz</label>
                <input type="email" value="<?php echo $aprendiz->email ?>" name="txtEmail" id="txtEmail" class="form-control" required>
            </div>

            <!-- Campo Teléfono -->
            <div class="form-group">
                <label for="txtTelefono">Teléfono</label>
                <input type="text" value="<?php echo $aprendiz->telefono ?>" name="txtTelefono" id="txtTelefono" class="form-control" required>
            </div>

            <!-- Campo Trimestre (actualizado hasta 9) -->
            <div class="form-group">
                <label for="txtTrimestre">Trimestre</label>
                <select name="txtTrimestre" id="txtTrimestre" class="form-control" required>
                    <option value="1" <?php echo ($aprendiz->trimestre == '1') ? 'selected' : '' ?>>1</option>
                    <option value="2" <?php echo ($aprendiz->trimestre == '2') ? 'selected' : '' ?>>2</option>
                    <option value="3" <?php echo ($aprendiz->trimestre == '3') ? 'selected' : '' ?>>3</option>
                    <option value="4" <?php echo ($aprendiz->trimestre == '4') ? 'selected' : '' ?>>4</option>
                    <option value="5" <?php echo ($aprendiz->trimestre == '5') ? 'selected' : '' ?>>5</option>
                    <option value="6" <?php echo ($aprendiz->trimestre == '6') ? 'selected' : '' ?>>6</option>
                    <option value="7" <?php echo ($aprendiz->trimestre == '7') ? 'selected' : '' ?>>7</option>
                    <option value="8" <?php echo ($aprendiz->trimestre == '8') ? 'selected' : '' ?>>8</option>
                    <option value="9" <?php echo ($aprendiz->trimestre == '9') ? 'selected' : '' ?>>9</option>
                </select>
            </div>

            <!-- Campo Grupo -->
            <div class="form-group">
                <label for="txtFkIdGrupo">Grupo</label>
                <select name="txtFkIdGrupo" id="txtFkIdGrupo" class="form-control" required>
                    <option value="">Selecciona un grupo</option>
                    <?php
                        if (isset($grupos) && is_array($grupos)) {
                            foreach ($grupos as $grupo) {
                                $selected = ($aprendiz->fkIdGrupo == $grupo->idGrupo) ? 'selected' : '';
                                echo "<option value='".$grupo->idGrupo."' $selected>".$grupo->ficha." - ".$grupo->jornada."</option>";
                            }
                        } else {
                            echo "ERROR";
                        }
                    ?>
                </select>
            </div>

            <!-- Campo Programa de Formación -->
            <div class="form-group">
                <label for="txtFkIdProgramaFormacion">Programa de Formación</label>
                <select name="txtFkIdProgramaFormacion" id="txtFkIdProgramaFormacion" class="form-control" required>
                    <option value="">Selecciona un programa</option>
                    <?php
                        if (isset($programas) && is_array($programas)) {
                            foreach ($programas as $programa) {
                                $selected = ($aprendiz->fkIdProgramaFormacion == $programa->idProgramaFormacion) ? 'selected' : '';
                                echo "<option value='".$programa->idProgramaFormacion."' $selected>".$programa->nombre."</option>";
                            }
                        } else {
                            echo "ERROR";
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