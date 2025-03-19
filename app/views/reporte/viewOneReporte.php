<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <!-- Botón para regresar a la vista principal de reportes -->
            <a href="/reporte/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if ($reporte && is_object($reporte)) {
                // Mostrar los detalles del reporte
                echo "<div class='record-one'>
                        <span>ID: $reporte->idReporte</span>
                        <span>Fecha de Creación: $reporte->fechaCreacion</span>
                        <span>Tipo de Reporte: $reporte->tipoReporte</span>
                        <span>Descripción: $reporte->descripcion</span>
                        <span>Conclusiones: $reporte->conclusiones</span>
                        <span>Aprendiz: $reporte->fkIdAprendiz</span>
                        <span>Gestor: $reporte->fkIdGestor</span>
                      </div>";
            } else {
                echo "<p>No se encontró información del reporte.</p>";
            }
        ?>
    </div>
</div>