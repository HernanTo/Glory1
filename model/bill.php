<?php
    class Bill{
        public function store($date_bill, $reference, $product_amount, $product_id, $customer, $seller, $product_price){
            require ('../config/connection.php');

            $amountT = 0;
            $subT = 0;
            $total = 0;
            for ($i=0; $i < sizeof($product_id) ; $i++) { 
                $amountT = $amountT + $product_amount[$i];
                $subT = $subT + ($product_price[$i] * $product_amount[$i]);
            }
            $total = $subT + ($subT * 0.19);


            $input = "INSERT INTO bill(num_fact, total_prices, subtotal, amount, date, vendedor, cliente, state) VALUES ('$reference','$total','$subT','$amountT','$date_bill','$seller','$customer', 1)";
            
            mysqli_query($db, $input);
            $bill = mysqli_insert_id($db);
            
            for ($i=0; $i < sizeof($product_id) ; $i++) { 
                $priceTp = $product_price[$i] * $product_amount[$i];
                $input = "INSERT INTO bill_has_product(id_bill, id_product, price_u, amount, prices_total, date) VALUES ('$bill','$product_id[$i]','$product_price[$i]','$product_amount[$i]','$priceTp','$date_bill')";

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

            $input = "SELECT * FROM bill WHERE num_fact = $reference";
            $output = $db->query($input);
            $data = $output;
            
            while($row = $output->fetch_assoc()){
                $input = "SELECT id_bill,id_product,price_u,bill_has_product.amount,prices_total,prices_total,name_product  FROM bill_has_product 
                INNER JOIN producto
                ON id_product = id
                WHERE id_bill = $row[id]";
                $products = $db->query($input);
            }
            include('../model/log.php');
            date_default_timezone_set('America/Bogota');
            $date =  date("Y-m-d H:i:s");
            $Log = new Log;

            $Log->store($_SESSION['user_id'], '2', 'Se genero una factura', $date, 3);
            
            return [$data, $products];
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