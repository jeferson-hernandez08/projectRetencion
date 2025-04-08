<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/estrategias/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($estrategia && is_object($estrategia)) {
                // echo "<pre>";
                // print_r($estrategia);
                // echo "<pre>";
                echo "<div class='record-one'>
                        <span>ID: $estrategia->idEstrategias</span>
                        <span>Estrategia: $estrategia->estrategia</span>
                        <span>Categoría: $estrategia->nombreCategoria</span>
                      </div>";
            }
        ?>
    </div>
</div>
