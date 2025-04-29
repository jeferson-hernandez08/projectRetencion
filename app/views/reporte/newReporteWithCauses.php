<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/reporte/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    
    <div class="info">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['message_type']; ?>">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
            </div>
        <?php endif; ?>
        
        <form id="reporteForm" action="/reporte/createWithCauses" method="post">
            <!-- Sección de información básica del reporte -->
            <div class="form-section">
                <h3>Información del Reporte</h3>
                
                <!-- Campo Descripción -->
                <div class="form-group">
                    <label for="txtDescripcion">Descripción*</label>
                    <textarea name="txtDescripcion" id="txtDescripcion" class="form-control" required rows="3"></textarea>
                </div>

                <!-- Campo Direccionamiento -->
                <div class="form-group">
                    <label for="txtDireccionamiento">Direccionamiento*</label>
                    <select name="txtDireccionamiento" id="txtDireccionamiento" class="form-control" required>
                        <option value="">Seleccione...</option>
                        <option value="Coordinador académico">Coordinador académico</option>
                        <option value="Coordinador de formación">Coordinador de formación</option>
                    </select>
                </div>

                <!-- Campo Aprendiz -->
                <div class="form-group">
                    <label for="txtFkIdAprendiz">Aprendiz*</label>
                    <select name="txtFkIdAprendiz" id="txtFkIdAprendiz" class="form-control" required>
                        <option value="">Seleccione un aprendiz</option>
                        <?php foreach ($aprendices as $aprendiz): ?>
                            <option value="<?= $aprendiz->idAprendiz ?>">
                                <?= $aprendiz->nombre ?> (<?= $aprendiz->email ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Sección de causas -->
            <div class="form-section">
                <h3>Causas del Reporte</h3>
                
                <div class="causa-selection">
                    <div class="form-group">
                        <label>Seleccionar Causa</label>
                        <select id="causaSelector" class="form-control">
                            <option value="">Seleccione una causa</option>
                            <?php foreach ($causas as $causa): ?>
                                <option value="<?= $causa->idCausa ?>"><?= $causa->causa ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="button" class="btn-add" onclick="addCausa()">Agregar Causa</button>
                    </div>
                    
                    <div id="selectedCausasContainer" class="selected-causas">
                        <!-- Aquí se agregarán dinámicamente las causas seleccionadas -->
                    </div>
                </div>
            </div>

            <!-- Botón de Guardar -->
            <div class="form-group">
                <button type="submit" class="btn-submit">Guardar Reporte</button>
            </div>
        </form>
    </div>
</div>

<style>
.form-section {
    margin-bottom: 2rem;
    padding: 1rem;
    border: 1px solid #e9ecef;
    border-radius: 8px;
}

.selected-causas {
    margin-top: 1rem;
}

.causa-card {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.8rem;
    margin-bottom: 0.5rem;
    background-color: #f8f9fa;
    border-radius: 6px;
    border: 1px solid #e9ecef;
}

.causa-card span {
    flex-grow: 1;
}

.btn-add, .btn-remove {
    padding: 0.4rem 0.8rem;
    border-radius: 4px;
    cursor: pointer;
    border: none;
    font-size: 0.9rem;
}

.btn-add {
    background-color: #28a745;
    color: white;
    margin-top: 0.5rem;
}

.btn-remove {
    background-color: #dc3545;
    color: white;
    margin-left: 0.5rem;
}

.btn-submit {
    background-color: #007bff;
    color: white;
    padding: 0.8rem 1.5rem;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 1rem;
}
</style>

<script>
// Array para almacenar las causas seleccionadas
let selectedCausas = [];

function addCausa() {
    const selector = document.getElementById('causaSelector');
    const causaId = selector.value;
    const causaText = selector.options[selector.selectedIndex].text;
    
    if (causaId && !selectedCausas.includes(causaId)) {
        selectedCausas.push(causaId);
        updateCausasDisplay();
        updateHiddenInputs();
    }
}

function removeCausa(causaId) {
    selectedCausas = selectedCausas.filter(id => id !== causaId);
    updateCausasDisplay();
    updateHiddenInputs();
}

function updateCausasDisplay() {
    const container = document.getElementById('selectedCausasContainer');
    container.innerHTML = '';
    
    selectedCausas.forEach(causaId => {
        const selector = document.getElementById('causaSelector');
        const causaText = Array.from(selector.options)
            .find(opt => opt.value === causaId).text;
        
        const card = document.createElement('div');
        card.className = 'causa-card';
        card.innerHTML = `
            <span>${causaText}</span>
            <button type="button" class="btn-remove" onclick="removeCausa('${causaId}')">
                Eliminar
            </button>
        `;
        container.appendChild(card);
    });
}

function updateHiddenInputs() {
    // Eliminar inputs antiguos
    document.querySelectorAll('input[name="causas[]"]').forEach(el => el.remove());
    
    // Agregar nuevos inputs
    selectedCausas.forEach(causaId => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'causas[]';
        input.value = causaId;
        document.getElementById('reporteForm').appendChild(input);
    });
}

// Validación del formulario
document.getElementById('reporteForm').addEventListener('submit', function(e) {
    if (selectedCausas.length === 0) {
        e.preventDefault();
        alert('Debe agregar al menos una causa');
        return false;
    }
    return true;
});
</script>