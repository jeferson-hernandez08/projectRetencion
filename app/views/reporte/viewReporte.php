<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <!-- Botón para regresar a la vista principal de reportes -->
            <a href="/reporte/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <!-- Botón para crear un nuevo reporte -->
            <a href="/reporte/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
        <?php
            if (empty($reportes)) {
                // Si no hay reportes, mostrar un mensaje
                echo '<br>No se encuentran reportes en la base de datos';
            } else {
                // Recorrer la lista de reportes y mostrar cada uno
                foreach ($reportes as $reporte) {
                    echo
                    "<div class='record'>
                        <span> ID: $reporte->idReporte - $reporte->tipoReporte</span>
                        <div class='buttons'>
                            <!-- Botón para consultar el reporte -->
                            <a href='/reporte/view/$reporte->idReporte'> <button>Consultar</button> </a> 
                            <!-- Botón para editar el reporte -->
                            <a href='/reporte/edit/$reporte->idReporte'> <button>Editar</button> </a> 
                            <!-- Botón para eliminar el reporte -->
                            <a href='/reporte/delete/$reporte->idReporte'> <button>Eliminar</button> </a> 
                        </div>
                    </div>";
                }
            }
        ?>
    </div>
</div>