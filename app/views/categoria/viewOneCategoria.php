<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/categoria/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            // Verificamos si la categoría es válida y es un objeto
            if($categoria && is_object($categoria)) {
                echo "<div class='record-one'>
                        <div class='record-one__header'>
                            <div class='record-one__icon'>📝</div>
                            <div class='record-one__title'>Detalle de la categoría</div>
                        </div>
                        <div class='record-one__details'>
                            <div class='record-one__row'>
                                <span class='record-one__label'>ID:</span>
                                <span class='record-one__value'>{$categoria->idCategoria}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Nombre:</span>
                                <span class='record-one__value'>{$categoria->nombre}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Descripción:</span>
                                <span class='record-one__value'>{$categoria->descripcion}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Direccionamiento:</span>
                                <span class='record-one__value'>{$categoria->direccionamiento}</span>
                            </div>
                        </div>
                      </div>";
            }
        ?>
    </div>
</div>