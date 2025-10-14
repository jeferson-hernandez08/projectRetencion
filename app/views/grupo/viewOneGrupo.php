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
                                <span class='record-one__value'>". (!empty($grupo->jornada) ? $grupo->jornada : 'No asignado') ."</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Modalidad:</span>
                                <span class='record-one__value'>". (!empty($grupo->modalidad) ? $grupo->modalidad : 'No asignado') ."</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Programa de Formación:</span>
                                <span class='record-one__value'>{$grupo->nombrePrograma}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Inicio Lectiva:</span>
                                <span class='record-one__value'>" . 
                                    (!empty($grupo->inicioLectiva) && $grupo->inicioLectiva != '0000-00-00' ? 
                                    date('d/m/Y', strtotime($grupo->inicioLectiva)) : 'No asignada') . 
                                "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Fin Lectiva:</span>
                                <span class='record-one__value'>" . 
                                    (!empty($grupo->finLectiva) && $grupo->finLectiva != '0000-00-00' ? 
                                    date('d/m/Y', strtotime($grupo->finLectiva)) : 'No asignada') . 
                                "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Inicio Práctica:</span>
                                <span class='record-one__value'>" . 
                                    (!empty($grupo->inicioPractica) && $grupo->inicioPractica != '0000-00-00' ? 
                                    date('d/m/Y', strtotime($grupo->inicioPractica)) : 'No asignada') . 
                                "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Fin Práctica:</span>
                                <span class='record-one__value'>" . 
                                    (!empty($grupo->finPractica) && $grupo->finPractica != '0000-00-00' ? 
                                    date('d/m/Y', strtotime($grupo->finPractica)) : 'No asignada') . 
                                "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Gestor:</span>
                                <span class='record-one__value'>" . 
                                    (!empty($grupo->nombreGestor) ? $grupo->nombreGestor : 'No asignado') . 
                                "</span>
                            </div>
                        </div>
                      </div>";
            }
        ?>
    </div>
</div>