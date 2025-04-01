<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/grupo/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/grupo/update" method="post">
            <!-- Campo ID (oculto) -->
            <div class="form-group">
                <label for="txtId">Id del grupo</label>
                <input type="text" readonly value="<?php echo $grupo->idGrupo ?>" name="txtId" id="txtId" class="form-control">
            </div>

            <!-- Campo Ficha del grupo -->
            <div class="form-group">
                <label for="txtFicha">Ficha del grupo</label>
                <input type="text" value="<?php echo $grupo->ficha ?>" name="txtFicha" id="txtFicha" class="form-control">
            </div>

            <!-- Campo Jornada -->
            <div class="form-group">
                <label for="txtJornada">Jornada</label>
                <select name="txtJornada" id="txtJornada" class="form-control">
                    <option value="Diurna" <?php echo ($grupo->jornada == 'Diurna') ? 'selected' : '' ?>>Diurna</option>
                    <option value="Mixta" <?php echo ($grupo->jornada == 'Mixta') ? 'selected' : '' ?>>Mixta</option>
                    <option value="Nocturna" <?php echo ($grupo->jornada == 'Nocturna') ? 'selected' : '' ?>>Nocturna</option>
                </select>
            </div>

            <!-- Campo Modalidad -->
            <div class="form-group">
                <label for="txtModalidad">Modalidad</label>
                <select name="txtModalidad" id="txtModalidad" class="form-control">
                    <option value="Presencial" <?php echo ($grupo->modalidad == 'Presencial') ? 'selected' : '' ?>>Presencial</option>
                    <option value="Virtual" <?php echo ($grupo->modalidad == 'Virtual') ? 'selected' : '' ?>>Virtual</option>
                    <!-- <option value="Híbrida" <?php echo ($grupo->modalidad == 'Híbrida') ? 'selected' : '' ?>>Híbrida</option> -->
                </select>
            </div>

            <!-- Campo Programa de Formación -->
            <div class="form-group">
                <label for="txtFkIdProgramaFormacion">Programa de Formación</label>
                <select name="txtFkIdProgramaFormacion" id="txtFkIdProgramaFormacion" class="form-control">
                    <option value=''>Selecciona un programa</option>
                    <?php
                        if (isset($programas) && is_array($programas)) {
                            foreach ($programas as $key => $value) {
                                if ($grupo->fkIdProgramaFormacion == $value->idProgramaFormacion) {
                                    echo "<option value='".$value->idProgramaFormacion."' selected>".$value->nombre."</option>";
                                } else {
                                    echo "<option value='".$value->idProgramaFormacion."'>".$value->nombre."</option>";
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