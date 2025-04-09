<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/intervencion/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($intervencion && is_object($intervencion)) {
                // echo "<pre>";
                // print_r($intervencion);
                // echo "<pre>";
                echo "<div class='record-one'>
                        <span>ID: $intervencion->idIntervencion</span>
                        <span>Fecha Creación: ".date('d/m/Y H:i', strtotime($intervencion->fechaCreacion))."</span>
                        <span>Descripción: $intervencion->descripcion</span>
                        <span>Estrategia: $intervencion->nombreEstrategia</span>
                        <span>Reporte Relacionado: $intervencion->descripcionReporte</span>
                        <span>Usuario Responsable: $intervencion->nombreUsuario</span>
                      </div>";
            }
        ?>
    </div>
</div>