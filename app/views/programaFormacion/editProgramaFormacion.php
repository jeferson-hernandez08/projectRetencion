<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/programaFormacion/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/programaFormacion/update" method="post">
            <!-- Campo ID (oculto) -->
            <div class="form-group">
                <label for="txtId"><i class="fas fa-id-card"></i> Id del programa de formación</label>
                <input type="text" readonly value="<?php echo $programa->id ?>"  name="txtId" id="txtId" class="form-control">
            </div>

            <!-- Campo Nombre del programa de formación -->
            <div class="form-group">
                <label for="txtNombre"><i class="fas fa-graduation-cap"></i> Nombre del programa de formación</label>
                <input type="text" value="<?php echo $programa->name ?>" name="txtNombre" id="txtNombre" class="form-control">
            </div>

            <!-- Campo Nivel del programa de formación -->
            <div class="form-group">
                <label for="txtNivel"><i class="fas fa-chart-line"></i> Nivel del programa de formación</label>
                <select name="txtNivel" id="txtNivel" class="form-control">
                    <option value="">Seleccione un nivel</option>
                    <option value="Tecnólogo" <?php echo ($programa->level ?? '') == 'Tecnólogo' ? 'selected' : '' ?>>Tecnólogo</option>
                    <option value="Técnico" <?php echo ($programa->level ?? '') == 'Técnico' ? 'selected' : '' ?>>Técnico</option>
                </select>
            </div>

            <!-- Campo Versión del programa de formación -->
            <div class="form-group">
                <label for="txtVersion"><i class="fas fa-code-branch"></i> Versión del programa de formación</label>
                <input type="text" value="<?php echo $programa->version ?? '' ?>" name="txtVersion" id="txtVersion" class="form-control" placeholder="Ej: 228118 V1, 836114 V2, 842200 V3">
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit"><i class="fas fa-pen-to-square"></i> Editar Programa</button>
            </div>
            
        </form>
    </div>
</div>