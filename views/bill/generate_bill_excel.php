<?php
        include('../auth/security/securityGeneral.php');
        include ('../../model/bill.php');
        $Bill = new Bill;
        if(isset($_GET['referencia'])){
                if($_GET['referencia'] == ''){
                    header('Location: ./');
                }else{
                    list($data, $product, $seller) = $Bill->generateBill($_GET['referencia']);
                    if(mysqli_num_rows($data) <= 0 ){
                            header('Location: ./');
                    }
                }
            }else{
                header('Location: ./');
        }
        require('../../vendor/autoload.php');

        use PhpOffice\PhpSpreadsheet\IOFactory;
        use PhpOffice\PhpSpreadsheet\Spreadsheet;
        use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
        use PhpOffice\PhpSpreadsheet\Style\Border;

        function mergeCells($numcelda, $activeWorksheet){
                $activeWorksheet->mergeCells('B' . $numcelda . ':D' .$numcelda);
                $activeWorksheet->getRowDimension($numcelda)->setRowHeight(40);

                $style = $activeWorksheet->getStyle('B23');
                $activeWorksheet->duplicateStyle($style, 'B' . $numcelda);

                $activeWorksheet->mergeCells('E' . $numcelda . ':G' .$numcelda);
                $style = $activeWorksheet->getStyle('E23');
                $activeWorksheet->duplicateStyle($style, 'E' . $numcelda);

                $activeWorksheet->mergeCells('H' . $numcelda . ':I' .$numcelda);
                $style = $activeWorksheet->getStyle('H23');
                $activeWorksheet->duplicateStyle($style, 'H' . $numcelda);

                $activeWorksheet->mergeCells('J' . $numcelda . ':L' .$numcelda);
                $style = $activeWorksheet->getStyle('J23');
                $activeWorksheet->duplicateStyle($style, 'J' . $numcelda);

                $activeWorksheet->mergeCells('M' . $numcelda . ':N' .$numcelda);
                $style = $activeWorksheet->getStyle('M23');
                $activeWorksheet->duplicateStyle($style, 'M' . $numcelda);

                $activeWorksheet->mergeCells('O' . $numcelda . ':P' .$numcelda);
                $style = $activeWorksheet->getStyle('O23');
                $activeWorksheet->duplicateStyle($style, 'O' . $numcelda);

                $activeWorksheet->mergeCells('Q' . $numcelda . ':R' .$numcelda);
                $style = $activeWorksheet->getStyle('Q23');
                $activeWorksheet->duplicateStyle($style, 'Q' . $numcelda);
        }
        function addBorder($numCell, $activeWorksheet){
                $style = $activeWorksheet->getStyle('E' . ($numCell + 1));
                                $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
                                $style->getBorders()->getTop()->getColor()->setARGB('505765');
                                $style->getFont()->setBold(true);

                                $style = $activeWorksheet->getStyle('F' . ($numCell + 1));
                                $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
                                $style->getBorders()->getTop()->getColor()->setARGB('505765');

                                $style = $activeWorksheet->getStyle('G' . ($numCell + 1));
                                $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
                                $style->getBorders()->getTop()->getColor()->setARGB('505765');

                                $style = $activeWorksheet->getStyle('H' . ($numCell + 1));
                                $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
                                $style->getBorders()->getTop()->getColor()->setARGB('505765');
                                $style->getFont()->setBold(true);

                                $style = $activeWorksheet->getStyle('I' . ($numCell + 1));
                                $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
                                $style->getBorders()->getTop()->getColor()->setARGB('505765');

                                $style = $activeWorksheet->getStyle('J' . ($numCell + 1));
                                $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
                                $style->getBorders()->getTop()->getColor()->setARGB('505765');

                                $style = $activeWorksheet->getStyle('K' . ($numCell + 1));
                                $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
                                $style->getBorders()->getTop()->getColor()->setARGB('505765');

                                $style = $activeWorksheet->getStyle('L' . ($numCell + 1));
                                $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
                                $style->getBorders()->getTop()->getColor()->setARGB('505765');

                                $style = $activeWorksheet->getStyle('M' . ($numCell + 1));
                                $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
                                $style->getBorders()->getTop()->getColor()->setARGB('505765');

                                $style = $activeWorksheet->getStyle('N' . ($numCell + 1));
                                $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
                                $style->getBorders()->getTop()->getColor()->setARGB('505765');

                                $style = $activeWorksheet->getStyle('O' . ($numCell + 1));
                                $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
                                $style->getBorders()->getTop()->getColor()->setARGB('505765');

                                $style = $activeWorksheet->getStyle('P' . ($numCell + 1));
                                $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
                                $style->getBorders()->getTop()->getColor()->setARGB('505765');

                                $style = $activeWorksheet->getStyle('Q' . ($numCell + 1));
                                $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
                                $style->getBorders()->getTop()->getColor()->setARGB('505765');

                                $style = $activeWorksheet->getStyle('R' . ($numCell + 1));
                                $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
                                $style->getBorders()->getTop()->getColor()->setARGB('505765');
        }

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load("../../assets/formatos/facturadefault.xlsx");
        $activeWorksheet = $spreadsheet->getActiveSheet();

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        foreach ($seller as $datosseller){
                $activeWorksheet->setCellValue('N19', $datosseller['fi_lastname'] . ' ' . $datosseller['sc_lastname'] .' ' . $datosseller['ft_name'] .' ' . $datosseller['sc_lastname']);
        }
        $canTotal = 0;

        foreach ($data as $datos){
                $activeWorksheet->setCellValue('F15', $datos['date']);
                $activeWorksheet->setCellValue('F16', $datos['fullname']);
                $activeWorksheet->setCellValue('F17', $datos['address']);
                $activeWorksheet->setCellValue('F18', $datos['cedula']);
                $activeWorksheet->setCellValue('F19', $datos['phone']);
                $activeWorksheet->setCellValue('N17', $datos['placa']);
                $activeWorksheet->setCellValue('N18', $datos['modelo']);
                $canTotal = $datos['amount'];
        }
        $numCell = 23;
        $canProd = mysqli_num_rows($product);
        $count = 1;
        foreach($product as $datosProducto){
                if($numCell >= 45){
                        $activeWorksheet->insertNewRowBefore($numCell);
                        mergeCells($numCell, $activeWorksheet);
                }

                if($datosProducto['mano_obra'] == 1){
                        $nombreProducto = $datosProducto['name_product'] . ' Mano de obra';
                }else{
                        $nombreProducto = $datosProducto['name_product'];
                }

                $activeWorksheet->setCellValue('B'.$numCell, $datosProducto['num_repuesto']);
                $activeWorksheet->setCellValue('E'.$numCell, $nombreProducto);
                $activeWorksheet->setCellValue('H'.$numCell, $datosProducto['amount']);
                $activeWorksheet->setCellValue('J'.$numCell, $datosProducto['price_u']);
                $activeWorksheet->setCellValue('M'.$numCell, $datosProducto['price_u']);
                $activeWorksheet->setCellValue('O'.$numCell, $datosProducto['prices_total']);
                $activeWorksheet->setCellValue('Q'.$numCell, '0,00');

                if($canProd == $count){
                        $ultimaFila = $canProd;

                        $activeWorksheet->setCellValue('E' . ($numCell + 1), 'Subtotal');
                        $activeWorksheet->setCellValue('H' . ($numCell + 1), $canProd);

                        addBorder($numCell, $activeWorksheet);
                }

                $numCell = $numCell + 1;
                $count = $count + 1;

        }

        if($numCell>= 45){
                $canBajar = ($numCell) - 45;
                $activeWorksheet->setCellValue('T10', $canBajar);

                foreach ($data as $datos){
                        $activeWorksheet->setCellValue('O'. $canBajar + 47, $datos['subtotal']);
                        $activeWorksheet->setCellValue('O'. $canBajar + 49, $datos['subtotal']);
                        $activeWorksheet->setCellValue('O'. $canBajar + 50, $datos['subtotal'] * 0.19);
                        $activeWorksheet->setCellValue('O'. $canBajar + 51, $datos['total_prices']);
                }

        }else{
                foreach ($data as $datos){
                        $activeWorksheet->setCellValue('O47', $datos['subtotal']);
                        $activeWorksheet->setCellValue('O49', $datos['subtotal']);
                        $activeWorksheet->setCellValue('O50', $datos['subtotal'] * 0.19);
                        $activeWorksheet->setCellValue('O51', $datos['total_prices']);
                }
        }

        $name_xlsx = 'Factura_'. $_GET['referencia'] .'_lotus.xlsx';

        ob_clean();


        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename="Factura_' . $_GET['referencia'] . '_lotus.xlsx"');
        // header('Cache-Control: max-age=0');
        
        // Crear un objeto Writer para enviar el contenido del archivo Excel directamente al cliente
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('./temp/' . $name_xlsx);
        
        exit;
?>