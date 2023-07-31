<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura <?php $_GET['referencia'] ?></title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&display=swap" rel="stylesheet">

</head>
<style>
    table{
    background: red;
    width: 100%;
    font-family: 'Nunito Sans', sans-serif;
}
</style>
<body>
    <?php
        // $nombreImagen = "logo_example.png";
        // $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
        // phpinfo();
        // $imageUrl = (string) Image::make(public_path($path)) ->fit(80, 80) ->encode('data-url');
    ?>
    <div style="background: RED;">

        <img src="../../../assets/img/icons/lotus.svg" alt="logo">
    </div>
    <table>
        <tr>
            <th>Material</th>
            <th>Descripción</th>
            <th>Cant.</th>
            <th>Valor unitario</th>
            <th>Vr. Unitario.</th>
            <th>Vr. Total CLI</th>
            <th>Dcto por</th>
        </tr>
        <tbody>
            <tr>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
            </tr>
        </tbody>
    </table>
</body>
</html>