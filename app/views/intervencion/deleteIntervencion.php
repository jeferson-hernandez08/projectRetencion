<div class="data-container">
    
    <!-- <div class="info">
        <form action="/intervencion/remove" method="post">
            <div class="form-group">
                <label>ID del Usuario: </label>
                <input type="text" readonly value="<?php echo $intervencion->idIntervencion ?>" name="txtId" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit">Eliminar</button>
            </div>
        </form>
    </div>
    <div class="navegate-group">
        <div class="back">
            <a href="/intervencion/view"><img src="/img/back.svg"></a>
        </div>
    </div> -->

    <div class="confirmation-modal">
        <img src="/img/warning.svg" alt="Advertencia" class="confirmation-icon">
        <h2 class="confirmation-title">¿Está seguro de realizar esta acción?</h2>
        <p class="confirmation-message">Se eliminará esta intervención y su registro</p>
        
        <form action="/intervencion/remove" method="post">
            <input type="hidden" value="<?php echo $intervencion->idIntervencion ?>" name="txtId">
            <div class="confirmation-buttons">
                <button type="submit" class="btn-confirm">Confirmar</button>
                <a href="/intervencion/view" class="btn-cancel">Cancelar</a>
            </div>
        </form>
    </div>
</div>