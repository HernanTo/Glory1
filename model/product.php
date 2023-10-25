<?php
    class Product{
        public function store($nameProduct, $barcode, $photo_product, $stock, $category, $price_product, $num_repuesto, $min_stock, $product_cost){
            require ('../config/connection.php');
            $price = str_replace('$', '', $price_product);
            $price = str_replace(',', '', $price);
            $num = rand(1111,9999);

            if($photo_product['name'] == ''){
                $input = "INSERT INTO producto(Barcode, name_product, prices, amount, state, photo, min_stock, num_repuesto, num_photo, product_cost) VALUES ('$barcode','$nameProduct','$price','$stock', 1,'default.png', $min_stock, '$num_repuesto', $num, '$product_cost')";

                mysqli_query($db, $input);
                $product = mysqli_insert_id($db);


                foreach($category as $selectC){
                    $input = "INSERT INTO product_has_category(id_product, id_category) VALUES ('$product','$selectC')";
                    mysqli_query($db, $input);
                }

            }else{
                $folder = '../assets/img/products/';
                $namePiture = $photo_product['name'];
                $typedPiture = pathinfo($photo_product['name'], PATHINFO_EXTENSION);
                $sizePitureFile = $photo_product['size'];
                $filefinal = $num. 'product.' . $typedPiture;

                if(move_uploaded_file($photo_product['tmp_name'], $folder . $filefinal)){
                    chmod($folder . $filefinal, 0777);
                    $input = "INSERT INTO producto(Barcode, name_product, prices, amount, state, photo, min_stock, num_repuesto, num_photo, product_cost) VALUES ('$barcode','$nameProduct','$price','$stock', 1,'$filefinal', $min_stock, '$num_repuesto', $num, '$product_cost')";

                    mysqli_query($db, $input);
                    $product = mysqli_insert_id($db);


                    foreach($category as $selectC){
                        $input = "INSERT INTO product_has_category(id_product, id_category) VALUES ('$product','$selectC')";
                        mysqli_query($db, $input);

                    }
                }

            }

            $_SESSION['newProduct'] = true;

            include('../model/log.php');
            date_default_timezone_set('America/Bogota');
            $date =  date("Y-m-d H:i:s");
            $Log = new Log;

            $Log->store($_SESSION['user_id'], '2', 'Se creó un nuevo producto', $date, 1);

            header('Location: ../views/product/');

        }

        public function index(){
            require ('../../config/connection.php');

            $input = "SELECT producto.id as id_product, Barcode, name_product, prices, amount, producto.state, Barcode, photo FROM producto
            WHERE producto.state = 1";

            $output = $db->query($input);


            return $output;
        }
        public function indexBill(){
            require ('../../config/connection.php');

            $input = "SELECT producto.id as id_product, Barcode, name_product, prices, amount, producto.state, Barcode, photo FROM producto
            WHERE producto.state = 1 and amount > 0";

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


        public function showCategoryP($id){
            require ('../../config/connection.php');

            $input = "SELECT id_product,category  FROM product_has_category 
            INNER JOIN category ON category.id = id_category
            WHERE id_product = $id";

            $output = $db->query($input);



            foreach($output as $row){
                ?>
                    <div class="con-category-p-t"><?php echo $row['category'] ?></div>
                <?php
            }
        }
        public function CategoryP($id){
            require ('../../config/connection.php');

            $input = "SELECT id_product, category, id_category  FROM product_has_category 
            INNER JOIN category ON category.id = id_category
            WHERE id_product = $id";

            $output = $db->query($input);


            
            $result = [];
            foreach($output as $line){
                array_push($result, $line['id_category']);
            }
            return $result;
        }

        public function searchProduct($id){
            require ('../../config/connection.php');

            $input = "SELECT * FROM producto WHERE id = '$id'";
            $output = $db->query($input);

            return $output;
        }

        public function update($name_product, $barcode, $photo_product, $stock, $category, $price_product, $num_repuesto, $min_stock, $img_action, $id, $product_cost, $desc){
            require ('../config/connection.php');

            $price = str_replace('$', '', $price_product);
            $price = str_replace(',', '', $price);
            
            $product_cost = str_replace('$', '', $product_cost);
            $product_cost = str_replace(',', '', $product_cost);

            
            $input = "SELECT photo, num_photo FROM producto WHERE id = $id";
            $output = $db->query($input);
            $deletestate = false;
            $namePastPic = '';
            $numPastPic = 0;

            while($row = $output->fetch_assoc()){
                if($row['photo'] != 'default.png'){
                    $deletestate = true;
                    $namePastPic = $row['photo'];
                    $numPastPic = $row['num_photo'];
                }
            }

            if($img_action == 1){
                $folder = '../assets/img/products/';
                $namePiture = $photo_product['name'];
                $typedPiture = pathinfo($photo_product['name'], PATHINFO_EXTENSION);
                $sizePitureFile = $photo_product['size'];
                $filefinal = $numPastPic . 'product.' . $typedPiture;
                
                if($deletestate){
                    unlink($folder . $namePastPic);
                }

                if(move_uploaded_file($photo_product['tmp_name'], $folder . $filefinal)){
                    chmod($folder . $filefinal, 0777);
                    $input = "UPDATE producto SET Barcode = '$barcode', num_repuesto = '$num_repuesto', name_product = '$name_product', prices = '$price', amount = '$stock', min_stock = '$min_stock', photo = '$filefinal', product_cost = '$product_cost', `desc` = '$desc' WHERE id = $id";
    
                    mysqli_query($db, $input);
                    
                    $_SESSION['editProduct'] = 1;
    
                    include('../model/log.php');
                    date_default_timezone_set('America/Bogota');
                    $date =  date("Y-m-d H:i:s");
                    $Log = new Log;
    
                    $Log->store($_SESSION['user_id'], '1', 'Se editarón datos del producto ' . $barcode, $date, 1);
    
                }
            }elseif($img_action == '2'){
                if($deletestate){
                    unlink('../assets/img/products/' . $namePastPic);
                }

                $input = "UPDATE producto SET Barcode = '$barcode', num_repuesto = '$num_repuesto', name_product = '$name_product', prices = '$price', amount = '$stock', min_stock = '$min_stock', photo = 'default.png', product_cost = '$product_cost', `desc` = '$desc' WHERE id = $id";
                mysqli_query($db, $input);
                
                $_SESSION['editProduct'] = 1;

                include('../model/log.php');
                date_default_timezone_set('America/Bogota');
                $date =  date("Y-m-d H:i:s");
                $Log = new Log;

                $Log->store($_SESSION['user_id'], '1', 'Se editarón datos del producto ' . $barcode, $date, 1);

            }elseif($img_action == 0){
                $input = "UPDATE producto SET Barcode = '$barcode', num_repuesto = '$num_repuesto', name_product = '$name_product', prices = '$price', amount = '$stock', min_stock = '$min_stock', product_cost = '$product_cost', `desc` = '$desc' WHERE id = $id";

                mysqli_query($db, $input);

                $_SESSION['editProduct'] = 1;

                include('../model/log.php');
                date_default_timezone_set('America/Bogota');
                $date =  date("Y-m-d H:i:s");
                $Log = new Log;

                $Log->store($_SESSION['user_id'], '1', 'Se editarón datos del producto ' . $barcode, $date, 1);
            }

            $input = "DELETE FROM product_has_category WHERE id_product = $id";
            $output = $db->query($input);

            foreach($category as $selectC){
                $input = "INSERT INTO product_has_category(id_product, id_category) VALUES ('$id','$selectC')";
                mysqli_query($db, $input);
            }
        }
    }
?>