<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/programaFormacion/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/programaFormacion/new"><button>+</button></a>
        </div>
    </div>
    
    <?php if (empty($programas)): ?>
        <div class="no-records-message">
            <div class="no-records-icon">🎓</div>
            <h3>No se encontraron programas de formación</h3>
            <p>Actualmente no hay programas de formación registrados en el sistema.</p>
            <a href="/programaFormacion/new" class="create-programa-btn">Crear Nuevo Programa</a>
        </div>
    <?php else: ?>
        <div class="report-cards-container">
            <?php foreach ($programas as $programa): ?>
                <div class="report-card">
                    <div class="card-header">
                        <span class="report-id">Programa ID #  <?php echo $programa->idProgramaFormacion; ?></span>
                    </div>
                    
                    <div class="card-body">
                        <div class="report-info">
                            <div class="info-label">Nombre:</div>
                            <div class="info-value"><?php echo $programa->nombre; ?></div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <div class="card-actions">
                            <a href="/programaFormacion/view/<?php echo $programa->idProgramaFormacion; ?>" class="action-btn consultar" title="Ver detalles">
                                <i class="fas fa-eye"></i> Detalles
                            </a>
                            <a href="/programaFormacion/edit/<?php echo $programa->idProgramaFormacion; ?>" class="action-btn editar" title="Editar programa">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="/programaFormacion/delete/<?php echo $programa->idProgramaFormacion; ?>" class="action-btn eliminar" title="Eliminar programa">
                                <i class="fas fa-trash"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>