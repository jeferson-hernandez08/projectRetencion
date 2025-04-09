<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/aprendiz/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($aprendiz && is_object($aprendiz)) {    // Se arreglan las vistas y selects
                // echo "<pre>";
                // print_r($aprendiz);
                // echo "<pre>";
                echo "<div class='record-one'>
                        <span>ID: $aprendiz->idAprendiz</span>
                        <span>Nombre: $aprendiz->nombre</span>
                        <span>Email: $aprendiz->email</span>
                        <span>Teléfono: $aprendiz->telefono</span>
                        <span>Trimestre: $aprendiz->trimestre</span>
                        <span>Ficha Grupo: $aprendiz->fichaGrupo</span>
                        <span>Programa Formación: $aprendiz->nombrePrograma</span>  
                      </div>";                                                       // Se deja este <span>Programa Formación: $aprendiz->nombrePrograma</span> por que con fkIdGrupo podemos tomar el programa de formacion
            }
        ?>
    </div>
</div>