<?php
    class Cotizaciones{
        public function store($date_bill, $reference, $product_amount, $product_id, $customer, $seller, $product_price, $check, $pricemo, $descuento, $iva){
            require ('../config/connection.php');

            $amountT = 0;
            $subT = 0;
            $total = 0;
            $desc_total = 0;

            for ($i=0; $i < sizeof($product_id) ; $i++) {
                $amountT = $amountT + $product_amount[$i];

                if($check[$i] == 'true'){
                    if($descuento[$i] != 'NA'){
                        $subT = $subT + ($product_price[$i] * $product_amount[$i]) + $pricemo[$i];
                        $desc_total = $desc_total + ($subT * $descuento[$i]);
                        $subT =  $subT - ($subT * $descuento[$i]);
                    }else{
                        $subT = $subT + ($product_price[$i] * $product_amount[$i]) + $pricemo[$i];
                        $descuento[$i] = 0;
                        $desc_total = $desc_total + 0;
                    }
                    
                }else{
                    if($descuento[$i] != 'NA'){
                        $subT = $subT + ($product_price[$i] * $product_amount[$i]) + $pricemo[$i];
                        $desc_total = $desc_total + ($subT * $descuento[$i]);
                        $subT =  $subT - ($subT * $descuento[$i]);
                    }else{
                        $subT = $subT + ($product_price[$i] * $product_amount[$i]) + $pricemo[$i];
                        $descuento[$i] = 0;
                        $desc_total = $desc_total + 0;
                    }
                }

            }
            $total = $iva == 'true' ? $subT + ($subT * 0.19) : $subT;

            $input = "INSERT INTO cotizaciones(num_fact, total_prices, subtotal, amount, date, vendedor, cliente, state, descuento, iva) VALUES ('$reference','$total','$subT','$amountT','$date_bill','$seller','$customer', 1, '$desc_total', '$iva')";
            
            mysqli_query($db, $input);
            $bill = mysqli_insert_id($db);
            
            for ($i=0; $i < sizeof($product_id) ; $i++) { 

                $stock = 0;

                $inputProduct = 'SELECT id, amount,Barcode,name_product FROM producto WHERE id = '.$product_id[$i];
                $output = $db->query($inputProduct);

                foreach($output as $product)
                if($product_amount[$i] > $product['amount']){
                        $stock = 0;
                }else{
                    $stock = 1;

                }
                $manoObra = $check[$i] == 'true' ? 1 : 0;

                $priceTp = $product_price[$i] * $product_amount[$i];            
                $input = "INSERT INTO cotizaciones_has_product(id_cotizacion , id_product, price_u, amount, prices_total, date, stock, descuento, mano_obra, prices_mano_obra) VALUES ('$bill','$product_id[$i]','$product_price[$i]','$product_amount[$i]','$priceTp','$date_bill', '$stock', '$descuento[$i]', '$manoObra', '$pricemo[$i]')";
                echo $input;

                mysqli_query($db, $input);
            }
            include('../model/log.php');
            date_default_timezone_set('America/Bogota');
            $date =  date("Y-m-d H:i:s");
            $Log = new Log;

            $Log->store($_SESSION['user_id'], '2', 'Se creó una nueva cotización', $date, 6);

            header('Location: ../views/cotizaciones/cotizacion.php?referencia=' . $reference);
        }

        public function index(){
            require ('../../config/connection.php');

            $input = "SELECT num_fact, date, total_prices, CONCAT(ft_name, ' ', fi_lastname) as name_cliente, cotizaciones.id as id_bill FROM cotizaciones 
            INNER JOIN user
            ON user.id = cotizaciones.cliente
            WHERE state != 0";

            $output = $db->query($input);

            return $output;
        }
        
        public function generateBill($reference){
            require ('../../config/connection.php');

            $input = "SELECT cotizaciones.id as id_bill,cedula,num_fact,total_prices,subtotal,amount,date,cliente,state, CONCAT(ft_name, ' ',fi_lastname) AS nameLas, CONCAT(ft_name, ' ', sd_name, ' ', fi_lastname, ' ', sc_lastname) as fullname,phone,address,email, placa, modelo, descuento, iva FROM cotizaciones INNER JOIN user ON cliente = user.id WHERE num_fact = '$reference'";
            $output = $db->query($input);
            $data = $output;

            if(mysqli_num_rows($output) > 0){
                while($row = $output->fetch_assoc()){
                    $input = "SELECT id_cotizacion,id_product,price_u,cotizaciones_has_product.amount,num_repuesto, prices_total,prices_total,name_product, photo, stock, mano_obra, prices_mano_obra, descuento FROM cotizaciones_has_product INNER JOIN producto ON id_product = id WHERE id_cotizacion = $row[id_bill]";
                    $products = $db->query($input);
                    
                    $input = "SELECT cotizaciones.id,num_fact,cedula,total_prices,subtotal,amount,date,cliente,state, CONCAT(ft_name, ' ',fi_lastname) AS nameLas, CONCAT(ft_name, ' ', sd_name, ' ', fi_lastname, ' ', sc_lastname) as fullname,phone,address,email,photo,fi_lastname,sc_lastname,ft_name,sc_lastname  FROM cotizaciones INNER JOIN user ON vendedor = user.id WHERE num_fact = '$reference'";
                    $seller = $db->query($input);
                }

            }else{
                $products = null;
                $seller = null;
            }
            
            
            return [$data, $products, $seller];
        }

        public function delete($id){
            require ('../config/connection.php');
            $input = "UPDATE bill SET state='' WHERE id =$id";
            mysqli_query($db, $input);
            $_SESSION['bill_delete'];

            include('../model/log.php');
            date_default_timezone_set('America/Bogota');
            $date =  date("Y-m-d H:i:s");
            $Log = new Log;

            $Log->store($_SESSION['user_id'], '3', 'Se elimino una factura', $date, 3);

            header('Location: ../views/bill/');

        }
        public function numBills(){
            require ('../../config/connection.php');
            $input = "select num_fact from bill";
            $output = $db->query($input);
            return $output;
        }
    }
?> 