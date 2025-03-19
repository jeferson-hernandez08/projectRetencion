<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <!-- Botón para regresar a la vista principal de gestores -->
            <a href="/gestor/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <!-- Botón para crear un nuevo gestor -->
            <a href="/gestor/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
        <?php
            if (empty($gestores)) {
                // Si no hay gestores, mostrar un mensaje
                echo '<br>No se encuentran gestores en la base de datos';
            } else {
                // Recorrer la lista de gestores y mostrar cada uno
                foreach ($gestores as $gestor) {
                    echo
                    "<div class='record'>
                        <span> ID: $gestor->idGestor - $gestor->nombreCompleto</span>
                        <div class='buttons'>
                            <!-- Botón para consultar el gestor -->
                            <a href='/gestor/view/$gestor->idGestor'> <button>Consultar</button> </a> 
                            <!-- Botón para editar el gestor -->
                            <a href='/gestor/edit/$gestor->idGestor'> <button>Editar</button> </a> 
                            <!-- Botón para eliminar el gestor -->
                            <a href='/gestor/delete/$gestor->idGestor'> <button>Eliminar</button> </a> 
                        </div>
                    </div>";
                }
            }
        ?>
    </div>
</div>