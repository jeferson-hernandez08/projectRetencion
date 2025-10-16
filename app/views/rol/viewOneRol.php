<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/rol/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($rol && is_object($rol)) {
                echo "<div class='record-one'>
                        <div class='record-one__header'>
                            <div class='record-one__icon'>📝</div>
                            <div class='record-one__title'>Detalle del Rol</div>
                        </div>
                        <div class='record-one__details'>
                            <div class='record-one__row'>
                                <span class='record-one__label'>ID:</span>
                                <span class='record-one__value'>{$rol->id}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Nombre:</span>
                                <span class='record-one__value'>{$rol->name}</span>
                            </div>
                        </div>
                      </div>";
            }
        ?>
    </div>
</div>