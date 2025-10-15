<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/reporte/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/reporte/update" method="post">
            <!-- Campo ID (oculto) -->
            <div class="form-group">
                <label for="txtId">Id del reporte</label>
                <input type="text" readonly value="<?php echo $reporte->id ?>" name="txtId" id="txtId" class="form-control">
            </div>

            <!-- Campo Fecha de Creación -->
            <!-- <div class="form-group">
                <label for="txtFechaCreacion">Fecha de Creación</label>
                <input type="datetime-local" value="<?php // echo date('Y-m-d\TH:i', strtotime($reporte->fechaCreacion)); ?>" name="txtFechaCreacion" id="txtFechaCreacion" class="form-control" required>
            </div> -->
            
            <!-- Campo Descripción -->
            <div class="form-group">
                <label for="txtDescripcion">Descripción</label>
                <textarea name="txtDescripcion" id="txtDescripcion" class="form-control" required><?php echo $reporte->description ?></textarea>
            </div>

            <!-- Campo Direccionamiento (select) -->
            <div class="form-group">
                <label for="txtDireccionamiento">Direccionamiento</label>
                <select name="txtDireccionamiento" id="txtDireccionamiento" class="form-control" required>
                    <option value="Coordinador académico" <?php echo ($reporte->addressing == 'Coordinador académico') ? 'selected' : '' ?>>Coordinador académico</option>
                    <option value="Coordinador de formación" <?php echo ($reporte->addressing == 'Coordinador de formación') ? 'selected' : '' ?>>Coordinador de formación</option>
                </select>
            </div>

            <!-- Campo Estado (select) -->
            <div class="form-group">
                <label for="txtEstado">Estado</label>
                <select name="txtEstado" id="txtEstado" class="form-control" required>
                    <option value="Registrado" <?php echo ($reporte->state == 'Registrado') ? 'selected' : '' ?>>Registrado</option>
                    <option value="En proceso" <?php echo ($reporte->state == 'En proceso') ? 'selected' : '' ?>>En proceso</option>
                    <option value="Retenido" <?php echo ($reporte->state == 'Retenido') ? 'selected' : '' ?>>Retenido</option>
                    <option value="Desertado" <?php echo ($reporte->state == 'Desertado') ? 'selected' : '' ?>>Desertado</option>
                </select>
            </div>

            <!-- Campo Aprendiz -->
            <div class="form-group">
                <label for="txtFkIdAprendiz">Aprendiz</label>
                <select name="txtFkIdAprendiz" id="txtFkIdAprendiz" class="form-control" required>
                    <option value="">Selecciona un aprendiz</option>
                    <?php
                        if (isset($aprendices) && is_array($aprendices)) {
                            foreach ($aprendices as $aprendiz) {
                                $selected = ($reporte->fkIdApprentices == $aprendiz->id) ? 'selected' : '';
                                $nombreCompletoAprendiz = $aprendiz->firtsName . ' ' . $aprendiz->lastName;
                                echo "<option value='".$aprendiz->id."' $selected>".$nombreCompletoAprendiz."</option>";
                            }
                        } else {
                            echo "ERROR";
                        }
                    ?>
                </select>
            </div>

            <!-- Campo Usuario -->
            <!-- Campo Usuario (oculto y mostrado) -->
            <input type="hidden" name="txtFkIdUsuario" value="<?php echo $usuarioActual->id; ?>">
            <!-- Campo Usuario (mostrar en el edit) -->
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" class="form-control" value="<?php echo $usuarioActual->firstName . ' ' . $usuarioActual->lastName; ?>" readonly>
            </div>
            <!-- <div class="form-group">
                <label for="txtFkIdUsuario">Usuario</label>
                <select name="txtFkIdUsuario" id="txtFkIdUsuario" class="form-control" required>
                    <option value="">Selecciona un usuario</option>
                    <?php
                        // if (isset($usuarios) && is_array($usuarios)) {
                        //     foreach ($usuarios as $usuario) {
                        //         $selected = ($reporte->fkIdUsuario == $usuario->idUsuario) ? 'selected' : '';
                        //         echo "<option value='".$usuario->idUsuario."' $selected>".$usuario->nombre."</option>";
                        //     }
                        // } else {
                        //     echo "ERROR";
                        // }
                    ?>
                </select>
            </div> -->

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Editar</button>
            </div>
        </form>
    </div>
</div>