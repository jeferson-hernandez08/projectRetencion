<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/grupo/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/grupo/create" method="post">
            <!-- Campo Ficha del Grupo -->
            <div class="form-group">
                <label for="txtFicha"><i class="fas fa-id-badge"></i> Ficha del Grupo</label>
                <input type="text" name="txtFicha" id="txtFicha" class="form-control" required placeholder="Ingrese el número de ficha">
            </div>

            <!-- Nuevos campos de fechas -->
            <!-- Campo Inicio Lectiva -->
            <div class="form-group">
                <label for="txtInicioLectiva"><i class="fas fa-calendar-day"></i> Inicio Lectiva</label>
                <input type="date" name="txtInicioLectiva" id="txtInicioLectiva" class="form-control">
            </div>

            <!-- Campo Fin Lectiva -->
            <div class="form-group">
                <label for="txtFinLectiva"><i class="fas fa-calendar-day"></i> Fin Lectiva</label>
                <input type="date" name="txtFinLectiva" id="txtFinLectiva" class="form-control">
            </div>

            <!-- Campo Inicio Práctica -->
            <div class="form-group">
                <label for="txtInicioPractica"><i class="fas fa-calendar-check"></i> Inicio Práctica</label>
                <input type="date" name="txtInicioPractica" id="txtInicioPractica" class="form-control">
            </div>

            <!-- Campo Fin Práctica -->
            <div class="form-group">
                <label for="txtFinPractica"><i class="fas fa-calendar-check"></i> Fin Práctica</label>
                <input type="date" name="txtFinPractica" id="txtFinPractica" class="form-control">
            </div>

            <!-- Campo Nombre Gestor -->
            <div class="form-group">
                <label for="txtNombreGestor"><i class="fas fa-user-tie"></i> Nombre del Gestor</label>
                <input type="text" name="txtNombreGestor" id="txtNombreGestor" class="form-control" placeholder="Ingrese el nombre del gestor">
            </div>
            
            <!-- Campo Jornada -->
            <div class="form-group">
                <label for="txtJornada"><i class="fas fa-clock"></i> Jornada</label>
                <select name="txtJornada" id="txtJornada" class="form-control" required>
                    <option value="" selected disabled>Seleccione una jornada</option>
                    <option value="Diurna">Diurna</option>
                    <option value="Mixta">Mixta</option>
                    <option value="Nocturna">Nocturna</option>
                </select>
            </div>

            <!-- Campo Modalidad -->
            <div class="form-group">
                <label for="txtModalidad"><i class="fas fa-laptop-house"></i> Modalidad</label>
                <select name="txtModalidad" id="txtModalidad" class="form-control" required>
                    <option value="" selected disabled>Seleccione una modalidad</option>
                    <option value="Presencial">Presencial</option>
                    <option value="Virtual">Virtual</option>
                    <!-- <option value="Híbrida">Híbrida</option> -->
                </select>
            </div>

            <!-- Campo Programa de Formación -->
            <div class="form-group">
                <label for="txtFkIdProgramaFormacion"><i class="fas fa-chalkboard-teacher"></i> Programa de Formación</label>
                <select name="txtFkIdProgramaFormacion" id="txtFkIdProgramaFormacion" class="form-control" required>
                    <option value="" selected disabled>Selecciona un programa</option>
                    <?php
                        if (isset($programas) && is_array($programas)) {
                            foreach ($programas as $key => $value) {
                                echo "<option value='".$value->id."'>".$value->name."</option>";
                            }
                        } else {
                            echo "ERROR";
                        }
                    ?>
                </select>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit"><i class="fas fa-save"></i> Guardar Grupo</button>
            </div>
        </form>
    </div>
</div>