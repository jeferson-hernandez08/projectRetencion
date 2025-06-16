<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/grupo/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($grupo && is_object($grupo)) {
                echo "<div class='record-one'>
                        <div class='record-one__header'>
                            <div class='record-one__icon'>📝</div>
                            <div class='record-one__title'>Detalle del Grupo</div>
                        </div>
                        <div class='record-one__details'>
                            <div class='record-one__row'>
                                <span class='record-one__label'>ID:</span>
                                <span class='record-one__value'>{$grupo->idGrupo}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Ficha:</span>
                                <span class='record-one__value'>{$grupo->ficha}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Jornada:</span>
                                <span class='record-one__value'>{$grupo->jornada}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Modalidad:</span>
                                <span class='record-one__value'>{$grupo->modalidad}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Programa de Formación:</span>
                                <span class='record-one__value'>{$grupo->nombrePrograma}</span>
                            </div>
                        </div>
                      </div>";
            }
        ?>
    </div>
</div>