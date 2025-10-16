<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/intervencion/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/intervencion/new"><button>+</button></a>
        </div>
    </div>
    
    <?php if (empty($intervenciones)): ?>
        <div class="no-records-message">
            <div class="no-records-icon">📝</div>
            <h3>No se encontraron intervenciones</h3>
            <p>Actualmente no hay intervenciones registradas en el sistema.</p>
            <a href="/intervencion/new" class="create-report-btn">Crear Nueva Intervención</a>
        </div>
    <?php else: ?>
        <div class="report-cards-container">
            <?php foreach ($intervenciones as $intervencion): 
                // Usar DateTime para manejar correctamente la zona horaria
                $fecha = new DateTime($intervencion->creationDate, new DateTimeZone('UTC'));
                $fecha->setTimezone(new DateTimeZone('America/Bogota'));
                $fechaFormateada = $fecha->format('d/m/Y H:i');
            ?>
                <div class="report-card">
                    <div class="card-header">
                        <span class="report-id">Intervención ID # <?php echo $intervencion->id; ?></span>
                        <span class="intervencion-fecha"><i class="far fa-calendar-alt"></i> Creación: <?php echo $fechaFormateada; ?></span>
                    </div>
                    
                    <div class="card-body">
                        <!-- NUEVO: Mostrar el aprendiz -->
                        <?php if (isset($intervencion->nombreAprendiz)): ?>
                            <div class="report-info">
                                <div class="info-label"><i class="fas fa-user-graduate"></i> Aprendiz:</div>
                                <div class="info-value aprendiz-destacado"><?php echo $intervencion->nombreAprendiz; ?></div>
                            </div>
                        <?php endif; ?>

                        <div class="report-info">
                            <div class="info-label">Descripción:</div>
                            <div class="info-value"><?php 
                                // Mostramos solo los primeros 100 caracteres de la descripción
                                echo strlen($intervencion->description ) > 100 
                                    ? substr($intervencion->description , 0, 100) . '...' 
                                    : $intervencion->description ; 
                            ?></div>
                        </div>

                        <?php if (isset($intervencion->nombreEstrategia)): ?>
                        <div class="report-info">
                            <div class="info-label">Estrategia:</div>
                            <div class="info-value"><?php echo $intervencion->nombreEstrategia; ?></div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (isset($intervencion->nombreUsuario)): ?>
                        <div class="report-info">
                            <div class="info-label">Usuario:</div>
                            <div class="info-value"><?php echo $intervencion->nombreUsuario; ?></div>
                        </div>
                        <?php endif; ?>

                        <div class="report-info">
                            <div class="info-label">Fecha Creación:</div>
                            <div class="info-value"><?php echo $fechaFormateada; ?></div>
                        </div>

                    </div>
                    
                    <div class="card-footer">
                        <div class="card-actions">
                            <a href="/intervencion/view/<?php echo $intervencion->id; ?>" class="action-btn consultar" title="Ver detalles">
                                <i class="fas fa-eye"></i> Detalles
                            </a>
                            <a href="/intervencion/edit/<?php echo $intervencion->id; ?>" class="action-btn editar" title="Editar intervención">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="/intervencion/delete/<?php echo $intervencion->id; ?>" class="action-btn eliminar" title="Eliminar intervención">
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
    /* --- Fecha: separa icono --- */
    .intervencion-fecha i { margin-right: 6px; }
    
    .aprendiz-destacado {
        font-weight: bold;
        color: #2c3e50;
        font-size: 1.1em;
    }

</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchAprendizHeader');
    const clearBtn = document.getElementById('clearSearchHeader');
    const reportCards = document.querySelectorAll('.report-card');

    if (searchInput && clearBtn) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            if (searchTerm) {
                clearBtn.style.display = 'flex';
            } else {
                clearBtn.style.display = 'none';
            }

            reportCards.forEach(card => {
                const aprendizElement = card.querySelector('.aprendiz-destacado');
                
                if (aprendizElement) {
                    const nombreAprendiz = aprendizElement.textContent.toLowerCase();
                    
                    if (nombreAprendiz.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                } else {
                    card.style.display = 'none';
                }
            });
        });

        clearBtn.addEventListener('click', function() {
            searchInput.value = '';
            clearBtn.style.display = 'none';
            
            reportCards.forEach(card => {
                card.style.display = 'block';
            });
            
            searchInput.focus();
        });
    }
});
</script>