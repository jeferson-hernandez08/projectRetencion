<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/usuario/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/usuario/create" method="post">
            <!-- Campo Nombre del Usuario -->
            <div class="form-group">
                <label for="txtNombre">Nombre del Usuario</label>
                <input type="text" name="txtNombre" id="txtNombre" class="form-control" required>
            </div>
            
            <!-- Campo Email del Usuario -->
            <div class="form-group">
                <label for="txtEmail">Email del Usuario</label>
                <input type="email" name="txtEmail" id="txtEmail" class="form-control" required>
            </div>

            <!-- Campo Contraseña -->
            <div class="form-group">
                <label for="txtPassword">Contraseña</label>
                <input type="password" name="txtPassword" id="txtPassword" class="form-control" required>
            </div>

            <!-- Campo Teléfono -->
            <div class="form-group">
                <label for="txtTelefono">Teléfono</label>
                <input type="text" name="txtTelefono" id="txtTelefono" class="form-control" required>
            </div>

            <!-- Campo Tipo de Coordinador (actualizado a select) -->
            <div class="form-group">
                <label for="txtTipoCoordinador">Tipo de Coordinador</label>
                <select name="txtTipoCoordinador" id="txtTipoCoordinador" class="form-control" required>
                    <option value="" selected disabled>Seleccione un tipo de coordinador</option>
                    <option value="No es coordinador">No es coordinador</option>
                    <option value="Coordinador académico">Coordinador académico</option>
                    <option value="Coordinador de formación">Coordinador de formación</option>
                </select>
            </div>

            <!-- Campo Gestor -->
            <div class="form-group">
                <label for="txtGestor">Gestor de grupo</label>
                <select name="txtGestor" id="txtGestor" class="form-control" required>
                    <option value="0">No</option>
                    <option value="1">Sí</option>
                </select>
            </div>

            <!-- Campo Rol del Usuario -->
            <div class="form-group">
                <label for="txtFkIdRol">Rol del Usuario</label>
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
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>