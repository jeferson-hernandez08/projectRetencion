<div class="data-container">
    
    <div class="info">
        <form action="/causa/remove" method="post">
            <div class="form-group">
                <label>ID de la Causa: </label>
                <input type="text" readonly value="<?php echo $causa->idCausa ?>" name="txtId" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit">Eliminar</button>
            </div>
        </form>
    </div>
    <div class="navegate-group">
        <div class="back">
            <a href="/causa/view"><img src="/img/back.svg"></a>
        </div>
    </div>
</div>