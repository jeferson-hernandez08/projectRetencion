<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/grupo/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
        <a href="/grupo/new">
            <button>
            <i class="fa fa-plus-circle"></i> Crear grupo
            </button>
        </a>
</div>
        <div>
             <!-- Botón para importar desde Excel -->
            <a href="#" id="btn-importar-excel" class="btn-importar">
                <i class="fas fa-file-excel"></i> Importar Excel
            </a>
        </div>
    </div>
    
    <!-- Modal para importar Excel -->
    <div id="modal-importar" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Importar Grupos desde Excel</h3>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <strong>Formato requerido:</strong>
                    <table class="format-table">
                        <tr>
                            <th>Columna A</th>
                            <th>Columna B</th>
                            <th>Columna C</th>
                            <th>Columna D</th>
                            <th>Columna E</th>
                            <th>Columna F</th>
                            <th>Columna G</th>
                            <th>Columna H</th>
                            <th>Columna I</th>
                        </tr>
                        <tr>
                            <td>Ficha</td>
                            <td>Inicio Lectiva</td>
                            <td>Fin Lectiva</td>
                            <td>Inicio Práctica</td>
                            <td>Fin Práctica</td>
                            <td>Nombre Gestor</td>
                            <td>Jornada</td>
                            <td>Modalidad</td>
                            <td>ID Programa Formación</td>
                        </tr>
                        <tr>
                            <td>2873711</td>
                            <td>2024-01-28</td>
                            <td>2025-10-20</td>
                            <td>2025-10-22</td>
                            <td>2026-04-22</td>
                            <td>Julian Salazar</td>
                            <td>Diurna</td>
                            <td>Presencial</td>
                            <td>1</td>
                        </tr>
                    </table>
                    <p><strong>Nota:</strong> Las fechas deben estar en formato YYYY-MM-DD.</p>
                </div>

                <form id="form-importar" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="archivo_excel" class="form-label">Seleccionar archivo Excel:</label>
                        <input type="file" class="form-control" id="archivo_excel" name="archivo_excel" 
                               accept=".xlsx, .xls" required>
                        <small class="form-text">Formatos aceptados: .xlsx, .xls</small>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Importar
                        </button>
                        <button type="button" class="btn btn-secondary" id="btn-cancelar">
                            <i class="fas fa-times"></i> Cancelar
                        </button>
                    </div>
                </form>

                <div id="resultado-importacion" style="display: none; margin-top: 20px;"></div>
            </div>
        </div>
    </div>
    
    <?php if (empty($grupos)): ?>
        <div class="no-records-message">
            <div class="no-records-icon">👥</div>
            <h3>No se encontraron grupos</h3>
            <p>Actualmente no hay grupos registrados en el sistema.</p>
            <a href="/grupo/new" class="create-grupo-btn">Crear Nuevo Grupo</a>
            <button id="btn-importar-empty" class="btn-importar-empty">
                <i class="fas fa-file-excel"></i> Importar desde Excel
            </button>
        </div>
    <?php else: ?>
        <div class="report-cards-container">
            <?php foreach ($grupos as $value): ?>
                <div class="report-card">
                    <div class="card-header">
                        <span class="report-id">Grupo ID # <?php echo $value->id; ?></span>
                        <span class="grupo-ficha">Ficha: <?php echo $value->file; ?></span>
                    </div>
                    
                    <div class="card-body">
                        <div class="report-info">
                            <div class="info-label"><i class="fas fa-id-badge"></i> Ficha:</div>
                            <div class="info-value"><?php echo $value->file; ?></div>
                        </div>

                        <div class="report-info">
                            <div class="info-label"><i class="fas fa-chalkboard-teacher"></i> Programa Formación:</div>
                            <div class="info-value"><?php 
                                echo $value->nombrePrograma ?? 'Sin programa asignado'; 
                            ?></div>
                        </div>

                        <div class="report-info">
                            <div class="info-label"><i class="fas fa-clock"></i> Jornada:</div>
                            <div class="info-value"><?php echo (!empty ($value->shift)) ? htmlspecialchars($value->shift) : 'No asignado'; ?></div>
                        </div>
                        
                        <div class="report-info">
                            <div class="info-label"><i class="fas fa-user-tie"></i> Gestor:</div>
                            <div class="info-value"><?php echo $value->managerName ?? 'No asignado'; ?></div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="card-actions">
                            <a href="/grupo/view/<?php echo $value->id; ?>" class="action-btn consultar" title="Ver detalles">
                                <i class="fas fa-eye"></i> Detalles
                            </a>
                            <a href="/grupo/edit/<?php echo $value->id; ?>" class="action-btn editar" title="Editar grupo">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="/grupo/delete/<?php echo $value->id; ?>" class="action-btn eliminar" title="Eliminar grupo">
                                <i class="fas fa-trash"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
.btn-importar {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 2px 20px;
    background: #28a745;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-left: 10px;
    transition: background 0.3s ease;
}

.btn-importar:hover {
    background: #218838;
    color: white;
}

.btn-importar-empty {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    margin-top: 15px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.btn-importar-empty:hover {
    background: #218838;
}

/* Modal Styles */
.modal {
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 0;
    border-radius: 10px;
    width: 90%;
    max-width: 700px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #eee;
}

.modal-body {
    padding: 20px;
    overflow-y: auto;
    max-height: 70vh;
}

.modal-header h3 {
    margin: 0;
    color: #2c3e50;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover {
    color: #000;
}

.format-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    font-size: 12px;
}

.format-table th, .format-table td {
    border: 1px solid #ddd;
    padding: 6px;
    text-align: left;
}

.format-table th {
    background-color: #f8f9fa;
    font-weight: bold;
}

.upload-form {
    margin-top: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.form-text {
    color: #6c757d;
    font-size: 12px;
}

.form-actions {
    display: flex;
    gap: 10px;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: background-color 0.3s ease;
}

.btn-primary {
    background: #3498db;
    color: white;
}

.btn-primary:hover {
    background: #2980b9;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
}

.btn-success {
    background: #28a745;
    color: white;
}

.btn-success:hover {
    background: #218838;
}

.alert {
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 15px;
}

.alert-info {
    background: #d1ecf1;
    border: 1px solid #bee5eb;
    color: #0c5460;
    overflow: auto;
}

.alert-success {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.alert-danger {
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

/* Estilos para el área de resultados */
#resultado-importacion {
    margin-top: 20px;
}

#resultado-importacion .alert {
    word-wrap: break-word;
}

#resultado-importacion ul {
    max-height: 150px;
    overflow-y: auto;
    margin-top: 10px;
    padding-left: 20px;
}

#resultado-importacion li {
    margin-bottom: 5px;
    word-break: break-word;
}

.result-actions {
    display: flex;
    gap: 10px;
    margin-top: 20px;
    justify-content: flex-end;
}

i.fa-file-excel {
    font-size: 23px;
    color: #FFFFFFFF;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modal-importar');
    const btnImportar = document.getElementById('btn-importar-excel');
    const btnImportarEmpty = document.getElementById('btn-importar-empty');
    const btnCancelar = document.getElementById('btn-cancelar');
    const closeBtn = document.querySelector('.close');
    const form = document.getElementById('form-importar');
    const resultadoDiv = document.getElementById('resultado-importacion');

    // Función para abrir modal
    function openModal() {
        modal.style.display = 'block';
        resultadoDiv.style.display = 'none';
        resultadoDiv.innerHTML = '';
        form.reset();
        form.style.display = 'block';
    }

    // Función para cerrar modal
    function closeModal() {
        modal.style.display = 'none';
    }

    // Función para recargar y cerrar
    function reloadAndClose() {
        window.location.reload();
        closeModal();
    }

    // Event listeners
    if (btnImportar) {
        btnImportar.addEventListener('click', openModal);
    }
    
    if (btnImportarEmpty) {
        btnImportarEmpty.addEventListener('click', openModal);
    }

    closeBtn.addEventListener('click', closeModal);
    btnCancelar.addEventListener('click', closeModal);

    // Cerrar modal al hacer clic fuera
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    // Manejar envío del formulario
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        // Mostrar loading
        resultadoDiv.style.display = 'block';
        resultadoDiv.innerHTML = `
            <div class="alert alert-info">
                <i class="fas fa-spinner fa-spin"></i> Procesando archivo...
            </div>
        `;

        fetch('/grupo/importarExcel', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let resultadoHTML = `
                    <div class="alert alert-success">
                        <strong>¡Importación exitosa!</strong><br>
                        Registros procesados: ${data.procesados}<br>
                        ${data.errores.length > 0 ? 
                            `Errores encontrados: ${data.errores.length}` : 
                            'Todos los registros se importaron correctamente.'
                        }
                    </div>
                `;
                
                if (data.errores.length > 0) {
                    resultadoHTML += `
                        <div class="alert alert-danger">
                            <strong>Detalles de errores:</strong>
                            <ul>
                                ${data.errores.map(error => `<li>${error}</li>`).join('')}
                            </ul>
                        </div>
                    `;
                }
                
                // Agregar botón Continuar
                resultadoHTML += `
                    <div class="result-actions">
                        <button type="button" class="btn btn-success" id="btn-continuar">
                            <i class="fas fa-check"></i> Continuar
                        </button>
                    </div>
                `;
                
                resultadoDiv.innerHTML = resultadoHTML;
                
                // Ocultar formulario después de éxito
                form.style.display = 'none';
                
                // Event listener para el botón Continuar
                document.getElementById('btn-continuar').addEventListener('click', reloadAndClose);
                
            } else {
                resultadoDiv.innerHTML = `
                    <div class="alert alert-danger">
                        <strong>Error en la importación:</strong><br>
                        ${data.message || 'Error desconocido'}
                    </div>
                    <div class="result-actions">
                        <button type="button" class="btn btn-secondary" id="btn-cerrar-error">
                            <i class="fas fa-times"></i> Cerrar
                        </button>
                    </div>
                `;
                
                // Event listener para el botón Cerrar en caso de error
                document.getElementById('btn-cerrar-error').addEventListener('click', closeModal);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            resultadoDiv.innerHTML = `
                <div class="alert alert-danger">
                    <strong>Error de conexión:</strong><br>
                    No se pudo procesar la solicitud. Intente nuevamente.
                </div>
                <div class="result-actions">
                    <button type="button" class="btn btn-secondary" id="btn-cerrar-conexion">
                        <i class="fas fa-times"></i> Cerrar
                    </button>
                </div>
            `;
            
            // Event listener para el botón Cerrar en caso de error de conexión
            document.getElementById('btn-cerrar-conexion').addEventListener('click', closeModal);
        });
    });
});
</script>