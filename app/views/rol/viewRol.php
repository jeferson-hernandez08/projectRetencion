<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/rol/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/rol/new"><button>+</button></a>
        </div>
    </div>
    
    <?php if (empty($roles)): ?>
        <div class="no-records-message">
            <div class="no-records-icon">👑</div>
            <h3>No se encontraron roles</h3>
            <p>Actualmente no hay roles registrados en el sistema.</p>
            <a href="/rol/new" class="create-rol-btn">Crear Nuevo Rol</a>
        </div>
    <?php else: ?>
        <div class="report-cards-container">
            <?php foreach ($roles as $rol): ?>
                <div class="report-card">
                    <div class="card-header">
                        <span class="report-id">Rol ID # <?php echo $rol->idRol; ?></span>
                        <span class="aprendiz-email"><?php echo $rol->nombre; ?></span>
                    </div>
                    
                    <div class="card-body">
                        <div class="report-info">
                            <div class="info-label">Nombre:</div>
                            <div class="info-value"><?php echo $rol->nombre; ?></div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <div class="card-actions">
                            <a href="/rol/view/<?php echo $rol->idRol; ?>" class="action-btn consultar" title="Ver detalles">
                                <i class="fas fa-eye"></i> Detalles
                            </a>
                            <a href="/rol/edit/<?php echo $rol->idRol; ?>" class="action-btn editar" title="Editar rol">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="/rol/delete/<?php echo $rol->idRol; ?>" class="action-btn eliminar" title="Eliminar rol">
                                <i class="fas fa-trash"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>