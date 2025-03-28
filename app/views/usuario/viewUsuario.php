<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/usuario/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/usuario/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
        <?php
            if (empty($usuarios)) {
                echo '<br>No se encuentran usuarios en la base de datos';
            } else {
                foreach ($usuarios as $key => $value) {
                    echo
                    "<div class='record'>
                        <span> ID: $value->idUsuario - $value->nombre ($value->email)</span>
                        <div class='buttons'>
                            <a href='/usuario/view/$value->idUsuario'> <button>Consultar</button> </a> 
                            <a href='/usuario/edit/$value->idUsuario'> <button>Editar</button> </a> 
                            <a href='/usuario/delete/$value->idUsuario'> <button>Eliminar</button> </a> 
                        </div>
                    </div>";
                }
            }
        ?>
    </div>
</div>