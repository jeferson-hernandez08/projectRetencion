<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/aprendiz/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/aprendiz/create" method="post">
            <!-- Campo Nombre del Aprendiz -->
            <div class="form-group">
                <label for="txtNombre">Nombre del Aprendiz</label>
                <input type="text" name="txtNombre" id="txtNombre" class="form-control" required>
            </div>
            
            <!-- Campo Email del Aprendiz -->
            <div class="form-group">
                <label for="txtEmail">Email del Aprendiz</label>
                <input type="email" name="txtEmail" id="txtEmail" class="form-control" required>
            </div>

            <!-- Campo Teléfono -->
            <div class="form-group">
                <label for="txtTelefono">Teléfono</label>
                <input type="text" name="txtTelefono" id="txtTelefono" class="form-control" required>
            </div>

            <!-- Campo Trimestre (actualizado hasta 9) -->
            <div class="form-group">
                <label for="txtTrimestre">Trimestre</label>
                <select name="txtTrimestre" id="txtTrimestre" class="form-control" required>
                    <option value="" selected disabled>Seleccione el trimestre</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
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
                                echo "<option value='".$grupo->idGrupo."'>".$grupo->ficha." - ".$grupo->jornada."</option>";
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
                                echo "<option value='".$programa->idProgramaFormacion."'>".$programa->nombre."</option>";
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