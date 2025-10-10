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
                <label for="txtId"><i class="fas fa-id-card"></i> Id del aprendiz</label>
                <input type="text" readonly value="<?php echo $aprendiz->idAprendiz ?>" name="txtId" id="txtId" class="form-control">
            </div>

            <!-- Campo Tipo de Documento -->
            <div class="form-group">
                <label for="txtTipoDocumento"><i class="fas fa-address-card"></i> Tipo de Documento</label>
                <select name="txtTipoDocumento" id="txtTipoDocumento" class="form-control" required>
                    <option value="">Seleccione el tipo de documento</option>
                    <option value="CC" <?php echo ($aprendiz->tipoDocumento == 'CC') ? 'selected' : '' ?>>Cédula de Ciudadanía (CC)</option>
                    <option value="TI" <?php echo ($aprendiz->tipoDocumento == 'TI') ? 'selected' : '' ?>>Tarjeta de Identidad (TI)</option>
                </select>
            </div>

            <!-- Campo Documento -->
            <div class="form-group">
                <label for="txtDocumento"><i class="fas fa-id-badge"></i> Número de Documento</label>
                <input type="text" value="<?php echo $aprendiz->documento ?>" name="txtDocumento" id="txtDocumento" class="form-control" required>
            </div>

            <!-- Campo Nombres -->
            <div class="form-group">
                <label for="txtNombres"><i class="fas fa-user"></i> Nombres</label>
                <input type="text" value="<?php echo $aprendiz->nombres ?>" name="txtNombres" id="txtNombres" class="form-control" required>
            </div>

            <!-- Campo Apellidos -->
            <div class="form-group">
                <label for="txtApellidos"><i class="fas fa-user-tag"></i> Apellidos</label>
                <input type="text" value="<?php echo $aprendiz->apellidos ?>" name="txtApellidos" id="txtApellidos" class="form-control" required>
            </div>

            <!-- Campo Email del aprendiz -->
            <div class="form-group">
                <label for="txtEmail"><i class="fas fa-envelope"></i> Email del aprendiz</label>
                <input type="email" value="<?php echo $aprendiz->email ?>" name="txtEmail" id="txtEmail" class="form-control" required>
            </div>

            <!-- Campo Estado -->
            <div class="form-group">
                <label for="txtEstado"><i class="fas fa-info-circle"></i> Estado</label>
                <select name="txtEstado" id="txtEstado" class="form-control" required>
                    <option value="">Seleccione el estado</option>
                    <option value="En formación" <?php echo ($aprendiz->estado == 'En formación') ? 'selected' : '' ?>>En formación</option>
                    <option value="En práctica" <?php echo ($aprendiz->estado == 'En práctica') ? 'selected' : '' ?>>En práctica</option>
                    <option value="Certificado" <?php echo ($aprendiz->estado == 'Certificado') ? 'selected' : '' ?>>Certificado</option>
                    <option value="Desertado" <?php echo ($aprendiz->estado == 'Desertado') ? 'selected' : '' ?>>Desertado</option>
                </select>
            </div>

            <!-- Campo Teléfono -->
            <div class="form-group">
                <label for="txtTelefono"><i class="fas fa-phone"></i> Teléfono</label>
                <input type="text" value="<?php echo $aprendiz->telefono ?>" name="txtTelefono" id="txtTelefono" class="form-control" required>
            </div>

            <!-- Campo Trimestre (actualizado hasta 9) -->
            <div class="form-group">
                <label for="txtTrimestre"><i class="fas fa-calendar-alt"></i> Trimestre</label>
                <select name="txtTrimestre" id="txtTrimestre" class="form-control" required>
                    <option value="" disabled>Seleccione el trimestre</option>
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
                <label for="txtFkIdGrupo"><i class="fas fa-users"></i> Grupo</label>
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

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit"><i class="fas fa-pen-to-square"></i> Editar Aprendiz</button>
            </div>
        </form>
    </div>
</div>