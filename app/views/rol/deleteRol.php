<div class="data-container">
    
    <div class="info">
        <form action="/rol/remove" method="post">
            <div class="form-group">
                <label>ID del Rol: </label>
                <input type="text" readonly value="<?php echo $rol->idRol ?>" name="txtId" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit">Eliminar</button>
            </div>
        </form>
    </div>
    <div class="navegate-group">
        <div class="back">
            <a href="/rol/view"><img src="/img/back.svg"></a>
        </div>
    </div>
</div>