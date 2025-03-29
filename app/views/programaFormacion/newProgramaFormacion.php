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
                <label for="txtNombre">Nombre del Programa de Formación</label>
                <input type="text" name="txtNombre" id="txtNombre" class="form-control" required>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>