<?php
    class Product{
        public function store($nameProduct, $barcode, $photo_product, $stock, $category, $price_product){
            require ('../config/connection.php');
            $folder = '../assets/img/products/';
            $namePiture = $photo_product['name'];
            $typedPiture = pathinfo($photo_product['name'], PATHINFO_EXTENSION);
			$sizePitureFile = $photo_product['size'];
            $num = rand(1111,9999);
			$filefinal = $num. 'product.' . $typedPiture;


            if(move_uploaded_file($photo_product['tmp_name'], $folder . $filefinal)){
                chmod($folder . $filefinal, 0777);
                $input = "INSERT INTO producto(Barcode, name_product, prices, amount, state, photo) VALUES ('$barcode','$nameProduct','$price_product','$stock', 1,'$filefinal')";

                mysqli_query($db, $input);
                $product = mysqli_insert_id($db);

                $input = "INSERT INTO product_has_category(id_product, id_category) VALUES ('$product','$category')";
                mysqli_query($db, $input);
                $_SESSION['newProduct'] = true;

                include('../model/log.php');
                date_default_timezone_set('America/Bogota');
                $date =  date("Y-m-d H:i:s");
                $Log = new Log;

                $Log->store($_SESSION['user_id'], '2', 'Se creó un nuevo producto', $date, 1);

                header('Location: ../views/product/');
            }

        }

        public function index(){
            require ('../../config/connection.php');

            $input = "SELECT producto.id as id_product, Barcode, name_product, prices, amount, producto.state, category, Barcode, photo FROM producto
            INNER JOIN product_has_category
            ON id_product = producto.id
            INNER JOIN category
            ON id_category = category.id
            WHERE producto.state = 1";

            $output = $db->query($input);


            return $output;
        }

        public function delete($id){
            require ('../config/connection.php');
            $input = "UPDATE producto SET state='0' WHERE id = $id";
            mysqli_query($db, $input);

            $_SESSION['deleteProduct'] = true;
            include('../model/log.php');
            date_default_timezone_set('America/Bogota');
            $date =  date("Y-m-d H:i:s");
            $Log = new Log;

            $Log->store($_SESSION['user_id'], '3', 'Se eliminó un producto', $date, 1);

            header('Location: ../views/product/');
        }
    }
?>