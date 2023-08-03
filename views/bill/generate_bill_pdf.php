<?php
require('../../vendor/autoload.php');
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

use Dompdf\Dompdf;

// Obtener el contenido del template
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <style>

    @font-face {
    font-family: "Poppins";
    src: url("../../../assets/formatos/font/Poppins/Poppins-Regular.ttf") format("truetype");
    font-weight: normal;
    }

    @font-face {
    font-family: "Poppins";
    src: url("../../../assets/formatos/font/Poppins/Poppins-Bold.ttf") format("truetype");
    font-weight: bold;
    }

    @font-face {
    font-family: "Nunito";
    src: url("../../../assets/formatos/font/Nunito_Sans/static/NunitoSans_10pt-Regular.ttf") format("truetype");
    font-weight: normal;
    }

    @font-face {
    font-family: "Nunito";
    src: url("../../../assets/formatos/font/Nunito_Sans/static/NunitoSans_10pt-Bold.ttf") format("truetype");
    font-weight: bold;
    }

    body{
        margin: 0px;
        padding: 0px;
    }
    
    .contenedor{
        width: 100%;
        background: white;
    }
    .header img{
        width: 210px;
    }
    .con-titlte{
        background: #D9D9D9;
        width: 400px;
        padding-left: 30px;
        height: 56px;
        float: right;
        border-radius: 0px 0px 0px 12px;
    }
    .con-titlte h2{
        margin: 0px;
        padding: 0px;
        font-family: "Poppins", sans-serif;
        font-weight: Bold;
    }
    .con-numeral h1{
        margin: 0px;
        font-family: "Poppins", sans-serif;
        font-size: 1.2rem;
    }

    .con-emisor, .concliente{
        padding-left: 20px;
        padding-top: 10px;
    }
    .con-emisor h2, .concliente h2{
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        margin: 0px;
        font-weight: 750;
        margin-bottom: 5px;
    }
    .con-emisor h4, .table-left table tr td h4, .table-right table tr td h4{
        margin: 0px;
        padding-left: 10px;
        font-family: "Nunito Sans", sans-serif;
        font-size: 13px;
    }
    .con-emisor i, .table-left table tr td i, .table-right table tr td i{
        font-family: "Poppins", sans-serif;
        font-weight: normal;
        font-style: normal;
        font-size: 13px;
        display: block;
        width: 100%;
    }
    .table-left{
        width: 60%;
        margin: 0px;
        float: left;
    }
    .table-left table, .table-right table{
        width: 100%;
    }
    .table-right{
        float: right;
        width: 40%;
    }
    .header-tab th{
        background: #505765;
        margin: 0px;
        padding: 0px;
        text-align: center;
        color: white;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        height: 50px;
    }
    .con-table-produ{
        padding-top: 165px;
    }
    .tabla-ord{
        border: none;
        border-collapse:collapse;
    }
    .tabla-ord tbody tr td{
        font-family: "Nunito Sans", sans-serif;
        font-size: 13px;
        text-align: center;
        height: 35px;
    }
    .last-row .child_last_row{
        border-top: 2px solid;
    }
    .msg-fo{
        float: left;
        width: 50%;
        font-family: "Poppins", sans-serif;
        font-weight: bold;
        font-size: 12px;
        text-align: center;
        padding-top: 30px;
    }
    .footer-bill{
        padding-top: 10px;
        border-top: 2px solid #505765;
        margin-top: 100px;

    }
    .info-detail{
        width: 50%;
        float: right;
        font-size: 12px;
    }
    .firt-col-foo{
        width: 130px;
        text-align: right;
        font-family: "Nunito Sans", sans-serif;
    }
    .sg-col-foo{
        width: 110px;
    }
    .th-col-foo{
        font-family: "Poppins", sans-serif;
        font-weight: bold;
    }
    
    </style>
</head>
<body>
    <div class="contenedor">
        <div class="header">
            <img src="https://raw.githubusercontent.com/HernanTo/lotus/9ba03edbffbdf523b1f3187ec5bf20214b9fef87/assets/img/icons/logotemp.svg" alt="">
            <div class="con-titlte">
                <h2>Factura</h2>
            </div>
        </div>
        ';
        foreach ($data as $dataBill){
            $canTotal = $dataBill['amount'];
            
                $html .= '
                    <div class="con-numeral">
                        <h1>N° '. $dataBill['num_fact'] .'</h1>
                    </div>
                    <div class="con-emisor">
                        <h2 style="font-weight: bold;">Datos del emisor</h2>
        
                        <table>
                            <tr>
                                <td style="width: 110px;"><h4>Razón social</h4></td>
                                <td style="width: 25px;">:</td>
                                <td><i>Lotus</i></td>
                            </tr>
                            <tr>
                                <td style="width: 110px;"><h4>NIT</h4></td>
                                <td style="width: 25px;">:</td>
                                <td><i>0</i></td>
                            </tr>
                            <tr>
                                <td style="width: 110px;"><h4>Dirección</h4></td>
                                <td style="width: 25px;">:</td>
                                <td><i>Bogotá temp</i></td>
                            </tr>
                            <tr>
                                <td style="width: 110px;"><h4>Teléfono</h4></td>
                                <td style="width: 25px;">:</td>
                                <td><i>3132093326</i></td>
                            </tr>
                        </table>
                    </div>
                    <div class="concliente" style="height: 500px">
                        <div class="header-cliente">
                            <h2 style="font-weight: bold;">Datos del cliente</h2>
                        <div class="table-left">
                            <table>
                                <tr>
                                    <td style="width: 110px;"><h4>Fecha</h4></td>
                                    <td style="width: 25px;">:</td>
                                    <td><i>'. $dataBill['date'] .'</i></td>
                                </tr>
                                <tr>
                                    <td style="width: 110px;"><h4>Cliente</h4></td>
                                    <td style="width: 25px;">:</td>
                                    <td><i>'. $dataBill['fullname'] .'</i></td>
                                </tr>
                                <tr>
                                    <td style="width: 110px;"><h4>Dirección</h4></td>
                                    <td style="width: 25px;">:</td>
                                    <td><i>'. $dataBill['address'] .'</i></td>
                                </tr>
                                <tr>
                                    <td style="width: 110px;"><h4>NIT/ C.C. </h4></td>
                                    <td style="width: 25px;">:</td>
                                    <td><i>'. $dataBill['cedula'] .'</i></td>
                                </tr>
                                <tr>
                                    <td style="width: 110px;"><h4>Teléfono</h4></td>
                                    <td style="width: 25px;">:</td>
                                    <td><i>'. $dataBill['phone'] .'</i></td>
                                </tr>
                            </table>
                        </div>
                        <div class="table-right">
                            <table>
                                <tr>
                                    <td style="width: 110px;"><h4>Centro</h4></td>
                                    <td style="width: 25px;">:</td>
                                    <td><i>Bogotá temp</i></td>
                                </tr>
                                <tr>
                                    <td style="width: 110px;"><h4>Contacto</h4></td>
                                    <td style="width: 25px;">:</td>
                                    <td><i></i></td>
                                </tr>
                                <tr>
                                    <td style="width: 110px;"><h4>Placa</h4></td>
                                    <td style="width: 25px;">:</td>
                                    <td><i>'. $dataBill['placa'] .'</i></td>
                                </tr>
                                <tr>
                                    <td style="width: 110px;"><h4>Modelo</h4></td>
                                    <td style="width: 25px;">:</td>
                                    <td><i>'. $dataBill['modelo'] .'</i></td>
                                </tr>
                                ';
        }
        foreach($seller as $datosseller){
            $html .= '<tr>
                <td style="width: 110px;"><h4>Vendedor</h4></td>
                <td style="width: 25px;">:</td>
                <td><i>'. $datosseller['fi_lastname'] . ' ' . $datosseller['sc_lastname'] .' ' . $datosseller['ft_name'] .' ' . $datosseller['sc_lastname'] .'</i></td>
                ';
        }
                                $html .= '</tr>
                            </table>
                        </div>
        
                    </div>
                    <div class="con-table-produ">
                        <table class="tabla-ord">
                            <tr class="header-tab">
                                <th style="width: 110px; border-radius: 12px 0px 0px 12px;">Material</th>
                                <th style="width: 180px;">Descripción</th>
                                <th style="width: 30px;">Cant</th>
                                <th style="width: 110px;">Valor unitario PVP</th>
                                <th style="width: 90px;">Vr. Unitario. CLI</th>
                                <th style="width: 100px;">Vr. Total CLI</th>
                                <th style="width: 80px; border-radius: 0px 12px 12px 0px;">Dcto por línea (%)</th>
                            </tr>
                            <tbody>
                            ';
                            $canProd = mysqli_num_rows($product);
                            $count = 1;
                            foreach($product as $datosProducto){
                                if($datosProducto['mano_obra'] == 1){
                                    $nombreProducto = $datosProducto['name_product'] . ' Mano de obra';
                                }else{
                                        $nombreProducto = $datosProducto['name_product'];
                                }
                                $html .='<tr>
                                      <td>'. $datosProducto['num_repuesto'] .'</td>
                                      <td>'. $nombreProducto .'</td>
                                      <td>'. $datosProducto['amount'] .'</td>
                                      <td>'. $datosProducto['price_u'] .'</td>
                                      <td>'. $datosProducto['price_u'] .'</td>
                                      <td>'. $datosProducto['prices_total'] .'</td>
                                      <td>0,00</td>
                                  </tr>
                                  ';

                                  if($canProd == $count){
                                      $html .= '<tr class="last-row">
                                          <td></td>
                                          <td style="font-weight: bold;" class="child_last_row">Subtotal</td>
                                          <td style="font-weight: bold;" class="child_last_row">'. $canTotal .'</td>
                                          <td class="child_last_row"></td>
                                          <td class="child_last_row"></td>
                                          <td class="child_last_row"></td>
                                          <td class="child_last_row"></td>
                                      </tr>';
                                    
                                }
                                $count = $count + 1;

                            }
                            $html .= '</tbody>
                        </table>
                    </div>
                    <div class="footer-bill">
                        <div class="msg-fo">
                        Sujeto a variación de precio y stock. <br>
                        Cotización válida hasta 30.05.2023
                        </div>
                        <table class="info-detail">
                            ';

                            foreach ($data as $dataBill){
                                $html .=' <tr>
                                    <td class="firt-col-foo">Subtotal PU</td>
                                    <td class="sg-col-foo">:</td>
                                    <td class="th-col-foo"> '. $dataBill['subtotal'] .'</td>
                                </tr>
                                <tr>
                                    <td class="firt-col-foo">Total Dcto y / o Recargo</td>
                                    <td class="sg-col-foo">:</td>
                                    <td class="th-col-foo"> -</td>
                                </tr>
                                <tr>
                                    <td class="firt-col-foo">Subtotal CLI</td>
                                    <td class="sg-col-foo">:</td>
                                    <td class="th-col-foo"> '. $dataBill['subtotal'] .'</td>
                                </tr>
                                <tr>
                                    <td class="firt-col-foo">IVA</td>
                                    <td class="sg-col-foo">:</td>
                                    <td class="th-col-foo"> '. $dataBill['subtotal'] * 0.19 .'</td>
                                </tr>
                                <tr>
                                    <td class="firt-col-foo">Total CLI</td>
                                    <td class="sg-col-foo">:</td>
                                    <td class="th-col-foo">'. $dataBill['total_prices'] .'</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </body>
                </html>
            ';

                            }


// Crear una instancia de Dompdf
$dompdf = new Dompdf(['enable_remote' => true, 'enable_svg' => true]);
$dompdf->setPaper('A4', 'portrait');

// Cargar el contenido HTML en Dompdf
$dompdf->loadHtml($html);

// Renderizar el contenido HTML en PDF
$dompdf->render();

// Descargar el PDF directamente al cliente
$namefile = 'Factura_' . $_GET['referencia'] . '_Lotus.pdf';

ob_clean();
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename='. $namefile);
echo $dompdf->output();
?>