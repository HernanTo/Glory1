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
            $date_bill = $_POST['date_bill'];
            $reference = $_POST['reference'];
            $product_amount = $_POST['product_amount'];
            $product_id = $_POST['product_id'];
            $customer = $_POST['customer'];
            $seller = $_POST['seller'];
            $product_price = $_POST['product_price'];
            $check_mano_obra = $_POST['check_mano_obra'];
            $price_mano_obra = $_POST['price_mano_obra'];

            $Bill->store(
                $date_bill,
                $reference,
                $product_amount,
                $product_id,
                $customer,
                $seller,
                $product_price,
                $check_mano_obra,
                $price_mano_obra
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