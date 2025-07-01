<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/categoria/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/categoria/new"><button>+</button></a>
        </div>
    </div>
    
    <?php if (empty($categorias)): ?>
        <div class="no-records-message">
            <div class="no-records-icon">📁</div>
            <h3>No se encontraron categorías</h3>
            <p>Actualmente no hay categorías registradas en el sistema.</p>
            <a href="/categoria/new" class="create-categoria-btn">Crear Nueva Categoría</a>
        </div>
    <?php else: ?>
        <div class="report-cards-container">
            <?php foreach ($categorias as $value): ?>
                <div class="report-card">
                    <div class="card-header">
                        <span class="report-id">Categoría ID # <?php echo $value->idCategoria; ?></span>
                        <span class="aprendiz-email">Nombre: <?php echo $value->nombre; ?></span>
                    </div>
                    
                    <div class="card-body">
                        <div class="report-info">
                            <div class="info-label">Nombre Categoría:</div>
                            <div class="info-value"><?php echo $value->nombre; ?></div>
                        </div>

                        <div class="report-info">
                            <div class="info-label">Descripción:</div>
                            <div class="info-value"><?php echo $value->descripcion; ?></div>
                        </div>
                        
                        <div class="report-info">
                            <div class="info-label">Direccionamiento:</div>
                            <div class="info-value"><?php echo $value->direccionamiento; ?></div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <div class="card-actions">
                            <a href="/categoria/view/<?php echo $value->idCategoria; ?>" class="action-btn consultar" title="Ver detalles">
                                <i class="fas fa-eye"></i> Detalles
                            </a>
                            <a href="/categoria/edit/<?php echo $value->idCategoria; ?>" class="action-btn editar" title="Editar categoría">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="/categoria/delete/<?php echo $value->idCategoria; ?>" class="action-btn eliminar" title="Eliminar categoría">
                                <i class="fas fa-trash"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>