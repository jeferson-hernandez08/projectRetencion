<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/grupo/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/grupo/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
        <?php
            if (empty($grupos)) {
                echo '<br>No se encuentran grupos en la base de datos';
            } else {
                foreach ($grupos as $key => $value) {
                    echo
                    "<div class='record'>
                        <span> ID: $value->idGrupo - Ficha: $value->ficha ($value->jornada - $value->modalidad)</span>
                        <div class='buttons'>
                            <a href='/grupo/view/$value->idGrupo'> <button>Consultar</button> </a> 
                            <a href='/grupo/edit/$value->idGrupo'> <button>Editar</button> </a> 
                            <a href='/grupo/delete/$value->idGrupo'> <button>Eliminar</button> </a> 
                        </div>
                    </div>";
                }
            }
        ?>
    </div>
</div>