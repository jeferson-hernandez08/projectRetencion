<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/grupo/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/grupo/new"><button>+</button></a>
        </div>
    </div>
    
    <?php if (empty($grupos)): ?>
        <div class="no-records-message">
            <div class="no-records-icon">👥</div>
            <h3>No se encontraron grupos</h3>
            <p>Actualmente no hay grupos registrados en el sistema.</p>
            <a href="/grupo/new" class="create-grupo-btn">Crear Nuevo Grupo</a>
        </div>
    <?php else: ?>
        <div class="report-cards-container">
            <?php foreach ($grupos as $value): ?>
                <div class="report-card">
                    <div class="card-header">
                        <span class="report-id">Grupo ID # <?php echo $value->idGrupo; ?></span>
                        <span class="grupo-ficha"><?php echo $value->ficha; ?></span>
                    </div>
                    
                    <div class="card-body">
                        <div class="report-info">
                            <div class="info-label">Ficha:</div>
                            <div class="info-value"><?php echo $value->ficha; ?></div>
                        </div>

                        <div class="report-info">
                            <div class="info-label">Jornada:</div>
                            <div class="info-value"><?php echo $value->jornada; ?></div>
                        </div>
                        
                        <div class="report-info">
                            <div class="info-label">Modalidad:</div>
                            <div class="info-value"><?php echo $value->modalidad; ?></div>
                        </div>
                        
                        <!-- <div class="report-info">
                            <div class="info-label">Programa de Formación:</div>
                            <div class="info-value"><?php 
                                // Si tenemos información del programa, la mostramos
                                echo $value->nombrePrograma ?? 'Sin programa asignado'; 
                            ?></div>
                        </div> -->
                    </div>
                    
                    <div class="card-footer">
                        <div class="card-actions">
                            <a href="/grupo/view/<?php echo $value->idGrupo; ?>" class="action-btn consultar" title="Ver detalles">
                                <i class="fas fa-eye"></i> Detalles
                            </a>
                            <a href="/grupo/edit/<?php echo $value->idGrupo; ?>" class="action-btn editar" title="Editar grupo">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="/grupo/delete/<?php echo $value->idGrupo; ?>" class="action-btn eliminar" title="Eliminar grupo">
                                <i class="fas fa-trash"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>