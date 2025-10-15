<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/aprendiz/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/aprendiz/create" method="post">
            <!-- Campo Tipo de Documento -->
            <div class="form-group">
                <label for="txtTipoDocumento"><i class="fas fa-address-card"></i> Tipo de Documento</label>
                <select name="txtTipoDocumento" id="txtTipoDocumento" class="form-control" required>
                    <option value="" selected disabled>Seleccione el tipo de documento</option>
                    <option value="CC">Cédula de Ciudadanía (CC)</option>
                    <option value="TI">Tarjeta de Identidad (TI)</option>
                </select>
            </div>

            <!-- Campo Documento -->
            <div class="form-group">
                <label for="txtDocumento"><i class="fas fa-id-badge"></i> Número de Documento</label>
                <input type="text" name="txtDocumento" id="txtDocumento" class="form-control" required>
            </div>

            <!-- Campo Nombres -->
            <div class="form-group">
                <label for="txtNombres"><i class="fas fa-user"></i> Nombres</label>
                <input type="text" name="txtNombres" id="txtNombres" class="form-control" required>
            </div>

            <!-- Campo Apellidos -->
            <div class="form-group">
                <label for="txtApellidos"><i class="fas fa-user-tag"></i> Apellidos</label>
                <input type="text" name="txtApellidos" id="txtApellidos" class="form-control" required>
            </div>

            <!-- Campo Email del Aprendiz -->
            <div class="form-group">
                <label for="txtEmail"><i class="fas fa-envelope"></i> Email del Aprendiz</label>
                <input type="email" name="txtEmail" id="txtEmail" class="form-control" required>
            </div>

            <!-- Campo Estado -->
            <div class="form-group">
                <label for="txtEstado"><i class="fas fa-info-circle"></i> Estado</label>
                <select name="txtEstado" id="txtEstado" class="form-control" required>
                    <option value="" selected disabled>Seleccione el estado</option>
                    <option value="En formación">En formación</option>
                    <option value="En práctica">En práctica</option>
                    <option value="Certificado">Certificado</option>
                    <option value="Desertado">Desertado</option>
                </select>
            </div>

            <!-- Campo Teléfono -->
            <div class="form-group">
                <label for="txtTelefono"><i class="fas fa-phone"></i> Teléfono</label>
                <input type="text" name="txtTelefono" id="txtTelefono" class="form-control" required>
            </div>

            <!-- Campo Trimestre (actualizado hasta 9) -->
            <div class="form-group">
                <label for="txtTrimestre"><i class="fas fa-calendar-alt"></i> Trimestre</label>
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
                <label for="txtFkIdGrupo"><i class="fas fa-users"></i> Grupo</label>
                <select name="txtFkIdGrupo" id="txtFkIdGrupo" class="form-control" required>
                    <option value="">Selecciona un grupo</option>
                    <?php
                        if (isset($grupos) && is_array($grupos)) {
                            foreach ($grupos as $grupo) {
                                echo "<option value='".$grupo->id."'>".$grupo->file." - ".$grupo->shift."</option>";
                            }
                        } else {
                            echo "ERROR";
                        }
                    ?>
                </select>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit"><i class="fas fa-save"></i> Guardar Aprendiz</button>
            </div>
        </form>
    </div>
</div>