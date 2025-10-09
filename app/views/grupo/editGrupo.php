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
                <label for="txtId"><i class="fas fa-id-card"></i> Id del grupo</label>
                <input type="text" readonly value="<?php echo $grupo->idGrupo ?>" name="txtId" id="txtId" class="form-control">
            </div>

            <!-- Campo Ficha del grupo -->
            <div class="form-group">
                <label for="txtFicha"><i class="fas fa-id-badge"></i> Ficha del grupo</label>
                <input type="text" value="<?php echo $grupo->ficha ?>" name="txtFicha" id="txtFicha" class="form-control">
            </div>

            <!-- Nuevos campos de fechas -->
            <!-- Campo Inicio Lectiva -->
            <div class="form-group">
                <label for="txtInicioLectiva"><i class="fas fa-calendar-day"></i> Inicio Lectiva</label>
                <input type="date" value="<?php echo $grupo->inicioLectiva ?>" name="txtInicioLectiva" id="txtInicioLectiva" class="form-control">
            </div>

            <!-- Campo Fin Lectiva -->
            <div class="form-group">
                <label for="txtFinLectiva"><i class="fas fa-calendar-day"></i> Fin Lectiva</label>
                <input type="date" value="<?php echo $grupo->finLectiva ?>" name="txtFinLectiva" id="txtFinLectiva" class="form-control">
            </div>

            <!-- Campo Inicio Práctica -->
            <div class="form-group">
                <label for="txtInicioPractica"><i class="fas fa-calendar-check"></i> Inicio Práctica</label>
                <input type="date" value="<?php echo $grupo->inicioPractica ?>" name="txtInicioPractica" id="txtInicioPractica" class="form-control">
            </div>

            <!-- Campo Fin Práctica -->
            <div class="form-group">
                <label for="txtFinPractica"><i class="fas fa-calendar-check"></i> Fin Práctica</label>
                <input type="date" value="<?php echo $grupo->finPractica ?>" name="txtFinPractica" id="txtFinPractica" class="form-control">
            </div>

            <!-- Campo Nombre Gestor -->
            <div class="form-group">
                <label for="txtNombreGestor"><i class="fas fa-user-tie"></i> Nombre del Gestor</label>
                <input type="text" value="<?php echo $grupo->nombreGestor ?? '' ?>" name="txtNombreGestor" id="txtNombreGestor" class="form-control" placeholder="Ingrese el nombre del gestor">
            </div>

            <!-- Campo Jornada -->
            <div class="form-group">
                <label for="txtJornada"><i class="fas fa-clock"></i> Jornada</label>
                <select name="txtJornada" id="txtJornada" class="form-control">
                    <option value="Diurna" <?php echo ($grupo->jornada == 'Diurna') ? 'selected' : '' ?>>Diurna</option>
                    <option value="Mixta" <?php echo ($grupo->jornada == 'Mixta') ? 'selected' : '' ?>>Mixta</option>
                    <option value="Nocturna" <?php echo ($grupo->jornada == 'Nocturna') ? 'selected' : '' ?>>Nocturna</option>
                </select>
            </div>

            <!-- Campo Modalidad -->
            <div class="form-group">
                <label for="txtModalidad"><i class="fas fa-laptop-house"></i> Modalidad</label>
                <select name="txtModalidad" id="txtModalidad" class="form-control">
                    <option value="Presencial" <?php echo ($grupo->modalidad == 'Presencial') ? 'selected' : '' ?>>Presencial</option>
                    <option value="Virtual" <?php echo ($grupo->modalidad == 'Virtual') ? 'selected' : '' ?>>Virtual</option>
                    <!-- <option value="Híbrida" <?php echo ($grupo->modalidad == 'Híbrida') ? 'selected' : '' ?>>Híbrida</option> -->
                </select>
            </div>

            <!-- Campo Programa de Formación -->
            <div class="form-group">
                <label for="txtFkIdProgramaFormacion"><i class="fas fa-chalkboard-teacher"></i> Programa de Formación</label>
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
                <button type="submit"><i class="fas fa-pen-to-square"></i> Editar Grupo</button>
            </div>
        </form>
    </div>
</div>