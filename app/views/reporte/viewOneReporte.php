<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/reporte/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($reporte && is_object($reporte)) {
                // echo "<pre>";
                // print_r($reporte);
                // echo "<pre>";
                echo "<div class='record-one'>
                        <span>ID: $reporte->idReporte</span>
                        <span>Fecha Creación: $reporte->fechaCreacion</span>
                        <span>Descripción: $reporte->descripcion</span>
                        <span>Direccionamiento: $reporte->direccionamiento</span>
                        <span>Estado: $reporte->estado</span>
                        <span>Aprendiz: $reporte->nombreAprendiz</span>
                        <span>Usuario: $reporte->nombreUsuario</span>
                      </div>";
            }
        ?>
    </div>
</div>