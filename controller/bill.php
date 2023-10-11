<?php
    session_start();
    require ('../model/bill.php');

    class billControlller{
        public function index(){
            $Bill = new Bill;
            $Bill->index();
        }
        
        public function store(){

            $Bill = new Bill;
            $type_Bill = $_POST['type_bill'];
            if($type_Bill == 0){
                $product_amount = 0;
                $product_id = 0;
                $product_price = 0;
                $price_mano_obra = 0;
                $check_mano_obra = 0;
                $descuento = 0;

            }else{
                $product_amount = $_POST['product_amount'];
                $product_id = $_POST['product_id'];
                $product_price = $_POST['product_price'];
                $check_mano_obra = $_POST['check_mano_obra'];
                $price_mano_obra = $_POST['price_mano_obra'];
                $descuento = $_POST['descuento'];

            }
            $date_bill = $_POST['date_bill'];
            $customer = $_POST['customer'];
            $seller = $_POST['seller'];
            $iva = $_POST['iva_check'];
            $estado_pago = $_POST['estado_pago_check'];
            $service = isset( $_POST['desc']) ?  $_POST['desc'] : [];
            $Priceservice = isset($_POST['priceServ']) ? $_POST['priceServ'] : [];

            $Bill->store(
                $date_bill,
                $product_amount,
                $product_id,
                $customer,
                $seller,
                $product_price,
                $check_mano_obra,
                $price_mano_obra, 
                $descuento,
                $iva,
                $estado_pago, 
                $service,
                $Priceservice, 
                $type_Bill
            );
        }

        public function delete(){
            $id = $_POST['id_bill_delete'];
            $Bill = new Bill;
            $Bill->delete($id);
        }
    }

    $billControlller = new billControlller;

    if(isset($_GET['action'])){
        $fuct = $_GET['action'];
        $billControlller-> $fuct();
    }
?>