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
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
</head>
<style>
    body{
        margin: 0px;
        padding: 0px;
    }
    @font-face {
    font-family: "Alata";
    src: url("https://raw.githubusercontent.com/HernanTo/lotus/bill/assets/formatos/font/alata/Alata-Regular.ttf") format("truetype");
    font-weight: bold;
    }
    @font-face {
    font-family: "Poppins";
    src: url("https://raw.githubusercontent.com/HernanTo/lotus/bill/assets/formatos/font/Poppins/Poppins-Regular.ttf") format("truetype");
    font-weight: normal;
    }

    @font-face {
    font-family: "Poppins";
    src: url("https://raw.githubusercontent.com/HernanTo/lotus/bill/assets/formatos/font/Poppins/Poppins-SemiBold.ttf") format("truetype");
    font-weight: bold;
    }

    @font-face {
    font-family: "Nunito";
    src: url("https://raw.githubusercontent.com/HernanTo/lotus/bill/assets/formatos/font/Nunito_Sans/static/NunitoSans_10pt-Regular.ttf") format("truetype");
    font-weight: normal;
    }

    @font-face {
    font-family: "Nunito";
    src: url("https://raw.githubusercontent.com/HernanTo/lotus/bill/assets/formatos/font/Nunito_Sans/static/NunitoSans_10pt-Bold.ttf") format("truetype");
    font-weight: bold;
    }
    @page {
        margin-top: 230px;
        margin-bottom: 130px;
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
        height: 220px;
    }
    hr{
        margin: 0px
    }
    .header table{
        width: 100%;
        font-family: "Poppins";
        border-collapse: collapse;
        height: 100%;
    }
    .head_con h2{
        margin: 0px;
        padding: 0px;
        font-size: 40px;
        text-align: center;
    }
    .head_con{
        background: #00458E;
        color: white;
        width: 100%;
        padding: 30px 0px;
        margin: 0px;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        margin-top: -2px;
    }

    .header table .info_bill b{
        font-family: "Alata";
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
        font-family: "Nunito";
        font-size: 15px;
        height: 30px;
    }
    .table_info_usr tbody tr{
        padding-bottom: 50px;
    }
    .table_info_usr tbody tr td b{
        font-family: "Poppins";
    }
    .colm_sc{
        text-align: right;
    }
    .th__main_usr{
        border-bottom: 2px solid black;
        font-family: "Alata";
    }
    .con_table{
        padding: 20px;
    }
    .table__b{
        border-collapse: collapse; 
        border-bottom: 2px solid;
        font-family: "Nunito";
        width: 100%;
    }
    .table__b thead th{
        background: #505765;
        color: white;
        font-family: "Alata";
    }
    .table__b tbody tr{
        background: #C9C9C9;
    }
    .table__b tbody .odd{
        background: rgba(201, 201, 201, 0.5);
    }
    #table_rsume{
        width: 100%;
        border-top: 2px solid;
    }
    #table_rsume tr td{
        text-align: right;
        font-family: "Poppins";
    }
    #table_rsume tr td b{
        font-family: "Alata";
    } 
    
    .info_bill td{
        padding: 20px 0px 0px 0px;
    }
</style>
<body>
    <div class="header">
        <table>
            <tr>
                <td style="width: 300px;">
                    <div class="head_con"><h2>Factura</h2></div>
                </td>
                <td class="info_lotus">
                    <b>Taller mecánico Lotus</b>  <br>
                    <b>EMAIL: </b>  <br>
                    <b>TÉLEFONO: </b>  <br>
                    <b>NIT/CC: </b>  <br>
                    Bogotá D.C
                </td>
                <td style="width: 130px; text-align: center;">
                    <img src="https://raw.githubusercontent.com/HernanTo/lotus/master/assets/img/icons/LotusBills.png" alt="logo_lotus" class="logo__lotus">
                </td>
            </tr>
            <tr class="info_bill">
                <td><b>NÚMERO DE FACTURA: </b>10101010</td>
                <td colspan="2" style="text-align: right;"><b>FECHA DE FACTURA: </b> 10/03/23</td>
            </tr>
        </table>
        <hr>
    </div>
    <div class="main-content">
        <main class="body__content">
            <table class="table_info_usr">
                <thead>
                    <tr class="th__main_usr">
                        <th height="40" style="text-align: left;">DATOS CLIENTE</th>
                        <th class="colm_sc" height="40">INFORMACIÓN VEHÍCULO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <b>Nombre:</b> Andrés Calamaro
                        </td>
                        <td class="colm_sc">
                            <b>Marca:</b> Chevrolet
                        </td>
                    </tr>
                    <tr>
                        <td><b>Dirección: </b>Bogotá</td>
                        <td class="colm_sc"><b>Modelo:</b>Aveo</td>
                    </tr>
                    <tr>
                        <td><b>NIT/CC:</b>73734384</td>
                        <td class="colm_sc"><b>Año Módelo: </b>2015</td>
                    </tr>
                    <tr>
                        <td><b>Teléfono: </b>326734674</td>
                        <td class="colm_sc"><b>Color:</b>Negro</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="colm_sc"><b>Placa:</b>NNN000</td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Técnico/Vendedor: </b>Torres Rodríguez Hernán</td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <div class="con_table">
                <table class="table__b">
                    <thead>
                        <tr>
                            <th>SERVICIOS REALIZADOS</th>
                            <th>PRECIO</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                        <tr class="odd">
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="con_table">
                <table class="table__b">
                    <thead>
                        <tr>
                            <th>PARTES</th>
                            <th>CANTIDAD</th>
                            <th>PRECIO/U</th>
                            <th>DESCUENTO %</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                        <tr class="odd">
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="con_table">
                <table class="table__b">
                    <thead>
                        <tr>
                            <th>DESCUENTOS</th>
                            <th>%</th>
                            <th>VALOR DCTO</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                        <tr class="odd">
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                        <tr>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                        <tr class="odd">
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                        <tr>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                        <tr class="odd">
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                        <tr>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                        <tr class="odd">
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                        <tr>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                        <tr class="odd">
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="con_table">
                <table id="table_rsume">
                    <tr>
                    </tr>
                    <tr>
                        <td><b>SUBTOTAL SIN DESCUENTO: </b></td>
                    </tr>
                    <tr>
                        <td><b>DESCUENTO: </b></td>
                    </tr>
                    <tr>
                        <td><b>SUBTOTAL CON DESCUENTO: </b></td>
                    </tr>
                    <tr>
                        <td><b>IVA: </b></td>
                    </tr>
                    <tr>
                        <td><b>TOTAL: </b></td>
                    </tr>
                </table>
            </div>
        </main>
    </div>
</body>
</html>';


// Crear una instancia de Dompdf
$dompdf = new Dompdf(
    [
        'enable_remote' => true,
         'enable_svg' => true, 
         'isFontSubsettingEnabled' => true,
         'defaultMediaType' =>'all',
         'isFontSubsettingEnabled'=> true,
    ]);
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