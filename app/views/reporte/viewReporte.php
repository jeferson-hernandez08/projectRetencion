<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/reporte/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/reporte/new"><button>+</button></a>
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
        <div class="report-cards-container">
            <?php foreach ($reportes as $value): ?>
                <div class="report-card">
                    <div class="card-header">
                        <span class="report-id">Reporte # <?php echo $value->idReporte; ?></span>
                        <span class="report-date">Creación: <?php echo date('d/m/Y H:i', strtotime($value->fechaCreacion)); ?></span>
                    </div>
                    
                    <div class="card-body">
                        <div class="report-info">
                            <div class="info-label">Aprendiz:</div>
                            <div class="info-value"><?php echo $value->nombreAprendiz; ?></div>
                        </div>
                        
                        <div class="report-info">
                            <div class="info-label">Estado:</div>
                            <div class="status-container">
                                <select class="estado-select" data-id="<?php echo $value->idReporte; ?>">
                                    <option value="Registrado" <?= ($value->estado == 'Registrado') ? 'selected' : '' ?>>Registrado</option>
                                    <option value="En proceso" <?= ($value->estado == 'En proceso') ? 'selected' : '' ?>>En proceso</option>
                                    <option value="Retenido" <?= ($value->estado == 'Retenido') ? 'selected' : '' ?>>Retenido</option>
                                    <option value="Desertado" <?= ($value->estado == 'Desertado') ? 'selected' : '' ?>>Desertado</option>
                                </select>
                                <span class="update-badge"></span>
                            </div>
                        </div>
                        
                        <div class="report-info">
                            <div class="info-label">Direccionamiento:</div>
                            <div class="info-value"><?php echo $value->direccionamiento; ?></div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <div class="card-actions">
                            <a href="/reporte/view/<?php echo $value->idReporte; ?>" class="action-btn consultar" title="Ver detalles">
                                <i class="fas fa-eye"></i> Detalles
                            </a>
                            <a href="/reporte/edit/<?php echo $value->idReporte; ?>" class="action-btn editar" title="Editar reporte">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="/reporte/intervenciones/<?php echo $value->idReporte; ?>" class="action-btn intervenciones" title="Ver intervenciones">
                                <i class="fas fa-comments"></i> Ver Intervenciones
                            </a>
                            <a href="/reporte/delete/<?php echo $value->idReporte; ?>" class="action-btn eliminar" title="Eliminar reporte">
                                <i class="fas fa-trash"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script src="/js/estadoSelectViewReporte.js"></script>
<script>  
    // Pegar aquí para realizar pruebas
</script>