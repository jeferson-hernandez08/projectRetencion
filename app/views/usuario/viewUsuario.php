<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/usuario/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/usuario/new"><button>+</button></a>
        </div>
    </div>
    
    <?php if (empty($usuarios)): ?>
        <div class="no-records-message">
            <div class="no-records-icon">👤</div>
            <h3>No se encontraron usuarios</h3>
            <p>Actualmente no hay usuarios registrados en el sistema.</p>
            <a href="/usuario/new" class="create-usuario-btn">Crear Nuevo Usuario</a>
        </div>
    <?php else: ?>
        <div class="report-cards-container">
            <?php foreach ($usuarios as $usuario): ?>
                <div class="report-card">
                    <div class="card-header">
                        <span class="report-id">Usuario ID # <?php echo $usuario->idUsuario; ?></span>
                        <span class="usuario-email">Email: <?php echo $usuario->email; ?></span>
                    </div>
                    
                    <div class="card-body">
                        <div class="report-info">
                            <div class="info-label">Nombre:</div>
                            <div class="info-value"><?php echo $usuario->nombre; ?></div>
                        </div>
                        
                        <div class="report-info">
                            <div class="info-label">Teléfono:</div>
                            <div class="info-value"><?php echo $usuario->telefono; ?></div>
                        </div>
                        
                        <?php if (isset($usuario->nombreRol)): ?>
                        <div class="report-info">
                            <div class="info-label">Rol:</div>
                            <div class="info-value"><?php echo $usuario->nombreRol; ?></div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="report-info">
                            <div class="info-label">Tipo Coordinador:</div>
                            <div class="info-value"><?php echo $usuario->tipoCoordinador ?? 'No especificado'; ?></div>
                        </div>
                        
                        <!-- <div class="report-info">
                            <div class="info-label">Gestor:</div>
                            <div class="info-value"><?php echo $usuario->gestor ?? 'No especificado'; ?></div>
                        </div> -->
                    </div>
                    
                    <div class="card-footer">
                        <div class="card-actions">
                            <a href="/usuario/view/<?php echo $usuario->idUsuario; ?>" class="action-btn consultar" title="Ver detalles">
                                <i class="fas fa-eye"></i> Detalles
                            </a>
                            <a href="/usuario/edit/<?php echo $usuario->idUsuario; ?>" class="action-btn editar" title="Editar usuario">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="/usuario/delete/<?php echo $usuario->idUsuario; ?>" class="action-btn eliminar" title="Eliminar usuario">
                                <i class="fas fa-trash"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>