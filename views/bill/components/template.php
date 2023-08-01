<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <link rel="stylesheet" href="./main.css">
    <style>
        body{
    margin: 0px;
    padding: 0px;
}
.contenedor{
    background: rgba(255, 0, 0, 0.173);
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
    font-family: 'Poppins';
    font-weight: Bold;
    padding-top: 9px;
}
.con-numeral h1{
    margin: 0px;
    font-family: 'Poppins';
    font-size: 1.3rem;
}

.con-emisor, .concliente{
    padding-left: 25px;
    padding-top: 15px;
}
.con-emisor h2, .concliente h2{
    font-family: 'Poppins';
    font-size: 15px;
    margin: 0px;
    font-weight: 750;
    margin-bottom: 5px;
}
.con-emisor h4, .table-left table tr td h4, .table-right table tr td h4{
    margin: 0px;
    padding-left: 15px;
    font-family: 'Nunito';
    width: 110px;
    font-size: 14px;
}
.con-emisor i, .table-left table tr td i, .table-right table tr td i{
    font-family: 'Poppins';
    font-weight: normal;
    font-style: normal;
    padding-left: 5px;
    font-size: 14px;
}
.table-left{
    width: 50%;
    margin: 0px;
    float: left;
}
.table-left table, .table-right table{
    width: 100%;
}
.table-right{
    float: right;
    width: 50%;
}
.header-tab th{
    background: #505765;
    margin: 0px;
    padding: 0px;
    text-align: center;
    color: white;
    font-family: 'Poppins';
    font-size: 14px;
    height: 50px;
}
.tabla-ord{
    border: none;
    border-collapse:collapse;
}
.tabla-ord tbody tr td{
    font-family: 'Nunito';
    font-size: 13px;
    text-align: center;
    height: 35px;
}
    </style>
</head>
<body>
    <div class="contenedor">
        <div class="header">
            <img src="./logo_example.png" alt="">
            <div class="con-titlte">
                <h2>Factura</h2>
            </div>
        </div>
        <div class="con-numeral">
            <h1>N° 348734834734</h1>
        </div>
        <div class="con-emisor">
            <h2>Datos del emisor</h2>

            <table>
                <tr>
                    <td><h4>Razón social</h4></td>
                    <td>:</td>
                    <td><i>Lotus</i></td>
                </tr>
                <tr>
                    <td><h4>NIT</h4></td>
                    <td>:</td>
                    <td><i>0</i></td>
                </tr>
                <tr>
                    <td><h4>Dirección</h4></td>
                    <td>:</td>
                    <td><i>Bogotá temp</i></td>
                </tr>
                <tr>
                    <td><h4>Teléfono</h4></td>
                    <td>:</td>
                    <td><i>3132093326</i></td>
                </tr>
            </table>
        </div>
        <div class="concliente">
            <div class="header-cliente">
                <h2>Datos del cliente</h2>
            </div>
            <div class="table-left">
                <table>
                    <tr>
                        <td><h4>Fecha</h4></td>
                        <td>:</td>
                        <td><i>23-07-28</i></td>
                    </tr>
                    <tr>
                        <td><h4>Cliente</h4></td>
                        <td>:</td>
                        <td><i>Donna Winny De Leek OFielly</i></td>
                    </tr>
                    <tr>
                        <td><h4>Dirección</h4></td>
                        <td>:</td>
                        <td><i>856 Manitowish Hill</i></td>
                    </tr>
                    <tr>
                        <td><h4>NIT/ C.C. </h4></td>
                        <td>:</td>
                        <td><i>77</i></td>
                    </tr>
                    <tr>
                        <td><h4>Teléfono</h4></td>
                        <td>:</td>
                        <td><i>318</i></td>
                    </tr>
                </table>
            </div>
            <div class="table-right">
                <table>
                    <tr>
                        <td><h4>Centro</h4></td>
                        <td>:</td>
                        <td><i>Bogotá temp
                        </i></td>
                    </tr>
                    <tr>
                        <td><h4>Contacto</h4></td>
                        <td>:</td>
                        <td><i></i></td>
                    </tr>
                    <tr>
                        <td><h4>Marca</h4></td>
                        <td>:</td>
                        <td><i>ddd456</i></td>
                    </tr>
                    <tr>
                        <td><h4>Modelo</h4></td>
                        <td>:</td>
                        <td><i>fddsds</i></td>
                    </tr>
                    <tr>
                        <td><h4>Vendedor</h4></td>
                        <td>:</td>
                        <td><i>Lucamel Martin</i></td>
                    </tr>
                </table>
            </div>

            <div class="con-table-produ">
                <table class="tabla-ord">
                    <tr class="header-tab">
                        <th style="width: 110px; border-radius: 12px 0px 0px 12px;">Material</th>
                        <th style="width: 180px;">Descripción</th>
                        <th style="width: 50px;">Cant</th>
                        <th style="width: 110px;">Valor unitario PVP</th>
                        <th style="width: 90px;">Vr. Unitario. CLI</th>
                        <th style="width: 100px;">Vr. Total CLI</th>
                        <th style="width: 80px; border-radius: 0px 12px 12px 0px;">Dcto por línea (%)</th>
                    </tr>
                    <tbody>
                        <tr>
                            <td>22222</td>
                            <td>Prueba 5 Mano de obra</td>
                            <td>1</td>
                            <td>22000</td>
                            <td>22000</td>
                            <td>42000</td>
                            <td>0,00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>