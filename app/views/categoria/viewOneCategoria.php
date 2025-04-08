<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/categoria/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            // Verificamos si la categoría es válida y es un objeto
            if($categoria && is_object($categoria)) {
                // Mostramos la información de la categoría
                echo "<div class='record-one'>
                        <span>ID: $categoria->idCategoria</span>
                        <span>Nombre: $categoria->nombre</span>
                        <span>Descripción: $categoria->descripcion</span>
                        <span>Direccionamiento: $categoria->direccionamiento</span>
                        <span>Causa: $categoria->nombreCausa</span>
                      </div>";
            }
        ?>
    </div>
</div>
