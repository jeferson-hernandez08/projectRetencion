<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/causa/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
        <a href="/causa/new">
            <button>
                <i class="fa fa-plus-circle"></i> Crear causa
            </button>
        </a>
</div>
    </div>
    
    <?php if (empty($causas)): ?>
        <div class="no-records-message">
            <div class="no-records-icon">🔍</div>
            <h3>No se encontraron causas</h3>
            <p>Actualmente no hay causas registradas en el sistema.</p>
            <a href="/causa/new" class="create-causa-btn">Crear Nueva Causa</a>
        </div>
    <?php else: ?>
        <div class="report-cards-container">
            <?php foreach ($causas as $value): ?>
                <div class="report-card">
                    <div class="card-header">
                        <span class="report-id">Causa ID # <?php echo $value->id; ?></span>
                        <span class="causa-categoria">Categoría: <?php echo $value->nombreCategoria ?? 'Sin categoría'; ?></span>
                    </div>
                    
                    <div class="card-body">
                        <div class="report-info">
                            <div class="info-label">Causa:</div>
                            <div class="info-value"><?php echo $value->cause; ?></div>
                        </div>
                        
                        <div class="report-info">
                            <div class="info-label">Variables:</div>
                            <div class="info-value"><?php echo $value->variable; ?></div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <div class="card-actions">
                            <a href="/causa/view/<?php echo $value->id; ?>" class="action-btn consultar" title="Ver detalles">
                                <i class="fas fa-eye"></i> Detalles
                            </a>
                            <a href="/causa/edit/<?php echo $value->id; ?>" class="action-btn editar" title="Editar causa">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="/causa/delete/<?php echo $value->id; ?>" class="action-btn eliminar" title="Eliminar causa">
                                <i class="fas fa-trash"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>