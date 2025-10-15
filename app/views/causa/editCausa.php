<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/causa/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/causa/update" method="post">
            <!-- Campo ID (oculto) -->
            <div class="form-group">
                <label for="txtId">Id de la causa</label>
                <input type="text" readonly value="<?php echo $causa->id ?>" name="txtId" id="txtId" class="form-control">
            </div>

            <!-- Campo Causa -->
            <div class="form-group">
                <label for="txtCausa">Causa</label>
                <input type="text" value="<?php echo $causa->cause ?>" name="txtCausa" id="txtCausa" class="form-control" required>
            </div>

            <!-- Campo Variables -->
            <div class="form-group">
                <label for="txtVariables">Variables</label>
                <input type="text" value="<?php echo $causa->variable ?>" name="txtVariables" id="txtVariables" class="form-control" required>
            </div>

            <!-- Campo Categoría -->
            <div class="form-group">
                <label for="txtFkIdCategoria">Categoría</label>
                <select name="txtFkIdCategoria" id="txtFkIdCategoria" class="form-control" required>
                    <option value=''>Selecciona una categoría</option>
                    <?php
                        if (isset($categorias) && is_array($categorias)) {
                            foreach ($categorias as $key => $value) {
                                if ($causa->fkIdCategories == $value->id) {
                                    echo "<option value='".$value->id."' selected>".$value->name."</option>";
                                } else {
                                    echo "<option value='".$value->id."'>".$value->name."</option>";
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