<?php
require('../../vendor/autoload.php');
use Dompdf\Dompdf;

// Obtener el contenido del template
$html = file_get_contents('./components/template.php');

// Obtener el valor de la variable referencia desde el parámetro GET
$referencia = $_GET['referencia'];

// Reemplazar el marcador {{referencia}} con el valor de la variable $referencia
$html = str_replace('{{referencia}}', $referencia, $html);

// Crear una instancia de Dompdf
$dompdf = new Dompdf(); 
$dompdf->set_option("enable_remote", true);
$dompdf->setPaper('A4', 'portrait');

// Cargar el contenido HTML en Dompdf
$dompdf->loadHtml($html);


// Renderizar el contenido HTML en PDF
$dompdf->render();

// Opcional: puedes guardar el PDF en el servidor antes de descargarlo
$outputFilename = './temp/nombre_archivo.pdf'; // Ruta y nombre de archivo válido
file_put_contents($outputFilename, $dompdf->output());

// Descargar el PDF directamente al cliente
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="nombre_archivo.pdf"');
readfile($outputFilename);
?>
