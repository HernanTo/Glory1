<?php
class Service{
    public function store($date, $referencia, $customer, $seller, $desc, $price, $iva, $estado_page){
        require ('../config/connection.php');
        $price = str_replace('$', '', $price);
        $price = str_replace(',', '', $price);

        $input = "INSERT  INTO  service (date, detail, referencia, price, iva, customer, state, state_page, service) VALUES ('$date','$desc', '$referencia', '$price', '$iva', '$customer', 1, '$estado_page', '$seller')";
        mysqli_query($db, $input);

        include('../model/log.php');
        date_default_timezone_set('America/Bogota');
        $date =  date("Y-m-d H:i:s");
        $Log = new Log;

        $Log->store($_SESSION['user_id'], '2', 'Se ha creado un servicio', $date, 4);

    }

    public function index($id_bill){
        require ('../../config/connection.php');
        $input = "select detail, price from service
        inner join service_has_bill shb 
        on shb.id_service  = service.id
        where shb.id_bill = '$id_bill'";
        
        $output = $db->query($input);

        return $output;
    }
    public function numRef(){
        require ('../../config/connection.php');
        $input = "SELECT referencia FROM service";
        $output = $db->query($input);
        return $output;
    }
}
?>