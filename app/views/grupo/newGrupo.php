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
                <label for="txtFicha">Ficha del Grupo</label>
                <input type="text" name="txtFicha" id="txtFicha" class="form-control" required>
            </div>
            
            <!-- Campo Jornada -->
            <div class="form-group">
                <label for="txtJornada">Jornada</label>
                <select name="txtJornada" id="txtJornada" class="form-control" required>
                    <option value="" selected disabled>Seleccione una jornada</option>
                    <option value="Diurna">Diurna</option>
                    <option value="Mixta">Mixta</option>
                    <option value="Nocturna">Nocturna</option>
                </select>
            </div>

            <!-- Campo Modalidad -->
            <div class="form-group">
                <label for="txtModalidad">Modalidad</label>
                <select name="txtModalidad" id="txtModalidad" class="form-control" required>
                    <option value="" selected disabled>Seleccione una modalidad</option>
                    <option value="Presencial">Presencial</option>
                    <option value="Virtual">Virtual</option>
                    <!-- <option value="Híbrida">Híbrida</option> -->
                </select>
            </div>

            <!-- Campo Programa de Formación -->
            <div class="form-group">
                <label for="txtFkIdProgramaFormacion">Programa de Formación</label>
                <select name="txtFkIdProgramaFormacion" id="txtFkIdProgramaFormacion" class="form-control" required>
                    <option value="">Selecciona un programa</option>
                    <?php
                        if (isset($programas) && is_array($programas)) {
                            foreach ($programas as $key => $value) {
                                echo "<option value='".$value->idProgramaFormacion."'>".$value->nombre."</option>";
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