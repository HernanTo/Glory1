<?php
require('../../vendor/autoload.php');
use Dompdf\Dompdf;

$html = file_get_contents('./components/template.php');

// Crear una instancia de Dompdf
// $dompdf = new Dompdf(array('enable_remote' => true));
$dompdf = new Dompdf(); 
$dompdf->set_option("enable_remote", true);

$dompdf->setPaper('A4', 'portrait');

// Cargar el contenido HTML en Dompdf
$dompdf->loadHtml($html);

// Opcional: puedes establecer el tamaño y la orientación del papel
// $dompdf->setPaper('A4', 'portrait');

// Renderizar el contenido HTML en PDF
$dompdf->render();

// Opcional: puedes guardar el PDF en el servidor antes de descargarlo
$outputFilename = './temp/nombre_archivo.pdf'; // Ruta y nombre de archivo válido
file_put_contents($outputFilename, $dompdf->output());

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="nombre_archivo.pdf"');
readfile($outputFilename);