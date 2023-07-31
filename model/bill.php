<?php
    class Bill{
        public function store($date_bill, $reference, $product_amount, $product_id, $customer, $seller, $product_price, $check, $pricemo){
            require ('../config/connection.php');

            $amountT = 0;
            $subT = 0;
            $total = 0;
            for ($i=0; $i < sizeof($product_id) ; $i++) {
                $amountT = $amountT + $product_amount[$i];

                if($check[$i] == 'true'){
                    $subT = $subT + ($product_price[$i] * $product_amount[$i]) + $pricemo[$i];

                }else{
                    $subT = $subT + ($product_price[$i] * $product_amount[$i]);
                }

            }
            $total = $subT + ($subT * 0.19);
            echo $total;


            $input = "INSERT INTO bill(num_fact, total_prices, subtotal, amount, date, vendedor, cliente, state) VALUES ('$reference','$total','$subT','$amountT','$date_bill','$seller','$customer', 1)";
            
            mysqli_query($db, $input);
            $bill = mysqli_insert_id($db);
            
            for ($i=0; $i < sizeof($product_id) ; $i++) { 
                $priceTp = $product_price[$i] * $product_amount[$i];
                $manoObra = $check[$i] == 'true' ? 1 : 0;
                if($manoObra == 1){
                    $priceTp = $priceTp + $pricemo[$i];
                }
                
                $input = "INSERT INTO bill_has_product(id_bill, id_product, price_u, amount, prices_total, date, prices_mano_obra, mano_obra) VALUES ('$bill','$product_id[$i]','$product_price[$i]','$product_amount[$i]','$priceTp','$date_bill', '$pricemo[$i]', '$manoObra')";

                mysqli_query($db, $input);
            }
            include('../model/log.php');
            date_default_timezone_set('America/Bogota');
            $date =  date("Y-m-d H:i:s");
            $Log = new Log;

            $Log->store($_SESSION['user_id'], '2', 'Se creó una nueva factura', $date, 3);

            header('Location: ../views/bill/bill.php?referencia=' . $reference);
        }

        public function index(){
            require ('../../config/connection.php');

            $input = "SELECT num_fact, date, total_prices, CONCAT(ft_name, ' ', fi_lastname) as name_cliente, bill.id as id_bill FROM bill 
            INNER JOIN user
            ON user.id = bill.cliente
            WHERE state != 0";

            $output = $db->query($input);
            

            return $output;
        }
        
        public function generateBill($reference){
            require ('../../config/connection.php');

            $input = "SELECT bill.id as id_bill,cedula,num_fact,total_prices,subtotal,amount,date,cliente,state, CONCAT(ft_name, ' ',fi_lastname) AS nameLas, CONCAT(ft_name, ' ', sd_name, ' ', fi_lastname, ' ', sc_lastname) as fullname,phone,address,email, placa, modelo FROM bill INNER JOIN user ON cliente = user.id WHERE num_fact = '$reference'";
            $output = $db->query($input);
            $data = $output;

            if(mysqli_num_rows($output) > 0){
                while($row = $output->fetch_assoc()){
                    $input = "SELECT id_bill,id_product,price_u,bill_has_product.amount,num_repuesto, prices_total,prices_total,name_product, mano_obra, prices_mano_obra, photo FROM bill_has_product INNER JOIN producto ON id_product = id WHERE id_bill = $row[id_bill]";
                    $products = $db->query($input);
                    
                    $input = "SELECT bill.id,num_fact,cedula,total_prices,subtotal,amount,date,cliente,state, CONCAT(ft_name, ' ',fi_lastname) AS nameLas, CONCAT(ft_name, ' ', sd_name, ' ', fi_lastname, ' ', sc_lastname) as fullname,phone,address,email,photo,fi_lastname,sc_lastname,ft_name,sc_lastname  FROM bill INNER JOIN user ON vendedor = user.id WHERE num_fact = '$reference'";
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
    }
?> 