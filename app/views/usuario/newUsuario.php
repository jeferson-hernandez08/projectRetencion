<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/usuario/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/usuario/create" method="post">
            <!-- Campo Nombres del Usuario -->
            <div class="form-group">
                <label for="txtNombres"><i class="fas fa-user"></i> Nombres del Usuario</label>
                <input type="text" name="txtNombres" id="txtNombres" class="form-control" required>
            </div>

            <!-- Campo Apellidos del Usuario -->
            <div class="form-group">
                <label for="txtApellidos"><i class="fas fa-user-tag"></i> Apellidos del Usuario</label>
                <input type="text" name="txtApellidos" id="txtApellidos" class="form-control">
            </div>

            <!-- Campo Documento del Usuario -->
            <div class="form-group">
                <label for="txtDocumento"><i class="fas fa-id-badge"></i> Documento del Usuario</label>
                <input type="text" name="txtDocumento" id="txtDocumento" class="form-control">
            </div>
            
            <!-- Campo Email del Usuario -->
            <div class="form-group">
                <label for="txtEmail"><i class="fas fa-envelope"></i> Email del Usuario</label>
                <input type="email" name="txtEmail" id="txtEmail" class="form-control" required>
            </div>

            <!-- Campo Contraseña -->
            <div class="form-group">
                <label for="txtPassword"><i class="fas fa-lock"></i> Contraseña</label>
                <input type="password" name="txtPassword" id="txtPassword" class="form-control" required>
            </div>

            <!-- Campo Teléfono -->
            <div class="form-group">
                <label for="txtTelefono"><i class="fas fa-phone"></i> Teléfono</label>
                <input type="text" name="txtTelefono" id="txtTelefono" class="form-control" required>
            </div>

            <!-- Campo Tipo de Coordinador (actualizado a select) -->
            <div class="form-group">
                <label for="txtTipoCoordinador"><i class="fas fa-user-tie"></i> Tipo de Coordinador</label>
                <select name="txtTipoCoordinador" id="txtTipoCoordinador" class="form-control" required>
                    <option value="" selected disabled>Seleccione un tipo de coordinador</option>
                    <option value="No es coordinador">No es coordinador</option>
                    <option value="Coordinador académico">Coordinador académico</option>
                    <option value="Coordinador de formación">Coordinador de formación</option>
                </select>
            </div>

            <!-- Campo Gestor -->
            <div class="form-group">
                <label for="txtGestor"><i class="fas fa-users-cog"></i> Gestor de grupo</label>
                <select name="txtGestor" id="txtGestor" class="form-control" required>
                    <option value="0">No</option>
                    <option value="1">Sí</option>
                </select>
            </div>

            <!-- Campo Rol del Usuario -->
            <div class="form-group">
                <label for="txtFkIdRol"><i class="fas fa-user-shield"></i> Rol del Usuario</label>
                <select name="txtFkIdRol" id="txtFkIdRol" class="form-control" required>
                    <option value="">Selecciona un rol</option>
                    <?php
                        if (isset($roles) && is_array($roles)) {
                            foreach ($roles as $key => $value) {
                                echo "<option value='".$value->idRol."'>".$value->nombre."</option>";
                            }
                        } else {
                            echo "ERROR";
                        }
                    ?>
                </select>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit"><i class="fas fa-save"></i> Guardar Usuario</button>
            </div>
        </form>
    </div>
</div>