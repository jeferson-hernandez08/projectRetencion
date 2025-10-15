<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/usuario/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($usuario && is_object($usuario)) {
                echo "<div class='record-one'>
                        <div class='record-one__header'>
                            <div class='record-one__icon'>🤵🏼</div>
                            <div class='record-one__title'>Detalle del Usuario</div>
                        </div>
                        <div class='record-one__details'>
                            <div class='record-one__row'>
                                <span class='record-one__label'>ID Usuario:</span>
                                <span class='record-one__value'>{$usuario->id}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Nombres:</span>
                                <span class='record-one__value'>" . ($usuario->firstName ?? 'No especificado') . "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Apellidos:</span>
                                <span class='record-one__value'>" . ($usuario->lastName ?? 'No especificado') . "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Documento:</span>
                                <span class='record-one__value'>" . (!empty($usuario->document) ? htmlspecialchars($usuario->document) : 'No asignado') . "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Email:</span>
                                <span class='record-one__value'>{$usuario->email}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Teléfono:</span>
                                <span class='record-one__value'>" . (!empty($usuario->phone) ? htmlspecialchars($usuario->phone) : 'No asignado') . "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Tipo Coordinador:</span>
                                <span class='record-one__value'>" . ($usuario->coordinadorType ?? 'No especificado') . "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Gestor:</span>
                                <span class='record-one__value'>" . ($usuario->manager ? 'Sí' : 'No') . "</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Rol:</span>
                                <span class='record-one__value'>" . ($usuario->nombreRol ?? 'No especificado') . "</span>
                            </div>
                        </div>
                      </div>";
            }
        ?>
    </div>
</div>