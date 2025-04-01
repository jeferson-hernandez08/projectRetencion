<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/reporte/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/reporte/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
        <?php
            if (empty($reportes)) {
                echo '<br>No se encuentran reportes en la base de datos';
            } else {
                foreach ($reportes as $key => $value) {
                    echo
                    "<div class='record'>
                        <span> ID: $value->idReporte - $value->estado ($value->fechaCreacion)</span>
                        <div class='buttons'>
                            <a href='/reporte/view/$value->idReporte'> <button>Consultar</button> </a> 
                            <a href='/reporte/edit/$value->idReporte'> <button>Editar</button> </a> 
                            <a href='/reporte/delete/$value->idReporte'> <button>Eliminar</button> </a> 
                        </div>
                    </div>";
                }
            }
        ?>
    </div>
</div>