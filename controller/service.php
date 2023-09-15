<?php
    session_start();
    require ('../model/service.php');

    class serviceControlller{
        public function store(){
            $Service = new Service;

            $date = $_POST['date_bill'];
            $referencia = $_POST['reference'];
            $customer = $_POST['customer'];
            $seller = $_POST['seller'];
            $desc = $_POST['desc'];
            $price = $_POST['price'];
            $iva = $_POST['iva_check'];
            $estado_page = $_POST['estado_pago_check'];

            $Service->store($date, $referencia, $customer, $seller, $desc, $price, $iva, $estado_page);

            header('Location: ../views/service/');
        }
    }

    $serviceControlller = new serviceControlller;

    if(isset($_GET['action'])){
        $fuct = $_GET['action'];
        $serviceControlller-> $fuct();
    }
?>