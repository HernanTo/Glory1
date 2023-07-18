<?php
        require ('../../model/bill.php');
        $Bill = new Bill;

        list($data, $product) = $Bill->generateBill($_GET['referencia']);
?>
<style>
        .container-bill-ex{
            background: #fff;
            padding: 35px 35px;
            width: 285px !important;
            border-radius: 5px;
            border: 2px solid #000;
        }
        table{
            border-collapse: collapse;
        }
        table tr th{
            font-family: 'Poppins';
            font-size: 22px;
            padding-bottom: 10px;
            text-align: center !important;
        }
        table tr td{
            font-family: 'Nunito';
            
        }
        .con-btn-x{
            display: grid;
            grid-template-columns: repeat(auto-fit, 180px);
            grid-template-rows: repeat(3, 50px);
            row-gap: 10px;
            justify-content: center;
            width: 285px;
        }
        .con-btn-x a{
            background: red;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            text-decoration: none;
            cursor: pointer;
        }
        .contain-expo{
            display: grid;
            row-gap: 20px;
            grid-template-columns: repeat(auto-fit, 285px);
            justify-content: center;
        }
</style>
<div class="contain-expo">
    <div class="container-bill-ex">
        <?php 
        foreach ($data as $fila) {
            $idfact = $fila['id'];
        ?>
        <table>
            <tr>
                <th colspan="2">Lotus</th>
            </tr>
            <tr>
                <td colspan="2">Adress: 1234 Lorem Ipsum, Dolor</td>
            </tr>
            <tr>
                <td colspan="2">Tel: 123-456-7890</td>
            </tr>
            <tr style="border-bottom: 1px dashed black;border-top: 1px dashed black; height: 35px;">
                <td style="padding-left: 10px;">Fecha:</td>
                <td><?php echo $fila['date'] ?></td>
            </tr>
            <?php
                
                while($row = $product->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $row['name_product'] ?></td>
                        <td style="text-align: right;"><?php echo $row['price_u'] ?></td>
                    </tr>
                    <?php
                }
            ?>
            <tr style="border-top: 1px dashed black;">
                <td style="font-family: 'Poppins'; font-size: 20px;">Total</td>
                <td style="text-align: right;"><?php echo $fila['total_prices'] ?></td>
            </tr>
            <tr>
                <td>Sub-total</td>
                <td style="text-align: right;"><?php echo $fila['subtotal'] ?></td>
            </tr>
            <tr>
                <td>IVA</td>
                <td style="text-align: right;"><?php echo ($fila['total_prices'] - $fila['subtotal']) ?></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;font-weight: bold;font-family: 'Poppins'; font-size: 23px; padding-top: 20px;padding-bottom: 10px;">Gracias</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                <img alt='Barcode Generator TEC-IT' src='https://barcode.tec-it.com/barcode.ashx?data=<?php echo $fila['num_fact'] ?>&code=Code128&translate-esc=true' style="width: 210px; height: 90px"/>
            </td>
            </tr>
        </table>
        <?php
        }
        ?>
    </div>
    <div class="con-btn-x">
        <a href="" style="background: #009ef7; color: white;">Exportar factura</a>
        <a href="" style="background: rgb(10, 88, 202); color: white;">Editar</a>
        <a onclick="confirmTrash(<?php echo $idfact ?>, <?php echo $_GET['referencia'] ?>)" style="background: #c9c9c9; color: black;">Eliminar</a>
    </div>
</div>
