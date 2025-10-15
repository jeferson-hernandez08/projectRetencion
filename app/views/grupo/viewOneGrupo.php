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
                                <span class='record-one__value'>{$grupo->id}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Ficha:</span>
                                <span class='record-one__value'>{$grupo->file}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Jornada:</span>
                                <span class='record-one__value'>". (!empty($grupo->shift) ? $grupo->shift : 'No asignado') ."</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Modalidad:</span>
                                <span class='record-one__value'>". (!empty($grupo->modality ) ? $grupo->modality  : 'No asignado') ."</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Programa de Formación:</span>
                                <span class='record-one__value'>{$grupo->nombrePrograma}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Inicio Lectiva:</span>
                                <span class='record-one__value'>" . 
                                    (!empty($grupo->trainingStart) && $grupo->trainingStart != '0000-00-00' ? 
                                    date('d/m/Y', strtotime($grupo->trainingStart)) : 'No asignada') . 
                                "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Fin Lectiva:</span>
                                <span class='record-one__value'>" . 
                                    (!empty($grupo->trainingEnd) && $grupo->trainingEnd != '0000-00-00' ? 
                                    date('d/m/Y', strtotime($grupo->trainingEnd)) : 'No asignada') . 
                                "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Inicio Práctica:</span>
                                <span class='record-one__value'>" . 
                                    (!empty($grupo->practiceStart) && $grupo->practiceStart != '0000-00-00' ? 
                                    date('d/m/Y', strtotime($grupo->practiceStart)) : 'No asignada') . 
                                "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Fin Práctica:</span>
                                <span class='record-one__value'>" . 
                                    (!empty($grupo->practiceEnd) && $grupo->practiceEnd != '0000-00-00' ? 
                                    date('d/m/Y', strtotime($grupo->practiceEnd)) : 'No asignada') . 
                                "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Gestor:</span>
                                <span class='record-one__value'>" . 
                                    (!empty($grupo->managerName) ? $grupo->managerName : 'No asignado') . 
                                "</span>
                            </div>
                        </div>
                      </div>";
            }
        ?>
    </div>
</div>