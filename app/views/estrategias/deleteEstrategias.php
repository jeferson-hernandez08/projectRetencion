<div class="data-container">
    
    <div class="info">
        <form action="/estrategias/remove" method="post">
            <div class="form-group">
                <label>ID de la Estrategia: </label>
                <input type="text" readonly value="<?php echo $estrategias->idEstrategias ?>" name="txtId" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit">Eliminar</button>
            </div>
        </form>
    </div>
    <div class="navegate-group">
        <div class="back">
            <a href="/estrategias/view"><img src="/img/back.svg"></a>
        </div>
    </div>
</div>