<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/estrategias/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($estrategia && is_object($estrategia)) {
                echo "<div class='record-one'>
                        <div class='record-one__header'>
                            <div class='record-one__icon'>📝</div>
                            <div class='record-one__title'>Detalle de la Estrategia</div>
                        </div>
                        <div class='record-one__details'>
                            <div class='record-one__row'>
                                <span class='record-one__label'>ID:</span>
                                <span class='record-one__value'>{$estrategia->idEstrategias}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Estrategia:</span>
                                <span class='record-one__value'>{$estrategia->estrategia}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Categoría:</span>
                                <span class='record-one__value'>{$estrategia->nombreCategoria}</span>
                            </div>
                        </div>
                      </div>";
            }
        ?>
    </div>
</div>