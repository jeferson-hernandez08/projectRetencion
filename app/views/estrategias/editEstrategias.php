<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/estrategias/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/estrategias/update" method="post">
            <!-- Campo ID (oculto) -->
            <div class="form-group">
                <label for="txtId">Id de la estrategia</label>
                <input type="text" readonly value="<?php echo $estrategia->idEstrategias ?>" name="txtId" id="txtId" class="form-control">
            </div>

            <!-- Campo Nombre de la estrategia -->
            <div class="form-group">
                <label for="txtEstrategia">Nombre de la estrategia</label>
                <input type="text" value="<?php echo $estrategia->estrategia ?>" name="txtEstrategia" id="txtEstrategia" class="form-control">
            </div>

            <!-- Campo Categoría -->
            <div class="form-group">
                <label for="txtFkIdCategoria">Categoría</label>
                <select name="txtFkIdCategoria" id="txtFkIdCategoria" class="form-control">
                    <option value=''>Selecciona una categoría</option>
                    <?php
                        if (isset($categorias) && is_array($categorias)) {
                            foreach ($categorias as $key => $value) {
                                if ($estrategia->fkIdCategoria == $value->idCategoria) {
                                    echo "<option value='".$value->idCategoria."' selected>".$value->nombre."</option>";
                                } else {
                                    echo "<option value='".$value->idCategoria."'>".$value->nombre."</option>";
                                }
                            }
                        } else {
                            echo "ERROR";
                        }
                    ?>
                </select>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Editar</button>
            </div>
        </form>
    </div>
</div>