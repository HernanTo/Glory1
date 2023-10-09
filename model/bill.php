<?php
    class Bill{
        public function store($date_bill, $reference, $product_amount, $product_id, $customer, $seller, $product_price, $check, $pricemo, $descuento, $iva, $estado_pago, 
        $service, $priceService, $typeBill){
            // type bill = si la factura cuenta con productos o no
            // 1 = si
            // 0 = no
            
            require ('../config/connection.php');

            $amountT = 0;
            $subT = 0;
            $total = 0;
            $desc_total = 0;
            if($typeBill == 1){
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
            }
            
            if(sizeof($service) > 0){
                for ($i=0; $i < sizeof($service) ; $i++) { 
                    $unforPriceServ = str_replace('$', '', $priceService[$i]);
                    $unforPriceServ = str_replace(',', '', $unforPriceServ);
                    $amountT = $amountT + 1;
                    $subT = $subT + $unforPriceServ;
                    
                }
            }
            
            $total = $iva == 'true' ? $subT + ($subT * 0.19) : $subT;

            $estado = true;
            $err = [];

            // $product_amount[0] = 11;
            // $product_amount[1] = 223;

            if($typeBill == 1){
                for ($i=0; $i < sizeof($product_id) ; $i++) { 
                    $inputProduct = 'SELECT id, amount,Barcode,name_product FROM producto WHERE id = '.$product_id[$i];
                    $output = $db->query($inputProduct);
    
                    foreach($output as $product)
                    if($product_amount[$i] > $product['amount']){
                            $estado = false;
                            $errorTemp = [
                                'barcode' => $product['Barcode'], 
                                'nameprod' => $product['name_product'], 
                                'stockactual' => $product['amount'], 
                                'stockseleccionado' => $product_amount[$i], 
                            ];
    
                            $err[] = $errorTemp;
                        }
                }
    
                if($estado){
                    $input = "INSERT INTO bill(num_fact, total_prices, subtotal, amount, date, vendedor, cliente, state, state_page, iva, descuento) VALUES ('$reference','$total','$subT','$amountT','$date_bill','$seller','$customer', 1, '$estado_pago', '$iva', '$desc_total')";
                
                    mysqli_query($db, $input);
                    $bill = mysqli_insert_id($db);

                    if(sizeof($service) > 0){
                        for ($i=0; $i < sizeof($service) ; $i++) { 
                            $unforPriceServ = str_replace('$', '', $priceService[$i]);
                            $unforPriceServ = str_replace(',', '', $unforPriceServ);
                            $input = "INSERT INTO service(date, detail, price, service, state) VALUES ('$date_bill','$service[$i]','$unforPriceServ','$seller','1')";
                            mysqli_query($db, $input);

                            $serviceId = mysqli_insert_id($db);
                            $input = "INSERT INTO service_has_bill(id_bill, id_service) VALUES ('$bill','$serviceId')";
                            mysqli_query($db, $input);

                        }
                    }
                                
                    for ($i=0; $i < sizeof($product_id) ; $i++) { 
        
                        $priceTp = $product_price[$i] * $product_amount[$i];
                        $manoObra = $check[$i] == 'true' ? 1 : 0;
                        if($manoObra == 1){
                            $priceTp = $priceTp + $pricemo[$i];
                        }
                        
                        $input = "INSERT INTO bill_has_product(id_bill, id_product, price_u, amount, prices_total, date, prices_mano_obra, mano_obra, descuento) VALUES ('$bill','$product_id[$i]','$product_price[$i]','$product_amount[$i]','$priceTp','$date_bill', '$pricemo[$i]', '$manoObra', '$descuento[$i]')";
        
                        mysqli_query($db, $input);
    
                    $inputProduct = 'SELECT id, amount,Barcode,name_product FROM producto WHERE id = '.$product_id[$i];
                    $output = $db->query($inputProduct);
    
                    foreach($output as $prod){
                        $stockRest = $prod['amount'] - $product_amount[$i];
                        $input = "UPDATE producto SET amount = $stockRest WHERE id = " . $prod['id'];
                        mysqli_query($db, $input);
                    }
    
                    }
                    include('../model/log.php');
                    date_default_timezone_set('America/Bogota');
                    $date =  date("Y-m-d H:i:s");
                    $Log = new Log;
        
                    $Log->store($_SESSION['user_id'], '2', 'Se creó una nueva factura', $date, 3);
        
                    header('Location: ../views/bill/bill.php?referencia=' . $reference);
                }else{
                    $_SESSION['err_bill'] = $err;
    
                    include('../model/log.php');
                    date_default_timezone_set('America/Bogota');
                    $date =  date("Y-m-d H:i:s");
                    $Log = new Log;
        
                    $Log->store($_SESSION['user_id'], '4', 'No se pudo crear la factura debido a la falta de stock', $date, 3);
        
                    header('Location: ../views/bill/add-bill.php');
                }
            }else{
                if(sizeof($service) > 0){
                    $input = "INSERT INTO bill(num_fact, total_prices, subtotal, amount, date, vendedor, cliente, state, state_page, iva, descuento) VALUES ('$reference','$total','$subT','$amountT','$date_bill','$seller','$customer', 1, '$estado_pago', '$iva', '$desc_total')";
                
                    mysqli_query($db, $input);
                    $bill = mysqli_insert_id($db);

                    for ($i=0; $i < sizeof($service) ; $i++) { 
                        $unforPriceServ = str_replace('$', '', $priceService[$i]);
                        $unforPriceServ = str_replace(',', '', $unforPriceServ);
                        $input = "INSERT INTO service(date, detail, price, service, state) VALUES ('$date_bill','$service[$i]','$unforPriceServ','$seller','1')";
                        mysqli_query($db, $input);

                        $serviceId = mysqli_insert_id($db);
                        $input = "INSERT INTO service_has_bill(id_bill, id_service) VALUES ('$bill','$serviceId')";
                        mysqli_query($db, $input);
                    }

                    include('../model/log.php');
                    date_default_timezone_set('America/Bogota');
                    $date =  date("Y-m-d H:i:s");
                    $Log = new Log;
        
                    $Log->store($_SESSION['user_id'], '2', 'Se creó una nueva factura', $date, 3);
                    header('Location: ../views/bill/bill.php?referencia=' . $reference);
                }
            }
            
        }

        public function index(){
            require ('../../config/connection.php');

            $input = "SELECT num_fact, date, total_prices, CONCAT(ft_name, ' ', fi_lastname) as name_cliente, bill.id as id_bill, iva, state_page FROM bill 
            INNER JOIN user
            ON user.id = bill.cliente
            WHERE state != 0";

            $output = $db->query($input);
            

            return $output;
        }
        
        public function generateBill($reference){
            require ('../../config/connection.php');

            $input = "SELECT bill.id as id_bill,cedula,num_fact,total_prices,subtotal,amount,date,cliente,state, CONCAT(ft_name, ' ',fi_lastname) AS nameLas, CONCAT(ft_name, ' ', sd_name, ' ', fi_lastname, ' ', sc_lastname) as fullname,phone,address,email, placa, modelo, iva, descuento, vendedor, state_page FROM bill INNER JOIN user ON cliente = user.id WHERE num_fact = '$reference'";
            $output = $db->query($input);
            $data = $output;

            if(mysqli_num_rows($output) > 0){
                while($row = $output->fetch_assoc()){
                    $input = "SELECT id_bill,id_product,price_u,bill_has_product.amount,num_repuesto, prices_total,prices_total,name_product, mano_obra, prices_mano_obra, photo,descuento FROM bill_has_product INNER JOIN producto ON id_product = id WHERE id_bill = $row[id_bill]";
                    $products = $db->query($input);
                    
                    $input = "SELECT CONCAT(ft_name, ' ',fi_lastname) AS nameLas, CONCAT(ft_name, ' ', sd_name, ' ', fi_lastname, ' ', sc_lastname) as fullname, cedula, photo,fi_lastname,sc_lastname,ft_name,sc_lastname FROM bill INNER JOIN user ON vendedor = user.id WHERE num_fact = '$reference'";
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