<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/rol/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/rol/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
        <?php
            if (empty($roles)) {
                echo '<br>No se encuentran roles en la base de datos';
            } else {
                foreach ($roles as $key => $value) {
                    echo
                    "<div class='record'>
                        <span> ID: $value->idRol - $value->nombre</span>
                        <div class='buttons'>
                            <a href='/rol/view/$value->idRol'> <button>Consultar</button> </a> 
                            <a href='/rol/edit/$value->idRol'> <button>Editar</button> </a> 
                            <a href='/rol/delete/$value->idRol'> <button>Eliminar</button> </a> 
                        </div>
                    </div>";
                }
            }
        ?>
    </div>
</div>