<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/programaFormacion/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($programa && is_object($programa)) {
                echo "<div class='record-one'>
                        <div class='record-one__header'>
                            <div class='record-one__icon'>📝</div>
                            <div class='record-one__title'>Detalle del Programa de Formación</div>
                        </div>
                        <div class='record-one__details'>
                            <div class='record-one__row'>
                                <span class='record-one__label'>ID:</span>
                                <span class='record-one__value'>{$programa->idProgramaFormacion}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Nombre:</span>
                                <span class='record-one__value'>{$programa->nombre}</span>
                            </div>
                        </div>
                      </div>";
            }
        ?>
    </div>
</div>