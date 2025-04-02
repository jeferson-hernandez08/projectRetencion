<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/aprendiz/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/aprendiz/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
        <?php
            if (empty($aprendices)) {
                echo '<br>No se encuentran aprendices en la base de datos';
            } else {
                foreach ($aprendices as $key => $value) {
                    echo
                    "<div class='record'>
                        <span> ID: $value->idAprendiz - $value->nombre ($value->email) - Trimestre: $value->trimestre</span>
                        <div class='buttons'>
                            <a href='/aprendiz/view/$value->idAprendiz'> <button>Consultar</button> </a> 
                            <a href='/aprendiz/edit/$value->idAprendiz'> <button>Editar</button> </a> 
                            <a href='/aprendiz/delete/$value->idAprendiz'> <button>Eliminar</button> </a> 
                        </div>
                    </div>";
                }
            }
        ?>
    </div>
</div>