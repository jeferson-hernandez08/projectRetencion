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
                <label for="txtId">Id del usuario</label>
                <input type="text" readonly value="<?php echo $usuario->idUsuario ?>" name="txtId" id="txtId" class="form-control">
            </div>

            <!-- Campo Nombre del usuario -->
            <div class="form-group">
                <label for="txtNombre">Nombre del usuario</label>
                <input type="text" value="<?php echo $usuario->nombre ?>" name="txtNombre" id="txtNombre" class="form-control">
            </div>

            <!-- Campo Email del usuario -->
            <div class="form-group">
                <label for="txtEmail">Email del usuario</label>
                <input type="email" value="<?php echo $usuario->email ?>" name="txtEmail" id="txtEmail" class="form-control">
            </div>

            <!-- Campo Contraseña -->
            <div class="form-group">
                <label for="txtPassword">Contraseña</label>
                <input type="password" value="<?php echo $usuario->password ?>" name="txtPassword" id="txtPassword" class="form-control">
            </div>

            <!-- Campo Teléfono -->
            <div class="form-group">
                <label for="txtTelefono">Teléfono</label>
                <input type="text" value="<?php echo $usuario->telefono ?>" name="txtTelefono" id="txtTelefono" class="form-control">
            </div>

            <!-- Campo Tipo de Coordinador (Actualizado a select) -->
            <div class="form-group">
                <label for="txtTipoCoordinador">Tipo de Coordinador</label>
                <select name="txtTipoCoordinador" id="txtTipoCoordinador" class="form-control">
                    <option value="No es coordinador" <?php echo ($usuario->tipoCoordinador == 'No es coordinador') ? 'selected' : '' ?>>No es coordinador</option>
                    <option value="Coordinador académico" <?php echo ($usuario->tipoCoordinador == 'Coordinador académico') ? 'selected' : '' ?>>Coordinador académico</option>
                    <option value="Coordinador de formación" <?php echo ($usuario->tipoCoordinador == 'Coordinador de formación') ? 'selected' : '' ?>>Coordinador de formación</option>
                </select>
            </div>

            <!-- Campo Gestor -->
            <div class="form-group">
                <label for="txtGestor">Gestor de grupo</label>
                <select name="txtGestor" id="txtGestor" class="form-control">
                    <option value="0" <?php echo ($usuario->gestor == 0) ? 'selected' : '' ?>>No</option>
                    <option value="1" <?php echo ($usuario->gestor == 1) ? 'selected' : '' ?>>Sí</option>
                </select>
            </div>

            <!-- Campo Rol del usuario -->
            <div class="form-group">
                <label for="txtFkIdRol">Rol del usuario</label>
                <select name="txtFkIdRol" id="txtFkIdRol" class="form-control">
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
                <button type="submit">Editar</button>
            </div>
        </form>
    </div>
</div>