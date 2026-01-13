<div class="data-container">
    <div class="navegate-group">
        <!-- <div class="back">
            <a href="/reporte/view"><img src="/img/back.svg"></a>
        </div> -->
        <div class="create">
        <a href="/reporte/new">
            <button>
            <i class="fa fa-plus-circle"></i> Crear reporte
            <!-- <i class="fa fa-plus-circle"></i> <p>Crear reporte</p> // Se agrega p para opcion modo responsive -->
            </button>
        </a>
</div>
    </div>
    
    <?php if (empty($reportes)): ?>
        <div class="no-records-message">
            <div class="no-records-icon">📋</div>
            <h3>No se encontraron reportes</h3>
            <p>Actualmente no hay reportes registrados en el sistema.</p>
            <a href="/reporte/new" class="create-report-btn">Crear Nuevo Reporte</a>
        </div>
    <?php else: ?>
        <div id="noResultsMessage" class="no-records-message" style="display: none;">
            <div class="no-records-icon">🔍</div>
            <h3>No se encontraron resultados</h3>
            <p>No hay reportes que coincidan con tu búsqueda.</p>
        </div>
        
        <div class="report-cards-container">
            <?php foreach ($reportes as $value): 
                // Usar DateTime para manejar correctamente la zona horaria
                $fecha = new DateTime($value->creationDate);
                $fechaFormateada = $fecha->format('d/m/Y H:i');
            ?>
                <div class="report-card" data-aprendiz="<?php echo strtolower($value->nombreAprendiz); ?>">
                    <div class="card-header">
                        <span class="report-id">Reporte ID # <?php echo $value->id; ?></span>
                        <span class="report-date"><i class="far fa-calendar-alt"></i> Creación: <?php echo $fechaFormateada; ?></span>
                    </div>
                    
                    <div class="card-body">
                        <div class="report-info">
                            <div class="info-label"><i class="fas fa-user-graduate"></i> Aprendiz:</div>
                            <div class="info-value"><?php echo $value->nombreAprendiz; ?></div>
                        </div>
                        
                        <div class="report-info">
                            <div class="info-label"><i class="fas fa-tasks"></i> Estado:</div>
                            <div class="status-container">
                                <select class="estado-select" data-id="<?php echo $value->id; ?>">
                                    <option value="Registrado" <?= ($value->state == 'Registrado') ? 'selected' : '' ?>>Registrado</option>
                                    <option value="En proceso" <?= ($value->state == 'En proceso') ? 'selected' : '' ?>>En proceso</option>
                                    <option value="Retenido" <?= ($value->state == 'Retenido') ? 'selected' : '' ?>>Retenido</option>
                                    <option value="Desertado" <?= ($value->state == 'Desertado') ? 'selected' : '' ?>>Desertado</option>
                                </select>
                                <span class="update-badge"></span>
                            </div>
                        </div>
                        
                        <div class="report-info">
                            <div class="info-label"><i class="fas fa-road"></i> Direccionamiento:</div>
                            <div class="info-value"><?php echo $value->addressing; ?></div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <div class="card-actions">
                            <a href="/reporte/view/<?php echo $value->id; ?>" class="action-btn consultar" title="Ver detalles">
                                <i class="fas fa-eye"></i> Detalles
                            </a>
                            <a href="/reporte/edit/<?php echo $value->id; ?>" class="action-btn editar" title="Editar reporte">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="/reporte/intervenciones/<?php echo $value->id; ?>" class="action-btn intervenciones" title="Ver intervenciones">
                                <i class="fas fa-comments"></i> Ver Intervenciones
                            </a>
                            <a href="/reporte/delete/<?php echo $value->id; ?>" class="action-btn eliminar" title="Eliminar reporte">
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
.report-date i { margin-right: 6px; }

/* --- Fila de info con flex --- */
.report-info {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 6px;
  line-height: 1.35;
}

/* --- Etiqueta fija (icono + texto) --- */
.report-info .info-label {
  display: inline-flex;
  align-items: center;
  font-weight: 600;
  color: #1a1a1a;
  flex: 0 0 170px;   /* ancho fijo para que no se corte “Direccionamiento:” */
  white-space: nowrap;
}

/* --- Valor fluido con elipsis correcta --- */
.report-info .info-value {
  flex: 1 1 auto;    /* ocupa el resto */
  min-width: 0;      /* IMPORTANTÍSIMO para que elipsis funcione en flex */
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap; /* una sola línea; quita esta línea si quieres que haga salto */
  color: #333;
  font-weight: 500;
}

/* --- Ícono en la etiqueta --- */
.report-info .info-label i {
  margin-right: 6px;
  color: #007f3d; /* verde SENA */
}

/* --- Responsive: en pantallas angostas, pasa a dos líneas --- */
@media (max-width: 640px) {
  .report-info {
    align-items: flex-start;
  }
  .report-info .info-label {
    flex: 0 0 140px;   /* un poco más angosto */
  }
  .report-info .info-value {
    white-space: normal;   /* permite varias líneas en móviles */
    word-break: break-word;
  }
}


</style>

<script src="/js/estadoSelectViewReporte.js"></script>
<script>  
    // Filtro de búsqueda por aprendiz desde el header
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchAprendizHeader');
        const clearBtn = document.getElementById('clearSearchHeader');
        const reportCards = document.querySelectorAll('.report-card');
        const noResultsMessage = document.getElementById('noResultsMessage');
        const reportCardsContainer = document.querySelector('.report-cards-container');
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();
                let visibleCount = 0;
                
                // Mostrar/ocultar botón de limpiar
                if (clearBtn) {
                    clearBtn.style.display = searchTerm ? 'flex' : 'none';
                }
                
                reportCards.forEach(function(card) {
                    const aprendizName = card.getAttribute('data-aprendiz');
                    
                    if (aprendizName.includes(searchTerm)) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                // Mostrar mensaje si no hay resultados
                if (visibleCount === 0 && searchTerm !== '') {
                    if (noResultsMessage) noResultsMessage.style.display = 'block';
                    if (reportCardsContainer) reportCardsContainer.style.display = 'none';
                } else {
                    if (noResultsMessage) noResultsMessage.style.display = 'none';
                    if (reportCardsContainer) reportCardsContainer.style.display = 'grid';
                }
            });
            
            // Botón para limpiar búsqueda
            if (clearBtn) {
                clearBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    this.style.display = 'none';
                    reportCards.forEach(function(card) {
                        card.style.display = 'block';
                    });
                    if (noResultsMessage) noResultsMessage.style.display = 'none';
                    if (reportCardsContainer) reportCardsContainer.style.display = 'grid';
                    searchInput.focus();
                });
            }
        }
    });
    
    // Pegar aquí para realizar pruebas
</script>