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
                            <div class='record-one__row'>
                                <span class='record-one__label'>Nivel:</span>
                                <span class='record-one__value'>" . ($programa->nivel ?? 'No especificado') . "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Versión:</span>
                                <span class='record-one__value'>" . ($programa->version ?? 'No especificada') . "</span>
                            </div>
                        </div>
                      </div>";
            } else {
                echo "<div class='no-records-message'>
                        <div class='no-records-icon'>📝</div>
                        <h3>Programa de Formación No Encontrado</h3>
                        <p>El programa de formación que buscas no existe o ha sido eliminado.</p>
                        <a href='/programaFormacion/view' class='create-report-btn'>Volver a Programas</a>
                      </div>";
            }
        ?>
    </div>
</div>