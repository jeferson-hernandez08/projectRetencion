<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <!-- Botón para regresar a la vista principal de reportes -->
            <a href="/reporte/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <!-- Formulario para crear un nuevo reporte -->
        <form action="/reporte/create" method="post">
            <!-- Campo Fecha de Creación -->
            <div class="form-group">
                <label for="txtFechaCreacion">Fecha de Creación</label>
                <input type="date" name="txtFechaCreacion" id="txtFechaCreacion" class="form-control" required>
            </div>

            <!-- Campo Tipo de Reporte -->
            <div class="form-group">
                <label for="txtTipoReporte">Tipo de Reporte</label>
                <input type="text" name="txtTipoReporte" id="txtTipoReporte" class="form-control" required>
            </div>

            <!-- Campo Descripción -->
            <div class="form-group">
                <label for="txtDescripcion">Descripción</label>
                <textarea name="txtDescripcion" id="txtDescripcion" class="form-control" required></textarea>
            </div>

            <!-- Campo Conclusiones -->
            <div class="form-group">
                <label for="txtConclusiones">Conclusiones</label>
                <textarea name="txtConclusiones" id="txtConclusiones" class="form-control" required></textarea>
            </div>

            <!-- Campo Aprendiz -->
            <div class="form-group">
                <label for="txtFkIdAprendiz">Aprendiz</label>
                <select name="txtFkIdAprendiz" id="txtFkIdAprendiz" required>
                    <option value="">Selecciona un aprendiz</option>
                    <?php
                    if (isset($aprendices) && is_array($aprendices)) {
                        foreach ($aprendices as $aprendiz) {
                            echo "<option value='" . $aprendiz->id . "'>" . $aprendiz->nombre . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay aprendices disponibles</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Campo Gestor -->
            <div class="form-group">
                <label for="txtFkIdGestor">Gestor</label>
                <select name="txtFkIdGestor" id="txtFkIdGestor" required>
                    <option value="">Selecciona un gestor</option>
                    <?php
                    if (isset($gestores) && is_array($gestores)) {
                        foreach ($gestores as $gestor) {
                            echo "<option value='" . $gestor->idGestor . "'>" . $gestor->nombreCompleto . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay gestores disponibles</option>";
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