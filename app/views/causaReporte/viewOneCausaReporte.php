<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/causaReporte/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($causaReporte && is_object($causaReporte)) {
                echo "<div class='record-one'>
                        <span>ID Reporte: $causaReporte->fkIdReporte</span>
                        <span>Descripción Reporte: $causaReporte->reporte_descripcion</span>
                        <span>ID Causa: $causaReporte->fkIdCausa</span>
                        <span>Nombre Causa: $causaReporte->causa_nombre</span>
                      </div>";
            } else {
                echo "<div class='record-one'>No se encontró la relación causa-reporte solicitada</div>";
            }
        ?>
    </div>
</div>