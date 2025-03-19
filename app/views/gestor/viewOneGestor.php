<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <!-- Botón para regresar a la vista principal de gestores -->
            <a href="/gestor/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if ($gestor && is_object($gestor)) {
                // Mostrar los detalles del gestor
                echo "<div class='record-one'>
                        <span>ID: $gestor->idGestor</span>
                        <span>Nombre Completo: $gestor->nombreCompleto</span>
                        <span>Centro Académico: $gestor->centroAcademico</span>
                        <span>Email: $gestor->email</span>
                        <span>Teléfono: $gestor->telefono</span>
                        <span>Competencias: $gestor->competencias</span>
                      </div>";
            } else {
                echo "<p>No se encontró información del gestor.</p>";
            }
        ?>
    </div>
</div>