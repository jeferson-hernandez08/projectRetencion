<!-- views/programaFormacion/importar.php -->
<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/programaFormacion/view"><img src="/img/back.svg"></a>
        </div>
        <h2>Importar Programas de Formación desde Excel</h2>
    </div>

    <div class="importacion-form-container">
        <div class="alert alert-info">
            <strong>Formato requerido:</strong><br>
            <table class="format-table">
                <tr>
                    <th>Columna A</th>
                    <th>Columna B</th>
                    <th>Columna C</th>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td>Nivel</td>
                    <td>Versión</td>
                </tr>
                <tr>
                    <td>Análisis y Desarrollo de Software</td>
                    <td>Tecnólogo</td>
                    <td>228118 V1</td>
                </tr>
            </table>
        </div>

        <form method="POST" enctype="multipart/form-data" class="upload-form">
            <div class="form-group">
                <label for="archivo_excel" class="form-label">Seleccionar archivo Excel:</label>
                <input type="file" class="form-control" id="archivo_excel" name="archivo_excel" 
                       accept=".xlsx, .xls" required>
                <small class="form-text">Formatos aceptados: .xlsx, .xls</small>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i> Importar
                </button>
                <a href="/programaFormacion/view" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>

        <?php if (isset($resultado)): ?>
        <div class="resultado-container">
            <div class="alert alert-success">
                <strong>Procesamiento completado:</strong><br>
                Registros procesados exitosamente: <?php echo $resultado['procesados']; ?>
            </div>
            
            <?php if (!empty($resultado['errores'])): ?>
            <div class="alert alert-danger">
                <strong>Errores encontrados (<?php echo count($resultado['errores']); ?>):</strong>
                <ul>
                    <?php foreach ($resultado['errores'] as $error): ?>
                    <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
.importacion-form-container {
    max-width: 600px;
    margin: 0 auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.format-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.format-table th, .format-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.format-table th {
    background-color: #f8f9fa;
}

.upload-form {
    margin-top: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.form-text {
    color: #6c757d;
    font-size: 12px;
}

.form-actions {
    display: flex;
    gap: 10px;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-primary {
    background: #3498db;
    color: white;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.resultado-container {
    margin-top: 20px;
}

.alert {
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 15px;
}

.alert-info {
    background: #d1ecf1;
    border: 1px solid #bee5eb;
    color: #0c5460;
}

.alert-success {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.alert-danger {
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}
</style>