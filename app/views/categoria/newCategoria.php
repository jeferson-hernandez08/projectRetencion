<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/categoria/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/categoria/create" method="post">
            <!-- Campo Nombre de la Categoría -->
            <div class="form-group">
                <label for="txtNombre">Nombre de la Categoría</label>
                <input type="text" name="txtNombre" id="txtNombre" class="form-control" required>
            </div>
            
            <!-- Campo Descripción -->
            <div class="form-group">
                <label for="txtDescripcion">Descripción</label>
                <textarea name="txtDescripcion" id="txtDescripcion" class="form-control" required></textarea>
            </div>

            <!-- Campo Direccionamiento (select) -->
            <div class="form-group">
                <label for="txtDireccionamiento">Direccionamiento</label>
                <select name="txtDireccionamiento" id="txtDireccionamiento" class="form-control" required>
                    <option value="" selected disabled>Seleccione un tipo de direccionamiento</option>
                    <option value="Coordinador académico">Coordinador académico</option>
                    <option value="Coordinador de formación">Coordinador de formación</option>
                </select>
            </div>

            <!-- Campo Causa (select) -->
            <div class="form-group">
                <label for="txtFkIdCausa">Causa</label>
                <select name="txtFkIdCausa" id="txtFkIdCausa" class="form-control" required>
                    <option value="">Selecciona una causa</option>
                    <?php
                        if (isset($causas) && is_array($causas)) {
                            foreach ($causas as $causa) {
                                echo "<option value='".$causa->idCausa."'>".$causa->nombre."</option>";
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
