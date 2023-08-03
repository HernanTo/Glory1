<?php
    session_start();
    require ('../model/cotizaciones.php');

    class cotizacionesControlller{
        public function index(){
            $Cotizaciones = new Cotizaciones;
            $Cotizaciones->index();
        }
        
        public function store(){

            $Cotizaciones = new Cotizaciones;
            $date_bill = $_POST['date_bill'];
            $reference = $_POST['reference'];
            $product_amount = $_POST['product_amount'];
            $product_id = $_POST['product_id'];
            $customer = $_POST['customer'];
            $seller = $_POST['seller'];
            $product_price = $_POST['product_price'];

            $Cotizaciones->store(
                $date_bill,
                $reference,
                $product_amount,
                $product_id,
                $customer,
                $seller,
                $product_price
            );
        }

        public function delete(){
            $id = $_POST['id_bill_delete'];
            $Cotizaciones = new Cotizaciones;
            $Cotizaciones->delete($id);
        }
    }

    $cotizacionesControlller = new cotizacionesControlller;

    if(isset($_GET['action'])){
        $fuct = $_GET['action'];
        $cotizacionesControlller-> $fuct();
    }
?>