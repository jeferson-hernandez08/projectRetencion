<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/usuario/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/usuario/update" method="post">
            <!-- Campo ID (oculto) -->
            <div class="form-group">
                <label for="txtId"><i class="fas fa-id-card"></i> Id del usuario</label>
                <input type="text" readonly value="<?php echo $usuario->idUsuario ?>" name="txtId" id="txtId" class="form-control">
            </div>

            <!-- Campo Nombres del usuario -->
            <div class="form-group">
                <label for="txtNombres"><i class="fas fa-user"></i> Nombres del usuario</label>
                <input type="text" value="<?php echo $usuario->nombres ?>" name="txtNombres" id="txtNombres" class="form-control" required>
            </div>

            <!-- Campo Apellidos del usuario -->
            <div class="form-group">
                <label for="txtApellidos"><i class="fas fa-user-tag"></i> Apellidos del usuario</label>
                <input type="text" value="<?php echo $usuario->apellidos ?>" name="txtApellidos" id="txtApellidos" class="form-control">
            </div>

            <!-- Campo Documento del usuario -->
            <div class="form-group">
                <label for="txtDocumento"><i class="fas fa-id-badge"></i> Documento del usuario</label>
                <input type="text" value="<?php echo $usuario->documento ?>" name="txtDocumento" id="txtDocumento" class="form-control">
            </div>

            <!-- Campo Email del usuario -->
            <div class="form-group">
                <label for="txtEmail"><i class="fas fa-envelope"></i> Email del usuario</label>
                <input type="email" value="<?php echo $usuario->email ?>" name="txtEmail" id="txtEmail" class="form-control" required>
            </div>

            <!-- Campo Contraseña -->
            <div class="form-group">
                <label for="txtPassword"><i class="fas fa-lock"></i> Contraseña</label>
                <input type="password" value="<?php echo $usuario->password ?>" name="txtPassword" id="txtPassword" class="form-control" required>
            </div>

            <!-- Campo Teléfono -->
            <div class="form-group">
                <label for="txtTelefono"><i class="fas fa-phone"></i> Teléfono</label>
                <input type="text" value="<?php echo $usuario->telefono ?>" name="txtTelefono" id="txtTelefono" class="form-control" required>
            </div>

            <!-- Campo Tipo de Coordinador -->
            <div class="form-group">
                <label for="txtTipoCoordinador"><i class="fas fa-user-tie"></i> Tipo de Coordinador</label>
                <select name="txtTipoCoordinador" id="txtTipoCoordinador" class="form-control" required>
                    <option value="No es coordinador" <?php echo ($usuario->tipoCoordinador == 'No es coordinador') ? 'selected' : '' ?>>No es coordinador</option>
                    <option value="Coordinador académico" <?php echo ($usuario->tipoCoordinador == 'Coordinador académico') ? 'selected' : '' ?>>Coordinador académico</option>
                    <option value="Coordinador de formación" <?php echo ($usuario->tipoCoordinador == 'Coordinador de formación') ? 'selected' : '' ?>>Coordinador de formación</option>
                </select>
            </div>

            <!-- Campo Gestor -->
            <div class="form-group">
                <label for="txtGestor"><i class="fas fa-users-cog"></i> Gestor de grupo</label>
                <select name="txtGestor" id="txtGestor" class="form-control" required>
                    <option value="0" <?php echo ($usuario->gestor == 0) ? 'selected' : '' ?>>No</option>
                    <option value="1" <?php echo ($usuario->gestor == 1) ? 'selected' : '' ?>>Sí</option>
                </select>
            </div>

            <!-- Campo Rol del usuario -->
            <div class="form-group">
                <label for="txtFkIdRol"><i class="fas fa-user-shield"></i> Rol del usuario</label>
                <select name="txtFkIdRol" id="txtFkIdRol" class="form-control" required>
                    <option value=''>Selecciona un rol</option>
                    <?php
                        if (isset($roles) && is_array($roles)) {
                            foreach ($roles as $key => $value) {
                                if ($usuario->fkIdRol == $value->idRol) {
                                    echo "<option value='".$value->idRol."' selected>".$value->nombre."</option>";
                                } else {
                                    echo "<option value='".$value->idRol."'>".$value->nombre."</option>";
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
                <button type="submit"><i class="fas fa-pen-to-square"></i> Editar Usuario</button>
            </div>
        </form>
    </div>
</div>