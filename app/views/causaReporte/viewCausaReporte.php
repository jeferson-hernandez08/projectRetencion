<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/causaReporte/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
        <a href="/causaReporte/new">
            <button>
            <i class="fa fa-plus-circle"></i> Crear causa de reporte
            </button>
        </a>
</div>
    </div>
    <div class="info">
        <?php
            if (empty($causasReportes)) {
                echo '<br>No se encuentran relaciones causa-reporte en la base de datos';
            } else {
                foreach ($causasReportes as $relacion) {
                    echo
                    "<div class='record'>
                        <span>Reporte #$relacion->fkIdReporte - Causa: $relacion->causa_nombre</span>
                        <div class='buttons'> 
                            <a href='/causaReporte/delete/$relacion->fkIdReporte/$relacion->fkIdCausa' 
                            onclick='return confirm(\"¿Está seguro de eliminar esta relación?\")'>     <button>Eliminar Relación</button> </a> 
                        </div>
                    </div>";
                }
            }
        ?>
    </div>
    <!-- <a href='/causaReporte/view/$relacion->fkIdReporte/$relacion->fkIdCausa'>  <button>Consultar</button> </a> 
    <a href='/causaReporte/edit/$relacion->fkIdReporte/$relacion->fkIdCausa'>  <button>Editar</button> </a> -->
</div>