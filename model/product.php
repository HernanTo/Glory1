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

                header('Location: ../views/product/');
            }

        }

        public function index(){
            require ('../../config/connection.php');
            
            $input = "SELECT producto.id as id_product, Barcode, name_product, prices, amount, state, category, Barcode, photo FROM producto
            INNER JOIN product_has_category
            ON id_product = producto.id
            INNER JOIN category
            ON id_category = category.id
            WHERE state = 1";

            $output = $db->query($input);
            

            return $output;
        }

        public function delete($id){
            require ('../config/connection.php');
            $input = "UPDATE producto SET state='0' WHERE id = $id";
            mysqli_query($db, $input);

            $_SESSION['deleteProduct'] = true;

            header('Location: ../views/product/');
        }
    }
?>