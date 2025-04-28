<div class="data-container">
    
    <!-- <div class="info">
        <form action="/causa/remove" method="post">
            <div class="form-group">
                <label>ID de la Causa: </label>
                <input type="text" readonly value="**************" name="txtId" class="form-control">
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
    </div> -->

    <div class="confirmation-modal">
        <img src="/img/warning.svg" alt="Advertencia" class="confirmation-icon">
        <h2 class="confirmation-title">¿Está seguro de realizar esta acción?</h2>
        <p class="confirmation-message">Se eliminará esta causa y sus relaciones con otros registros</p>
        
        <form action="/causa/remove" method="post">
            <input type="hidden" value="<?php echo $causa->idCausa ?>" name="txtId">
            <div class="confirmation-buttons">
                <button type="submit" class="btn-confirm">Confirmar</button>
                <a href="/causa/view" class="btn-cancel">Cancelar</a>
            </div>
        </form>
    </div>
</div>