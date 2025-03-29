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
                <input type="text" value="<?php echo $aprendiz->nombre ?>" name="txtNombre" id="txtNombre" class="form-control">
            </div>

            <!-- Campo Email del aprendiz -->
            <div class="form-group">
                <label for="txtEmail">Email del aprendiz</label>
                <input type="email" value="<?php echo $aprendiz->email ?>" name="txtEmail" id="txtEmail" class="form-control">
            </div>

            <!-- Campo Teléfono -->
            <div class="form-group">
                <label for="txtTelefono">Teléfono</label>
                <input type="text" value="<?php echo $aprendiz->telefono ?>" name="txtTelefono" id="txtTelefono" class="form-control">
            </div>

            <!-- Campo Trimestre -->
            <div class="form-group">
                <label for="txtTrimestre">Trimestre</label>
                <input type="text" value="<?php echo $aprendiz->trimestre ?>" name="txtTrimestre" id="txtTrimestre" class="form-control">
            </div>

            <!-- Campo Programa de Formación -->
            <div class="form-group">
                <label for="txtProgramaFormacion">Programa de Formación</label>
                <input type="text" value="<?php echo $aprendiz->programaFormacion ?>" name="txtProgramaFormacion" id="txtProgramaFormacion" class="form-control">
            </div>

            <!-- Campo Ficha -->
            <div class="form-group">
                <label for="txtFicha">Ficha</label>
                <input type="text" value="<?php echo $aprendiz->ficha ?>" name="txtFicha" id="txtFicha" class="form-control">
            </div>

            <!-- Campo Usuario asociado -->
            <div class="form-group">
                <label for="txtFkIdUsuario">Usuario asociado</label>
                <select name="txtFkIdUsuario" id="txtFkIdUsuario" class="form-control">
                    <option value=''>Selecciona un usuario</option>
                    <?php
                        if (isset($usuarios) && is_array($usuarios)) {
                            foreach ($usuarios as $key => $value) {
                                if ($aprendiz->fkIdUsuario == $value->idUsuario) {
                                    echo "<option value='".$value->idUsuario."' selected>".$value->nombre."</option>";
                                } else {
                                    echo "<option value='".$value->idUsuario."'>".$value->nombre."</option>";
                                }
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
                <select name="txtFkIdGrupo" id="txtFkIdGrupo" class="form-control">
                    <option value=''>Selecciona un grupo</option>
                    <?php
                        if (isset($grupos) && is_array($grupos)) {
                            foreach ($grupos as $key => $value) {
                                if ($aprendiz->fkIdGrupo == $value->idGrupo) {
                                    echo "<option value='".$value->idGrupo."' selected>".$value->ficha."</option>";
                                } else {
                                    echo "<option value='".$value->idGrupo."'>".$value->ficha."</option>";
                                }
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