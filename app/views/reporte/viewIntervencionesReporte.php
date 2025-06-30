<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/reporte/view"><img src="/img/back.svg"></a>
        </div>
        <!-- <div class="create">
            <a href="/intervencion/new?reporteId=<?php echo $reporte->idReporte; ?>">
                <button>+ Nueva Intervención</button>
            </a>
        </div> -->
    </div>
    <div class="info">
        <div class="info-header">
            <h2>Reporte #<?php echo $reporte->idReporte; ?></h2>
            <div class="info-grid">
                <div class="info-field">
                    <div class="info-label">📊 Estado:</div>
                    <div class="info-value status-<?php echo strtolower($reporte->estado); ?>">
                        <?php echo $reporte->estado; ?>
                    </div>
                </div>
                
                <div class="info-field">
                    <div class="info-label">📅 Fecha Creación:</div>
                    <div class="info-value"><?php echo $reporte->fechaCreacion; ?></div>
                </div>

                <div class="info-field" style="grid-column: 1 / -1;">
                    <div class="info-label">📝 Descripción:</div>
                    <div class="info-value"><?php echo $reporte->descripcion; ?></div>
                </div>
                
                <div class="info-field">
                    <div class="info-label">👤 Aprendiz:</div>
                    <div class="info-value"><?php echo $reporte->nombreAprendiz; ?></div>
                </div>
                
                <div class="info-field">
                    <div class="info-label">👥 Usuario:</div>
                    <div class="info-value"><?php echo $reporte->nombreUsuario; ?></div>
                </div>
            </div>
        </div>

        <div class="intervention-title">
            <h3>Intervenciones 📋</h3>
        </div>
        <?php if (empty($intervenciones)): ?>
            <div class="no-interventions-container">
                <div class="no-interventions-icon">📋</div>
                <h3 class="no-interventions-title">Sin intervenciones registradas</h3>
                <p class="no-interventions-message">Actualmente no hay intervenciones asociadas a este reporte. Puedes agregar nuevas intervenciones utilizando el botón inferior.</p>
                <!-- <button class="no-interventions-action">
                    <span>+ Agregar Intervención</span>
                </button> -->
            </div>
        <?php else: ?>
            <div class="intervention-container">
                <?php foreach ($intervenciones as $intervencion): ?>
                    <div class='intervention-card'>
                        <div class='record-one__details'>
                            <div class='record-one__row'>
                                <span class='record-one__label'>ID Intervención:</span>
                                <span class='record-one__value'><?php echo $intervencion->idIntervencion; ?></span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Fecha:</span>
                                <span class='record-one__value'><?php echo $intervencion->fechaCreacion; ?></span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Descripción:</span>
                                <span class='record-one__value'><?php echo $intervencion->descripcion; ?></span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Estrategia:</span>
                                <span class='record-one__value'><?php echo $intervencion->nombreEstrategia; ?></span>
                            </div>
                            <div class='record-one__row'>
                                <span class='record-one__label'>Usuario:</span>
                                <span class='record-one__value'><?php echo $intervencion->nombreUsuario; ?></span>
                            </div>
                        </div>
                        <!-- <div class="buttons">
                            <a href='/intervencion/view/<?php echo $intervencion->idIntervencion; ?>'><button>Consultar</button></a>
                        </div> -->
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>