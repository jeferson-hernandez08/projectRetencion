<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <!-- Botón para regresar a la vista principal de gestores -->
            <a href="/gestor/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <!-- Formulario para editar un gestor -->
        <form action="/gestor/update" method="post">
            <!-- Campo ID (oculto) -->
            <div class="form-group">
                <label for="txtIdGestor">ID del Gestor</label>
                <input type="text" readonly value="<?php echo $gestor->idGestor ?>" name="txtIdGestor" id="txtIdGestor" class="form-control">
            </div>

            <!-- Campo Nombre Completo -->
            <div class="form-group">
                <label for="txtNombreCompleto">Nombre Completo</label>
                <input type="text" value="<?php echo $gestor->nombreCompleto ?>" name="txtNombreCompleto" id="txtNombreCompleto" class="form-control">
            </div>

            <!-- Campo Centro Académico -->
            <div class="form-group">
                <label for="txtCentroAcademico">Centro Académico</label>
                <input type="text" value="<?php echo $gestor->centroAcademico ?>" name="txtCentroAcademico" id="txtCentroAcademico" class="form-control">
            </div>

            <!-- Campo Email -->
            <div class="form-group">
                <label for="txtEmail">Email</label>
                <input type="email" value="<?php echo $gestor->email ?>" name="txtEmail" id="txtEmail" class="form-control">
            </div>

            <!-- Campo Teléfono -->
            <div class="form-group">
                <label for="txtTelefono">Teléfono</label>
                <input type="text" value="<?php echo $gestor->telefono ?>" name="txtTelefono" id="txtTelefono" class="form-control">
            </div>

            <!-- Campo Competencias -->
            <div class="form-group">
                <label for="txtCompetencias">Competencias</label>
                <textarea name="txtCompetencias" id="txtCompetencias" class="form-control"><?php echo $gestor->competencias ?></textarea>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Editar</button>
            </div>
        </form>
    </div>
</div>