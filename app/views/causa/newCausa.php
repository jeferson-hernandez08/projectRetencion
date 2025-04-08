<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/causa/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/causa/create" method="post">
            <!-- Campo Nombre de la Causa -->
            <div class="form-group">
                <label for="txtCausa">Nombre de la Causa</label>
                <input type="text" name="txtCausa" id="txtCausa" class="form-control" required>
            </div>
            
            <!-- Campo Variables -->
            <div class="form-group">
                <label for="txtVariables">Variables</label>
                <textarea name="txtVariables" id="txtVariables" class="form-control" required></textarea>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>