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


            $input = "INSERT INTO bill(num_fact, total_prices, subtotal, amount, date, vendedor, cliente) VALUES ('$reference','$total','$subT','$amountT','$date_bill','$seller','$customer')";
            
            mysqli_query($db, $input);
            $bill = mysqli_insert_id($db);
            
            for ($i=0; $i < sizeof($product_id) ; $i++) { 
                $priceTp = $product_price[$i] * $product_amount[$i];
                $input = "INSERT INTO bill_has_product(id_bill, id_product, price_u, amount, prices_total, date) VALUES ('$bill','$product_id[$i]','$product_price[$i]','$product_amount[$i]','$priceTp','$date_bill')";

                mysqli_query($db, $input);
            }

            header('Location: ../views/bill/');
        }

        public function index(){
            require ('../../config/connection.php');

            $input = "SELECT num_fact, date, total_prices, CONCAT(ft_name, ' ', fi_lastname) as name_cliente, bill.id as id_bill FROM `bill` 
            INNER JOIN user
            ON user.id = bill.cliente";

            $output = $db->query($input);
            

            return $output;
        }
    }
?>
