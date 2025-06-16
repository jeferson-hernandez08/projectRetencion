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
                        <div class='record-one__header'>
                            <div class='record-one__icon'>📝</div>
                            <div class='record-one__title'>Detalle Causa-Reporte</div>
                        </div>
                        <div class='record-one__details'>
                            <div class='record-one__row'>
                                <span class='record-one__label'>ID Reporte:</span>
                                <span class='record-one__value'>{$causaReporte->fkIdReporte}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Descripción Reporte:</span>
                                <span class='record-one__value'>{$causaReporte->reporte_descripcion}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>ID Causa:</span>
                                <span class='record-one__value'>{$causaReporte->fkIdCausa}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Nombre Causa:</span>
                                <span class='record-one__value'>{$causaReporte->causa_nombre}</span>
                            </div>
                        </div>
                      </div>";
            } else {
                echo "<div class='record-one'>No se encontró la relación causa-reporte solicitada</div>";
            }
        ?>
    </div>
</div>