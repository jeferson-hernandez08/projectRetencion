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
                <label for="txtId">Id del programa de formación</label>
                <input type="text" readonly value="<?php echo $programa->idProgramaFormacion ?>"  name="txtId" id="txtId" class="form-control">
            </div>

            <!-- Campo Nombre del programa de formación -->
            <div class="form-group">
                <label for="txtNombre">Nombre del programa de formación</label>
                <input type="text" value="<?php echo $programa->nombre ?>" name="txtNombre" id="txtNombre" class="form-control">
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Editar</button>
            </div>
            
        </form>
    </div>
</div>