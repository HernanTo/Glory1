<?php
    include('../../model/product.php');
    $Product = new Product;

    $products = $Product->index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de productos</title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/directorio.css">
    <link rel="shortcut icon" href="../../assets/img/icons/logo_small.svg" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="header-directory">
            <div class="con-logo-d"><img src="../../assets/img/icons/Logo_glory.svg" alt="Glory Store"></div>
            <div class="title-header"><h2>Listado de productos</h2></div>
        </div>
        <div class="con-products">
            <?php
                foreach($products as $product){
                    $url = "../../assets/img/products/" . $product['photo'];
                    ?>
                        <div class="product">
                            <div class="img-product">
                                <img src="<?php $url ?>" alt="">
                            </div>
                            <div class="info_produc">
                                <h2><?php echo $product['name_product'] ?></h2>
                                <span class="stock">Disponible</span>
                                <span class="prices"><?php echo $product['prices'] ?></span>
                            </div>
                        </div>
                    <?php
                }
            ?>
        </div>
        <a class="burb-flo" href="https://wa.me/573102452756?text=Quiero%20realizar%20una%20cotizaci%C3%B3n%20de%20algunos%20repuestos." target="_blank"><img src="../../assets/img/icons/WhatsApp.svg" alt="Whatsapp"></a>
    </div>
    <script src="../../libs/bootstrap/jquery.js"></script>
    <script>
        function formatCurrency(number) {
        if (isNaN(number)) {
        return "Invalid number";
        }
        let formattedNumber = new Intl.NumberFormat("es-CO").format(number);
        formattedNumber = `$${formattedNumber}`;

        return formattedNumber;
    }
    let prices = document.querySelectorAll('.prices');
    for (let i = 0; i < prices.length; i++) {
    let precio = prices[i].textContent;
        $(prices[i]).empty();
        prices[i].appendChild(document.createTextNode(formatCurrency(precio)));
    }
    </script>
</body>
</html>