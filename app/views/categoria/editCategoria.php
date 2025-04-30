<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/categoria/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/categoria/update" method="post">
            <!-- Campo ID (oculto) -->
            <div class="form-group">
                <label for="txtId">Id de la categoría</label>
                <input type="text" readonly value="<?php echo $categoria->idCategoria ?>" name="txtId" id="txtId" class="form-control">
            </div>

            <!-- Campo Nombre -->
            <div class="form-group">
                <label for="txtNombre">Nombre</label>
                <input type="text" value="<?php echo $categoria->nombre ?>" name="txtNombre" id="txtNombre" class="form-control" required>
            </div>
            
            <!-- Campo Descripción -->
            <div class="form-group">
                <label for="txtDescripcion">Descripción</label>
                <textarea name="txtDescripcion" id="txtDescripcion" class="form-control" required><?php echo $categoria->descripcion ?></textarea>
            </div>

            <!-- Campo Direccionamiento (select) -->
            <div class="form-group">
                <label for="txtDireccionamiento">Direccionamiento</label>
                <select name="txtDireccionamiento" id="txtDireccionamiento" class="form-control" required>
                    <option value="Coordinador académico" <?php echo ($categoria->direccionamiento == 'Coordinador académico') ? 'selected' : '' ?>>Coordinador académico</option>
                    <option value="Coordinador de formación" <?php echo ($categoria->direccionamiento == 'Coordinador de formación') ? 'selected' : '' ?>>Coordinador de formación</option>
                </select>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit">Editar</button>
            </div>
        </form>
    </div>
</div>
