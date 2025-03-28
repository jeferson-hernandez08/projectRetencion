<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/rol/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($rol && is_object($rol)) {
                // echo "<pre>";
                // print_r($rol);
                // echo "<pre>";
                echo "<div class='record-one'>
                        <span>ID: $rol->idRol</span>
                        <span>Nombre: $rol->nombre</span>
                      </div>";
            }
        ?>
    </div>
</div>