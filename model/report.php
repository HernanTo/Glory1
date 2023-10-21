<?php
    class report{
        public function ventasMes($mes, $año, $dia){
            require ('../../config/connection.php');

            $input = "select date, total_prices  from bill where (month(date) = '$mes' and year(date) = '$año') and state_page = 'true' and state = 1";
            $output = $db->query($input);

            $dates = [];
            $total = [];
            $stateDateCurrent = false;

            foreach($output as $row){
                if(sizeof($dates) == 0){
                    $dates[] = $row['date'];
                    $total[] = $row['total_prices'];
                }else{
                    $count = 0;
                    foreach($dates as $date){
                        if($date == $row['date']){
                            $total[$count] += $row['total_prices'];
                            break;
                        }else{
                            $dates[] = $row['date'];
                            $total[] = $row['total_prices'];
                            break;
                        }
                        $count++;
                    }
                }
            }
            foreach($dates as $date){
                if($date == "$año-$mes-$dia"){
                    $stateDateCurrent = true;
                }
            }
            if(!$stateDateCurrent){
                $dates[] = "$año-$mes-$dia";
                $total[] = 0;
            }

            return [$dates, $total];
        }

        public function fact($mes, $año){
            require ('../../config/connection.php');

            $input = "select count(num_fact) as pagada from bill where (month(date) = '$mes' and year(date) = '$año') and state_page = 'true' and state = 1";
            $pagas = $db->query($input);
            $factState = [];
            foreach($pagas as $row){
                $factState[] = $row['pagada'];
            }

            $input = "select count(num_fact) as Nopagada from bill where (month(date) = '$mes' and year(date) = '$año') and state_page = 'false' and state = 1";
            $noPagas = $db->query($input);
            foreach($noPagas as $row){
                $factState[] = $row['Nopagada'];
            }
            
            // $input = "select count(num_fact) as total from bill where (month(date) = '$mes' and year(date) = '$año')";
            // $total = $db->query($input);
            // $noPagas = $db->query($input);
            // foreach($total as $row){
            //     $factState[] = $row['total'];
            // }

            return $factState;
        }

        public function ganancias($mes, $año){
            require ('../../config/connection.php');

            $input = "select bhp.id_product, product_cost, prices, id_category, category, bhp.amount, (bhp.price_u * bhp.amount) as total_precios, (p.product_cost * bhp.amount) as costo_total from bill_has_product bhp
            inner join producto p on bhp.id_product  = p.id
            inner join bill b on id_bill = b.id 
            inner join product_has_category phc on phc.id_product = bhp.id_product
            inner join category c on id_category = c.id
            where (month(bhp.date) = '$mes' and year(bhp.date) = '$año') and state_page = 'true' and b.state = 1";
            
            $producsMonth = $db->query($input);
            $precioTotal = 0;
            $costoTotal = 0;
            $categoryMonth = [];

            foreach ($producsMonth as $product) {
                $precioTotal += $product['total_precios'];
                $costoTotal += $product['costo_total'];
                
                $categoryFound = false; 
                
                foreach ($categoryMonth as &$category) {
                    if ($category['id'] == $product['id_category']) {
                        // La categoría ya existe, actualiza las ganancias
                        $category['precio'] += $product['prices'];
                        $category['costo'] += $product['product_cost'];
                        $category['ganancia'] += ($product['prices'] - $product['product_cost']);
                        $categoryFound = true;
                        break; // Sal del bucle interno
                    }
                }
                
                if (!$categoryFound) {
                    $categoryMonth[] = [
                        "id" => $product['id_category'],
                        "nameCategory" => $product['category'],
                        "precio" => $product['prices'],
                        "costo" => $product['product_cost'],
                        "ganancia" => ($product['prices'] - $product['product_cost']),
                    ];

                }
            }

            
            $ganancias = $precioTotal - $costoTotal;
            usort($categoryMonth, function($a, $b) {
                return $b['ganancia'] - $a['ganancia'];
            });

            $ganaciasCategoriasF = array_slice($categoryMonth, 0, 2);
            $ganaciasCategoriasF[] = [
                "id" => '-1',
                "nameCategory" => 'Otro',
                "precio" => 0,
                "costo" => 0,
                "ganancia" => 0
            ];

            for ($i = 2; $i < (sizeof($categoryMonth)) ; $i++) { 
                $ganaciasCategoriasF[2]['precio'] += $categoryMonth[$i]['precio'];
                $ganaciasCategoriasF[2]['costo'] += $categoryMonth[$i]['costo'];
                $ganaciasCategoriasF[2]['ganancia'] += ($categoryMonth[$i]['precio'] - $categoryMonth[$i]['costo']);
            }

            return [$ganancias, $ganaciasCategoriasF];
        }

        public function lowStock(){
            require ('../../config/connection.php');
            $input = "SELECT *FROM producto WHERE state = 1 ORDER BY amount ASC LIMIT 5;";
            $output = $db->query($input);

            return $output;
        }

        public function billNoP(){
            require ('../../config/connection.php');
            $input = "select num_fact, total_prices, date, CONCAT(ft_name, ' ',fi_lastname) AS nameLas from bill
            inner join `user` u on cliente = u.id
            where state_page = 'false' and state = 1
            order by `date` desc  limit 3";
            $output = $db->query($input);
            return $output;
        }
    }
?>