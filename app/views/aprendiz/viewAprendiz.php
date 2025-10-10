<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/aprendiz/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/aprendiz/new"><button>+</button></a>
        </div>
    </div>
    
    <?php if (empty($aprendices)): ?>
        <div class="no-records-message">
            <div class="no-records-icon">👤</div>
            <h3>No se encontraron aprendices</h3>
            <p>Actualmente no hay aprendices registrados en el sistema.</p>
            <a href="/aprendiz/new" class="create-aprendiz-btn">Crear Nuevo Aprendiz</a>
        </div>
    <?php else: ?>
        <div class="report-cards-container">
            <?php foreach ($aprendices as $value): ?>
                <div class="report-card">
                    <div class="card-header">
                        <span class="report-id">ID Aprendiz : <?php echo $value->idAprendiz; ?></span>
                        <span class="aprendiz-email">Email: <?php echo $value->email; ?></span>
                    </div>
                    
                    <div class="card-body">
                        <div class="report-info">
                            <div class="info-label"><i class="fas fa-user"></i> Nombres:</div>
                            <div class="info-value"><?php echo $value->nombres ?? 'No especificado'; ?></div>
                        </div>
                        
                        <div class="report-info">
                            <div class="info-label"><i class="fas fa-user-tag"></i> Apellidos:</div>
                            <div class="info-value"><?php echo $value->apellidos ?? 'No especificado'; ?></div>
                        </div>
                        
                        <div class="report-info">
                            <div class="info-label"><i class="fas fa-phone"></i> Teléfono:</div>
                            <div class="info-value"><?php echo $value->telefono; ?></div>
                        </div>
                        
                        <div class="report-info">
                            <div class="info-label"><i class="fas fa-info-circle"></i> Estado:</div>
                            <div class="info-value"><?php echo $value->estado ?? 'No especificado'; ?></div>
                        </div>
                        
                        
                        <div class="report-info">
                            <div class="info-label"><i class="fas fa-users"></i> Grupo:</div>
                            <div class="info-value"><?php 
                                // Si tenemos información del grupo, la mostramos
                                echo $value->fichaGrupo ?? 'Sin grupo asignado'; 
                                ?></div>
                        </div>
                        
                        <div class="report-info">
                            <div class="info-label"><i class="fas fa-graduation-cap"></i> Programa:</div>
                            <div class="info-value"><?php 
                                // Si tenemos información del programa, la mostramos
                                echo $value->nombrePrograma ?? 'Sin programa asignado'; 
                                ?></div>
                        </div>
                        
                        <div class="report-info">
                            <div class="info-label"><i class="fas fa-calendar-alt"></i> Trimestre:</div>
                            <div class="info-value"><?php echo $value->trimestre; ?></div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <div class="card-actions">
                            <a href="/aprendiz/view/<?php echo $value->idAprendiz; ?>" class="action-btn consultar" title="Ver detalles">
                                <i class="fas fa-eye"></i> Detalles
                            </a>
                            <a href="/aprendiz/edit/<?php echo $value->idAprendiz; ?>" class="action-btn editar" title="Editar aprendiz">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="/aprendiz/delete/<?php echo $value->idAprendiz; ?>" class="action-btn eliminar" title="Eliminar aprendiz">
                                <i class="fas fa-trash"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>