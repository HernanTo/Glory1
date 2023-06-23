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
            
            $Bill->store(
                $date_bill,
                $reference,
                $product_amount,
                $product_id,
                $customer,
                $seller,
                $product_price,
            );
        }

        public function delete(){
            echo 'a';
        }
    }

    $billControlller = new billControlller;

    if(isset($_GET['action'])){
        $fuct = $_GET['action'];
        $billControlller-> $fuct();
    }
?>