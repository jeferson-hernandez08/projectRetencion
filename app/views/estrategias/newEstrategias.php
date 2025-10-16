<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/estrategias/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/estrategias/create" method="post">
            <!-- Campo Estrategia -->
            <div class="form-group">
                <label for="txtEstrategia">Nombre de la Estrategia</label>
                <input type="text" name="txtEstrategia" id="txtEstrategia" class="form-control" required>
            </div>
            
            <!-- Campo Categoría -->
            <div class="form-group">
                <label for="txtFkIdCategoria">Categoría</label>
                <select name="txtFkIdCategoria" id="txtFkIdCategoria" class="form-control" required>
                    <option value="">Selecciona una categoría</option>
                    <?php
                        if (isset($categorias) && is_array($categorias)) {
                            foreach ($categorias as $key => $value) {
                                echo "<option value='".$value->id."'>".$value->name."</option>";
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