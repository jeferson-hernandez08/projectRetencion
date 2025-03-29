<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/aprendiz/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($aprendiz && is_object($aprendiz)) {
                // echo "<pre>";
                // print_r($aprendiz);
                // echo "<pre>";
                echo "<div class='record-one'>
                        <span>ID: $aprendiz->idAprendiz</span>
                        <span>Nombre: $aprendiz->nombre</span>
                        <span>Email: $aprendiz->email</span>
                        <span>Teléfono: $aprendiz->telefono</span>
                        <span>Trimestre: $aprendiz->trimestre</span>
                        <span>Programa Formación: $aprendiz->programaFormacion</span>
                        <span>Ficha: $aprendiz->ficha</span>
                        <span>Usuario asociado: ".($aprendiz->nombreUsuario ?? 'No asignado')."</span>
                        <span>Grupo asociado: ".($aprendiz->fichaGrupo ?? 'No asignado')."</span>
                      </div>";
            }
        ?>
    </div>
</div>