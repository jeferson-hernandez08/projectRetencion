<?php
// app/libraries/ExcelReader.php

namespace App\Libraries;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ExcelReader {
    
    public function leerArchivo($archivoTemporal) {
        try {
            // Verificar si el archivo existe y es legible
            if (!file_exists($archivoTemporal) || !is_readable($archivoTemporal)) {
                throw new \Exception("El archivo no existe o no se puede leer");
            }
            
            $spreadsheet = IOFactory::load($archivoTemporal);
            $sheet = $spreadsheet->getActiveSheet();
            return $sheet->toArray();
        } catch (\Exception $e) {
            error_log("Error ExcelReader: " . $e->getMessage());
            throw new \Exception("Error al leer el archivo Excel: " . $e->getMessage());
        }
    }
    
    public function formatearFechaExcel($fechaExcel) {
        if (is_numeric($fechaExcel)) {
            try {
                return Date::excelToDateTimeObject($fechaExcel)->format('Y-m-d');
            } catch (\Exception $e) {
                return $fechaExcel; // Retorna el valor original si hay error
            }
        }
        return $fechaExcel;
    }
}