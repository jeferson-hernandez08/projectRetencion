<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/rol/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/rol/create" method="post">
            <!-- Campo Nombre del Rol -->
            <div class="form-group">
                <label for="txtNombre">Nombre del Rol</label>
                <input type="text" name="txtNombre" id="txtNombre" class="form-control" required>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>