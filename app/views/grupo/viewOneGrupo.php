<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/grupo/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($grupo && is_object($grupo)) {
                // echo "<pre>";
                // print_r($grupo);
                // echo "<pre>";
                echo "<div class='record-one'>
                        <span>ID: $grupo->idGrupo</span>
                        <span>Ficha: $grupo->ficha</span>
                        <span>Jornada: $grupo->jornada</span>
                        <span>Modalidad: $grupo->modalidad</span>
                        <span>Programa de Formación: $grupo->nombrePrograma</span>
                      </div>";
            }
        ?>
    </div>
</div>