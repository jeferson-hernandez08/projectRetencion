<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/causa/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/causa/create" method="post">
            <!-- Campo Causa -->
            <div class="form-group">
                <label for="txtCausa">Causa</label>
                <input type="text" name="txtCausa" id="txtCausa" class="form-control" required>
            </div>
            
            <!-- Campo Variables -->
            <div class="form-group">
                <label for="txtVariables">Variables</label>
                <input type="text" name="txtVariables" id="txtVariables" class="form-control" required>
            </div>

            <!-- Campo Categoría -->
            <div class="form-group">
                <label for="txtFkIdCategoria">Categoría</label>
                <select name="txtFkIdCategoria" id="txtFkIdCategoria" class="form-control" required>
                    <option value="">Selecciona una categoría</option>
                    <?php
                        if (isset($categorias) && is_array($categorias)) {
                            foreach ($categorias as $key => $value) {
                                echo "<option value='".$value->idCategoria."'>".$value->nombre."</option>";
                            }
                        } else {
                            echo "ERROR";
                        }
                    ?>
                </select>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>