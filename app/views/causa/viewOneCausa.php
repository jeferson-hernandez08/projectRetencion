<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/causa/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($causa && is_object($causa)) {
                // echo "<pre>";
                // print_r($causa);
                // echo "<pre>";
                echo "<div class='record-one'>
                        <div class='record-one__header'>
                            <div class='record-one__icon'>📝</div>
                            <div class='record-one__title'>Detalle de la Causa</div>
                        </div>
                        <div class='record-one__details'>
                            <div class='record-one__row'>
                                <span class='record-one__label'>ID:</span>
                                <span class='record-one__value'>$causa->id</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Causa:</span>
                                <span class='record-one__value'>$causa->cause</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Variables:</span>
                                <span class='record-one__value'>$causa->variable</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Categoría:</span>
                                <span class='record-one__value'>$causa->nombreCategoria</span>
                            </div>
                        </div>
                      </div>";
            }
        ?>
    </div>
</div>