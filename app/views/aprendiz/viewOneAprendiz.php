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
                            <div class='record-one__icon'>👨‍🎓</div>
                            <div class='record-one__title'>Detalle del Aprendiz</div>
                        </div>
                        <div class='record-one__details'>
                            <div class='record-one__row'>
                                <span class='record-one__label'>ID:</span>
                                <span class='record-one__value'>$aprendiz->id</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Tipo Documento:</span>
                                <span class='record-one__value'>" . ($aprendiz->documentType ?? 'No especificado') . "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Documento:</span>
                                <span class='record-one__value'>" . ($aprendiz->document ?? 'No especificado') . "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Nombres:</span>
                                <span class='record-one__value'>" . ($aprendiz->firtsName ?? 'No especificado') . "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Apellidos:</span>
                                <span class='record-one__value'>" . ($aprendiz->lastName ?? 'No especificado') . "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Teléfono:</span>
                                <span class='record-one__value'>". (!empty($aprendiz->phone) ? htmlspecialchars($aprendiz->phone) : 'No asignado') . "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Email:</span>
                                <span class='record-one__value'>". (!empty($aprendiz->email) ? htmlspecialchars($aprendiz->email) : 'No asignado') . "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Estado:</span>
                                <span class='record-one__value'>" . (!empty($aprendiz->status) ? htmlspecialchars($aprendiz->status) : 'No asignado') . "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Trimestre:</span>
                                <span class='record-one__value'>" . (!empty($aprendiz->quarter) ? htmlspecialchars($aprendiz->quarter) : 'No asignado') . "</span>
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