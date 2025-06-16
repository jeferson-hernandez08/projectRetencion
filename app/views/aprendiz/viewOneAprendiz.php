<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/aprendiz/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($aprendiz && is_object($aprendiz)) {    // Se arreglan las vistas y selects
                // echo "<pre>";
                // print_r($aprendiz);
                // echo "<pre>";
                echo "<div class='record-one'>
                        <div class='record-one__header'>
                            <div class='record-one__icon'>📝</div>
                            <div class='record-one__title'>Detalle del aprendiz</div>
                        </div>
                        <div class='record-one__details'>
                            <div class='record-one__row'>
                                <span class='record-one__label'>ID:</span>
                                <span class='record-one__value'>$aprendiz->idAprendiz</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Nombre:</span>
                                <span class='record-one__value'>$aprendiz->nombre</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Email:</span>
                                <span class='record-one__value'>$aprendiz->email</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Teléfono:</span>
                                <span class='record-one__value'>$aprendiz->telefono</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Trimestre:</span>
                                <span class='record-one__value'>$aprendiz->trimestre</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Ficha Grupo:</span>
                                <span class='record-one__value'>$aprendiz->fichaGrupo</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Programa Formación:</span>
                                <span class='record-one__value'>$aprendiz->nombrePrograma</span>
                            </div>  
                        </div>
                      </div>";                                                       // Se deja este <span>Programa Formación: $aprendiz->nombrePrograma</span> por que con fkIdGrupo podemos tomar el programa de formacion
            }
        ?>
    </div>
</div>