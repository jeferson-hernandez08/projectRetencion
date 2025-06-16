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
                            <div class='record-one__icon'>📝</div>
                            <div class='record-one__title'>Detalle del Usuario</div>
                        </div>
                        <div class='record-one__details'>
                            <div class='record-one__row'>
                                <span class='record-one__label'>ID:</span>
                                <span class='record-one__value'>{$usuario->idUsuario}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Nombre:</span>
                                <span class='record-one__value'>{$usuario->nombre}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Email:</span>
                                <span class='record-one__value'>{$usuario->email}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Teléfono:</span>
                                <span class='record-one__value'>{$usuario->telefono}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Tipo Coordinador:</span>
                                <span class='record-one__value'>{$usuario->tipoCoordinador}</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Gestor:</span>
                                <span class='record-one__value'>".($usuario->gestor ? 'Sí' : 'No')."</span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Rol:</span>
                                <span class='record-one__value'>{$usuario->nombreRol}</span>
                            </div>
                        </div>
                      </div>";
            }
        ?>
    </div>
</div>