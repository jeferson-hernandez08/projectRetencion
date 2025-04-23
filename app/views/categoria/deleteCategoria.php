<div class="data-container">
    
    <div class="info">
        <form action="/categoria/remove" method="post">
            <div class="form-group">
                <label>ID de la Categoria: </label>
                <input type="text" readonly value="<?php echo $categoria->idCategoria ?>" name="txtId" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit">Eliminar</button>
            </div>
        </form>
    </div>
    <div class="navegate-group">
        <div class="back">
            <a href="/categoria/view"><img src="/img/back.svg"></a>
        </div>
    </div>
</div>