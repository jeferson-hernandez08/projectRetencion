<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/programaFormacion/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/programaFormacion/create" method="post">
            <!-- Campo Nombre del Programa de Formación -->
            <div class="form-group">
                <label for="txtNombre"><i class="fas fa-graduation-cap"></i> Nombre del Programa de Formación</label>
                <input type="text" name="txtNombre" id="txtNombre" class="form-control" required>
            </div>

            <!-- Campo Nivel del programa de formación -->
            <div class="form-group">
                <label for="txtNivel"><i class="fas fa-chart-line"></i> Nivel del programa de formación</label>
                <select name="txtNivel" id="txtNivel" class="form-control">
                    <option value="">Seleccione un nivel</option>
                    <option value="Tecnólogo">Tecnólogo</option>
                    <option value="Técnico">Técnico</option>
                </select>
            </div>

            <!-- Campo Versión del programa de formación -->
            <div class="form-group">
                <label for="txtVersion"><i class="fas fa-code-branch"></i> Versión del programa de formación</label>
                <input type="text" name="txtVersion" id="txtVersion" class="form-control" placeholder="Ej: 228118 V1, 836114 V2, 842200 V3">
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit"><i class="fas fa-save"></i> Guardar Programa</button>
            </div>
        </form>
    </div>
</div>