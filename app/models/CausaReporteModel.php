<?php

namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class CausaReporteModel extends BaseModel {
    public function __construct(
        ?int $fkIdReporte = null,
        ?int $fkIdCausa   = null
    ) {
        $this->table = "causa_reporte";
        // Se llama al constructor del padre
        parent::__construct();
    }

}