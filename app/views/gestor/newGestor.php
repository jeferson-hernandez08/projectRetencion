<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <!-- Botón para regresar a la vista principal de gestores -->
            <a href="/gestor/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <!-- Formulario para crear un nuevo gestor -->
        <form action="/gestor/create" method="post">
            <!-- Campo Nombre Completo -->
            <div class="form-group">
                <label for="txtNombreCompleto">Nombre Completo</label>
                <input type="text" name="txtNombreCompleto" id="txtNombreCompleto" class="form-control" required>
            </div>

            <!-- Campo Centro Académico -->
            <div class="form-group">
                <label for="txtCentroAcademico">Centro Académico</label>
                <input type="text" name="txtCentroAcademico" id="txtCentroAcademico" class="form-control" required>
            </div>

            <!-- Campo Email -->
            <div class="form-group">
                <label for="txtEmail">Email</label>
                <input type="email" name="txtEmail" id="txtEmail" class="form-control" required>
            </div>

            <!-- Campo Teléfono -->
            <div class="form-group">
                <label for="txtTelefono">Teléfono</label>
                <input type="text" name="txtTelefono" id="txtTelefono" class="form-control" required>
            </div>

            <!-- Campo Competencias -->
            <div class="form-group">
                <label for="txtCompetencias">Competencias</label>
                <textarea name="txtCompetencias" id="txtCompetencias" class="form-control" required></textarea>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>