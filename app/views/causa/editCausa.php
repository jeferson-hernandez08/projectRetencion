<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/causa/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/causa/update" method="post">
            <!-- Campo ID (oculto) -->
            <div class="form-group">
                <label for="txtId">Id de la causa</label>
                <input type="text" readonly value="<?php echo $causa->idCausa ?>" name="txtId" id="txtId" class="form-control">
            </div>

            <!-- Campo Nombre de la causa -->
            <div class="form-group">
                <label for="txtCausa">Nombre de la causa</label>
                <input type="text" value="<?php echo $causa->causa ?>" name="txtCausa" id="txtCausa" class="form-control">
            </div>

            <!-- Campo Variables -->
            <div class="form-group">
                <label for="txtVariables">Variables</label>
                <textarea name="txtVariables" id="txtVariables" class="form-control"><?php echo $causa->variables ?></textarea>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Editar</button>
            </div>
        </form>
    </div>
</div>