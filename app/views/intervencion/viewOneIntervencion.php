<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/intervencion/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($intervencion && is_object($intervencion)) {
                // Usamos DateTime para manejar correctamente la zona horaria
                $fecha = new DateTime($intervencion->creationDate);
                $fechaFormateada = $fecha->format('d/m/Y H:i');
                echo "<div class='record-one'>
                        <div class='record-one__header'>
                            <div class='record-one__icon'>📝</div>
                            <div class='record-one__title'>Detalle de la Intervención</div>
                        </div>
                        <div class='record-one__details'>
                            <div class='record-one__row'>
                                <span class='record-one__label'>ID:</span>
                                <span class='record-one__value'>{$intervencion->id}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Fecha Creación:</span>
                                <span class='record-one__value'>{$fechaFormateada}</span>
                            </div>
                             <!-- NUEVO: Mostrar el aprendiz -->
                            <div class='record-one__row'>
                                <span class='record-one__label'>Intervención del aprendiz:</span>
                                <span class='record-one__value' style='font-weight: bold; color: #2c3e50;'>{$intervencion->nombreAprendiz}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Descripción:</span>
                                <span class='record-one__value'>{$intervencion->description}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Estrategia:</span>
                                <span class='record-one__value'>{$intervencion->nombreEstrategia}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Reporte Relacionado:</span>
                                <span class='record-one__value'>{$intervencion->descripcionReporte}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Usuario Responsable:</span>
                                <span class='record-one__value'>{$intervencion->nombreUsuario}</span>
                            </div>
                        </div>
                      </div>";
            }
        ?>
    </div>
</div>