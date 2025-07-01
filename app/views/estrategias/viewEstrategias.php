<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/estrategias/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/estrategias/new"><button>+</button></a>
        </div>
    </div>
    
    <?php if (empty($estrategias)): ?>
        <div class="no-records-message">
            <div class="no-records-icon">🚀</div>
            <h3>No se encontraron estrategias</h3>
            <p>Actualmente no hay estrategias registradas en el sistema.</p>
            <a href="/estrategias/new" class="create-estrategia-btn">Crear Nueva Estrategia</a>
        </div>
    <?php else: ?>
        <div class="report-cards-container">
            <?php foreach ($estrategias as $value): ?>
                <div class="report-card">
                    <div class="card-header">
                        <span class="report-id">Estrategia ID # <?php echo $value->idEstrategias; ?></span>
                        <span class="estrategia-categoria">Categoría: <?php echo $value->nombreCategoria ?? 'Sin categoría'; ?></span>
                    </div>
                    
                    <div class="card-body">
                        <div class="report-info">
                            <div class="info-label">Estrategia:</div>
                            <div class="info-value"><?php echo $value->estrategia; ?></div>
                        </div>

                        <div class="report-info">
                            <div class="info-label">Categoría:</div>
                            <div class="info-value"><?php echo $value->nombreCategoria; ?></div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <div class="card-actions">
                            <a href="/estrategias/view/<?php echo $value->idEstrategias; ?>" class="action-btn consultar" title="Ver detalles">
                                <i class="fas fa-eye"></i> Detalles
                            </a>
                            <a href="/estrategias/edit/<?php echo $value->idEstrategias; ?>" class="action-btn editar" title="Editar estrategia">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="/estrategias/delete/<?php echo $value->idEstrategias; ?>" class="action-btn eliminar" title="Eliminar estrategia">
                                <i class="fas fa-trash"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>