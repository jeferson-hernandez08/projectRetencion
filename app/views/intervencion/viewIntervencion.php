<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/intervencion/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/intervencion/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
        <?php
            if (empty($intervenciones)) {
                echo '<br>No se encuentran intervenciones en la base de datos';
            } else {
                foreach ($intervenciones as $intervencion) {
                    $fechaFormateada = date('d/m/Y H:i', strtotime($intervencion->fechaCreacion));
                    echo
                    "<div class='record'>
                        <span>ID: $intervencion->idIntervencion - $fechaFormateada</span>
                        <div class='buttons'>
                            <a href='/intervencion/view/$intervencion->idIntervencion'> <button>Consultar</button> </a> 
                            <a href='/intervencion/edit/$intervencion->idIntervencion'> <button>Editar</button> </a> 
                            <a href='/intervencion/delete/$intervencion->idIntervencion'> <button>Eliminar</button> </a> 
                        </div>
                    </div>";
                }
            }
        ?>
    </div>
</div>