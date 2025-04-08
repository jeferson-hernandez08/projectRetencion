<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/categoria/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/categoria/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
        <?php
            // Verificamos si hay categorías disponibles
            if (empty($categorias)) {
                echo '<br>No se encuentran categorías en la base de datos';
            } else {
                // Iteramos a través de las categorías y mostramos la información
                foreach ($categorias as $key => $value) {
                    echo
                    "<div class='record'>
                        <span> ID: $value->idCategoria - $value->nombre ($value->descripcion)</span>
                        <div class='buttons'>
                            <!-- Enlaces para consultar, editar o eliminar la categoría -->
                            <a href='/categoria/view/$value->idCategoria'> <button>Consultar</button> </a>
                            <a href='/categoria/edit/$value->idCategoria'> <button>Editar</button> </a>
                            <a href='/categoria/delete/$value->idCategoria'> <button>Eliminar</button> </a>
                        </div>
                    </div>";
                }
            }
        ?>
    </div>
</div>
