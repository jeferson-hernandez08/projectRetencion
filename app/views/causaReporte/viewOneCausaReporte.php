<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/causaReporte/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($causaReporte && is_object($causaReporte)) {
                // echo "<pre>";
                // print_r($causaReporte);
                // echo "<pre>";
                echo "<div class='record-one'>
                        <span>ID Reporte: $causaReporte->fkIdReporte</span>
                        <span>Descripción Reporte: $causaReporte->descripcionReporte</span>
                        <span>ID Causa: $causaReporte->fkIdCausa</span>
                        <span>Nombre Causa: $causaReporte->nombreCausa</span>
                      </div>";
            } else {
                echo "<div class='record-one'>No se encontró la relación causa-reporte solicitada</div>";
            }
        ?>
    </div>
</div>