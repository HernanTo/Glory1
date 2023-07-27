<?php
        require('../../vendor/autoload.php');
        use PhpOffice\PhpSpreadsheet\IOFactory;
        use PhpOffice\PhpSpreadsheet\Spreadsheet;
        use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load("../../assets/formatos/cotizaciones.xlsx");
        $activeWorksheet = $spreadsheet->getActiveSheet();
    
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    
        $activeWorksheet->setCellValue('F9', 'Messi');
        $nombre_archivo = 'Factura_num_factura_lotus.xlsx';
    
        // ob_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombre_archivo . '"');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');
        exit;
?>