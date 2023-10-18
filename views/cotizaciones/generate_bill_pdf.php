<?php
require('../../vendor/autoload.php');
include ('../../model/cotizaciones.php');
include ('../../model/service.php');
$Cotizacion = new Cotizaciones;
$Service = new Service;
if(isset($_GET['referencia'])){
        if($_GET['referencia'] == ''){
            header('Location: ./');
        }else{
            list($data, $products, $seller) = $Cotizacion->generateBill($_GET['referencia']);
            if(mysqli_num_rows($data) <= 0 ){
                    header('Location: ./');
            }
        }
    }else{
        header('Location: ./');
}

use Dompdf\Dompdf;

// Obtener el contenido del template
foreach($seller as $row){
    $nameLastSeller = $row['nameLas'];
    $fullNameSeller = $row['fullname'];
}
foreach($data as $row){
    $services = $Service->index($row['id_bill']);
    $subTProd = 0;
    $subTServ = 0;
    $subtDescu = 0;

    $html = "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Factura</title>
    </head>
    <style>
        body{
            margin: 0px;
            padding: 0px;
        }
        @font-face {
        font-family: 'Alata';
        src: url('https://raw.githubusercontent.com/HernanTo/lotus/bill/assets/formatos/font/alata/Alata-Regular.ttf') format('truetype');
        font-weight: bold;
        }
        @font-face {
        font-family: 'Poppins';
        src: url('https://raw.githubusercontent.com/HernanTo/lotus/bill/assets/formatos/font/Poppins/Poppins-Regular.ttf') format('truetype');
        font-weight: normal;
        }

        @font-face {
        font-family: 'Poppins';
        src: url('https://raw.githubusercontent.com/HernanTo/lotus/bill/assets/formatos/font/Poppins/Poppins-SemiBold.ttf') format('truetype');
        font-weight: bold;
        }

        @font-face {
        font-family: 'Nunito';
        src: url('https://raw.githubusercontent.com/HernanTo/lotus/bill/assets/formatos/font/Nunito_Sans/static/NunitoSans_10pt-Regular.ttf') format('truetype');
        font-weight: normal;
        }

        @font-face {
        font-family: 'Nunito';
        src: url('https://raw.githubusercontent.com/HernanTo/lotus/bill/assets/formatos/font/Nunito_Sans/static/NunitoSans_10pt-Bold.ttf') format('truetype');
        font-weight: bold;
        }
        @page {
            margin-top: 230px;
            margin-bottom: 50px;
        }
        .main-content{
            max-width: 700px;
        }
        .header{
            position: fixed;
            width: 700px;
            top: -230px;
            left: 0px;
            background: white;
            width: 100%;
            max-width: 700px;
            height: 230px;
        }
        hr{
            margin: 0px
        }
        .header table{
            width: 100%;
            font-family: 'Poppins';
            border-collapse: collapse;
            height: 100%;
        }
        .head_con h2{
            margin: 0px;
            padding: 0px;
            font-size: 35px;
            text-align: center;
        }
        .head_con{
            background: #00458E;
            color: white;
            width: 100%;
            padding: 30px 0px 32px 0px;
            margin: 0px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            margin-top: -17px;
        }
        .header table .info_bill b{
            font-family: 'Alata';
        }
        .logo__lotus{
            width: 100px;
        }
        .info_lotus{
            text-align: right;
            font-size: 14px;
        }
        .table_info_usr{
            text-align: left;
            border-collapse: collapse; 
            width: 100%;
        }
        .table_info_usr tbody tr td{
            padding-left: 20px;
            padding-right: 20px;
            font-family: 'Nunito';
            font-size: 15px;
            height: 30px;
        }
        .table_info_usr tbody tr{
            padding-bottom: 50px;
        }
        .table_info_usr tbody tr td b{
            font-family: 'Poppins';
        }
        .colm_sc{
            text-align: left;
            padding-left: 100px !important;
        }
        .th__main_usr{
            border-bottom: 2px solid black;
            font-family: 'Alata';
        }
        .con_table{
            padding: 20px;
        }
        .con_table table{
            text-align: center;
        }
        .table__b{
            border-collapse: collapse; 
            font-family: 'Nunito';
            width: 100%;
        }
        .table__b thead th{
            background: #505765;
            color: white;
            font-family: 'Alata';
        }
        .table__b tbody tr{
            background: #C9C9C9;
        }
        .table__b tbody .odd{
            background: rgba(201, 201, 201, 0.5);
        }
        .con_resumen{
            height: 160px;
            min-height: 155px;
            max-height: 160px;
        }
        #table_rsume{
            width: 100%;
            height: 100%;
            border-top: 2px solid;
            page-break-inside: avoid

        }
        #table_rsume tr td{
            text-align: right;
            font-family: 'Poppins';
        }
        #table_rsume tr td b{
            font-family: 'Alata';
        } 
        
        .info_bill td{
            padding: 20px 0px 0px 0px;
        }
        .subtr{
            background: #ffffff !important;
            border-top: 2px solid;
        }
        .subtd b{
            text-align: right  !important;
            font-family: 'Alata' !important;
        }
        .name_tall{
            font-size: 17px;
        }
    </style>
    <body>
        <div class='header'>
            <table class='table_infoo'>
                <tr>
                    <td style='width: 300px;'>
                        <div class='head_con'><h2>COTIZACIÓN</h2></div>
                    </td>
                    <td class='info_lotus'>
                        <b class='name_tall'>Glory Store</b>  <br>
                        <b>EMAIL: </b>   soporte@tallerglory.store<br>
                        <b>TÉLEFONO: </b>  3102452756<br>
                        <b>NIT/CC: </b>  80864878<br>
                        CL 64 103A-33, Bogotá
                    </td>
                    <td style='width: 130px; text-align: center;'>
                        <img src='https://raw.githubusercontent.com/HernanTo/lotus/master/assets/img/icons/LotusBills.jpg' alt='logo_lotus' class='logo__lotus'>
                    </td>
                </tr>
                <tr class='info_bill'>
                    <td><b>NÚMERO DE COTIZACIÓN: </b>". $row['num_fact'] ."</td>
                    <td colspan='2' style='text-align: right;'><b>FECHA DE FACTURA: </b> ". $row['date'] ."</td>
                </tr>
            </table>
            <hr>
        </div>
        <div class='main-content'>
            <main class='body__content'>
                <table class='table_info_usr'>
                    <thead>
                        <tr class='th__main_usr'>
                            <th height='40' style='text-align: left;'>DATOS CLIENTE</th>
                            <th class='colm_sc' height='40'>INFORMACIÓN VEHÍCULO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <b>Nombre:</b> ". $row['nameLas'] ."
                            </td>
                            <td class='colm_sc'>
                                <b>Marca:</b> 
                            </td>
                        </tr>
                        <tr>
                            <td><b>Dirección: </b>Bogotá</td>
                            <td class='colm_sc'><b>Modelo:</b>". $row['modelo'] ."</td>
                        </tr>
                        <tr>
                            <td><b>NIT/CC:</b>73734384</td>
                            <td class='colm_sc'><b>Año Módelo: </b></td>
                        </tr>
                        <tr>
                            <td><b>Teléfono: </b>326734674</td>
                            <td class='colm_sc'><b>Color:</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class='colm_sc'><b>Placa:</b>". $row['placa']. "</td>
                        </tr>
                        <tr>
                            <td colspan='2'><b>Técnico/Vendedor: </b>$nameLastSeller</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                ";
                $estadoDescuentos = false;
                if(mysqli_num_rows($products) > 0){
                    $html .= "<div class='con_table'>
                        <table class='table__b'>
                            <thead>
                                <tr>
                                    <th>PARTES</th>
                                    <th>CANTIDAD</th>
                                    <th>STOCK</th>
                                    <th>PRECIO/U</th>
                                    <th>DESCUENTO %</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>";
                                $countProduct = 0;
                                foreach($products as $product){
                                    if($datosProducto['stock'] == 0){
                                        $stock = 'No';
                                    }else{
                                        $stock = 'Si';
                                    }

                                    if($product['descuento'] > 0){
                                        $estadoDescuentos = true;
                                    }
                                    $odd = $countProduct == 1 ? 'odd' : 'a';
                                    $html .="<tr class='".$odd."'>
                                          <td>". $product['name_product'] ."</td>
                                          <td>". $product['amount'] ."</td>
                                          <td>". $stock ."</td>
                                          <td>". $product['price_u'] ."</td>
                                          <td>". (floatval($product['descuento']) * 100) . '%' ."</td>
                                          <td>". $product['price_u'] * $product['amount'] ."</td>
                                      </tr>
                                      ";
                                      $countProduct = $countProduct == 1 ? 0 : 1;
                                      $subTProd += $product['price_u'] * $product['amount'];
                                }
                                $html.="
                                    <tr class='subtr'>
                                        <td colspan='5' class='subtd'><b>SUBTOTAL</b></td>
                                        <td>$subTProd</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>";
                }

                $estadoManoObra = false;
                foreach($products as $product){
                    if($product['mano_obra'] == 1){
                        $estadoManoObra = true;
                    }
                }
                if(mysqli_num_rows($services) > 0 || $estadoManoObra){
                    $countService = 0;
                    $html .= "<div class='con_table'>
                        <table class='table__b'>
                            <thead>
                                <tr>
                                    <th>SERVICIOS REALIZADOS</th>
                                    <th>PRECIO</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>";
                    if(mysqli_num_rows($services) > 0){
                        foreach($services as $service){
                            $odd = $countService == 1 ? 'odd' : 'a';
                            $html .= "<tr class='". $odd."'>
                                    <td>". $service['detail'] ."</td>
                                    <td>". $service['price'] ."</td>
                                    <td>". $service['price'] ."</td>
                                </tr>";
                            $countService = $countService == 1 ? 0 : 1;
                            $subTServ += intval($service['price']);
                        }
                    }
                    if($estadoManoObra){
                        foreach($products as $product){
                            $odd = $countService == 1 ? 'odd' : 'a';
                            if($product['mano_obra'] == 1){
                                $html .= "<tr class='". $odd."'>
                                    <td>". 'Mano de obra | Parte: ' .$product['name_product'] ."</td>
                                    <td>". $product['prices_mano_obra'] ."</td>
                                    <td>". $product['prices_mano_obra'] ."</td>
                                </tr>";
                                $subTServ += intval($product['prices_mano_obra']);
                                $countService = $countService == 1 ? 0 : 1;
                            }
                        }
                    }
                    $html .= "
                                <tr class='subtr'>
                                    <td colspan='2' class='subtd'><b>SUBTOTAL</b></td>
                                    <td>$subTServ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>";
                }
                if($estadoDescuentos){
                    $html .= "<div class='con_table'>
                        <table class='table__b'>
                            <thead>
                                <tr>
                                    <th>DESCUENTOS</th>
                                    <th>%</th>
                                    <th>VALOR DCTO</th>
                                    <th>Precio F.</th>
                                </tr>
                            </thead>
                            <tbody>";
                                $countDesc = 0;
                                foreach($products as $products){
                                    if($product['descuento'] > 0){
                                        $odd = $countDesc == 1 ? 'odd' : 'a';
                                        $descuento = floatval($product['prices_total']) * $product['descuento'];
                                        $html .= "<tr class='".$odd."'>
                                            <td>". $product['name_product'] ."</td>
                                            <td>". (floatval($product['descuento']) * 100) . '%' ."</td>
                                            <td>". $descuento ."</td>
                                            <td>". (floatval($product['prices_total']) - $descuento) ."</td>
                                        </tr>";
                                        $countDesc = $countDesc == 1 ? 0 : 1;
                                        $subtDescu += $descuento;
                                    }

                                }
                    $html .= "
                                <tr class='subtr'>
                                    <td colspan='3' class='subtd'><b>SUBTOTAL</b></td>
                                    <td>- $subtDescu</td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>";
                }
                $iva = $row['iva'] = 'true' ? $row['subtotal'] * 0.19 : 'No Aplica';
                $descu = $subtDescu <= 0 ? 'No Aplica' : '- ' . $subtDescu;

                $html .= "<div class='con_table con_resumen'>
                    <table id='table_rsume'>
                        <tr>
                        </tr>
                        <tr>
                            <td><b>SUBTOTAL SIN DESCUENTO:</b> ". ($subTProd + $subTServ) ."</td>
                        </tr>
                        <tr>
                            <td><b>DESCUENTO: </b> ". $descu ."</td>
                        </tr>
                        <tr>
                            <td><b>SUBTOTAL CON DESCUENTO: </b> ". ($subTProd + $subTServ) - $subtDescu ."</td>
                        </tr>
                        <tr>
                            <td><b>IVA: </b> ". $iva ."</td>
                        </tr>
                        <tr>
                            <td><b>TOTAL: </b> ". $row['total_prices'] ."</td>
                        </tr>
                    </table>
                </div>
            </main>
        </div>
    </body>
    </html>";
}
// echo $html;
$dompdf = new Dompdf(
    [
        'enable_remote' => true,
         'enable_svg' => true, 
         'isFontSubsettingEnabled' => true,
         'defaultMediaType' =>'all',
         'isFontSubsettingEnabled'=> true,
    ]);
$dompdf->setPaper('A4', 'portrait');
$dompdf->loadHtml($html);
$dompdf->render();
$namefile = 'Cotizacion_' . $_GET['referencia'] . '_Lotus.pdf';

ob_clean();
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename='. $namefile);
echo $dompdf->output();
?>