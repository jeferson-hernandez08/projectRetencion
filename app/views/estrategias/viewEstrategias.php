<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/estrategias/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/estrategias/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
        <?php
            // Verificamos si no hay estrategias en la base de datos
            if (empty($estrategias)) {
                echo '<br>No se encuentran estrategias en la base de datos';
            } else {
                // Si hay estrategias, las listamos
                foreach ($estrategias as $key => $value) {
                    echo
                    "<div class='record'>
                        <span> ID: $value->idEstrategias - $value->estrategia (Categoría: $value->idEstrategias)</span>
                        <div class='buttons'>
                            <a href='/estrategias/view/$value->idEstrategias'> <button>Consultar</button> </a> 
                            <a href='/estrategias/edit/$value->idEstrategias'> <button>Editar</button> </a> 
                            <a href='/estrategias/delete/$value->idEstrategias'> <button>Eliminar</button> </a> 
                        </div>
                    </div>";
                }
            }
        ?>
    </div>
</div>