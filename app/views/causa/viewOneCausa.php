<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/causa/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($causa && is_object($causa)) {
                // echo "<pre>";
                // print_r($causa);
                // echo "<pre>";
                echo "<div class='record-one'>
                        <span>ID: $causa->idCausa</span>
                        <span>Causa: $causa->causa</span>
                        <span>Variables: $causa->variables</span>
                      </div>";
            }
        ?>
    </div>
</div>