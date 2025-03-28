<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/usuario/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($usuario && is_object($usuario)) {
                // echo "<pre>";
                // print_r($usuario);
                // echo "<pre>";
                echo "<div class='record-one'>
                        <span>ID: $usuario->idUsuario</span>
                        <span>Nombre: $usuario->nombre</span>
                        <span>Email: $usuario->email</span>
                        <span>Teléfono: $usuario->telefono</span>
                        <span>Tipo Coordinador: $usuario->tipoCoordinador</span>
                        <span>Gestor: ".($usuario->gestor ? 'Sí' : 'No')."</span>
                        <span>Rol: $usuario->nombreRol</span>
                      </div>";
            }
        ?>
    </div>
</div>