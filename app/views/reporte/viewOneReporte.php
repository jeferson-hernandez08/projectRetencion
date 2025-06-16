<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/reporte/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($reporte && is_object($reporte)) {
                echo "<div class='record-one'>
                        <div class='record-one__header'>
                            <div class='record-one__icon'>📝</div>
                            <div class='record-one__title'>Detalle del Reporte</div>
                        </div>
                        <div class='record-one__details'>
                            <div class='record-one__row'>
                                <span class='record-one__label'>ID:</span>
                                <span class='record-one__value'>{$reporte->idReporte}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Fecha Creación:</span>
                                <span class='record-one__value'>{$reporte->fechaCreacion}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Descripción:</span>
                                <span class='record-one__value'>{$reporte->descripcion}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Direccionamiento:</span>
                                <span class='record-one__value'>{$reporte->direccionamiento}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Estado:</span>
                                <span class='record-one__value'>{$reporte->estado}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Aprendiz:</span>
                                <span class='record-one__value'>{$reporte->nombreAprendiz}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Usuario:</span>
                                <span class='record-one__value'>{$reporte->nombreUsuario}</span>
                            </div>
                        </div>
                      </div>";
            }
        ?>
    </div>
</div>