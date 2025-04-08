<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/causa/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/causa/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
        <?php
            if (empty($causas)) {
                echo '<br>No se encuentran causas en la base de datos';
            } else {
                foreach ($causas as $key => $value) {
                    echo
                    "<div class='record'>
                        <span> ID: $value->idCausa - $value->causa</span>
                        <div class='buttons'>
                            <a href='/causa/view/$value->idCausa'> <button>Consultar</button> </a> 
                            <a href='/causa/edit/$value->idCausa'> <button>Editar</button> </a> 
                            <a href='/causa/delete/$value->idCausa'> <button>Eliminar</button> </a> 
                        </div>
                    </div>";
                }
            }
        ?>
    </div>
</div>