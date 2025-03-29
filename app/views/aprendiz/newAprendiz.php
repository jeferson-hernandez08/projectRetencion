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

            <!-- Campo Trimestre -->
            <div class="form-group">
                <label for="txtTrimestre">Trimestre</label>
                <input type="text" name="txtTrimestre" id="txtTrimestre" class="form-control" required>
            </div>

            <!-- Campo Programa de Formación -->
            <div class="form-group">
                <label for="txtProgramaFormacion">Programa de Formación</label>
                <input type="text" name="txtProgramaFormacion" id="txtProgramaFormacion" class="form-control" required>
            </div>

            <!-- Campo Ficha -->
            <div class="form-group">
                <label for="txtFicha">Ficha</label>
                <input type="text" name="txtFicha" id="txtFicha" class="form-control" required>
            </div>

            <!-- Campo Usuario asociado -->
            <div class="form-group">
                <label for="txtFkIdUsuario">Usuario asociado</label>
                <select name="txtFkIdUsuario" id="txtFkIdUsuario" class="form-control" required>
                    <option value="">Selecciona un usuario</option>
                    <?php
                        if (isset($usuarios) && is_array($usuarios)) {
                            foreach ($usuarios as $key => $value) {
                                echo "<option value='".$value->idUsuario."'>".$value->nombre."</option>";
                            }
                        } else {
                            echo "ERROR";
                        }
                    ?>
                </select>
            </div>

            <!-- Campo Grupo asociado -->
            <div class="form-group">
                <label for="txtFkIdGrupo">Grupo asociado</label>
                <select name="txtFkIdGrupo" id="txtFkIdGrupo" class="form-control" required>
                    <option value="">Selecciona un grupo</option>
                    <?php
                        if (isset($grupos) && is_array($grupos)) {
                            foreach ($grupos as $key => $value) {
                                echo "<option value='".$value->idGrupo."'>".$value->ficha."</option>";
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