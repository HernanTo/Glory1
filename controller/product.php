<?php
    session_start();
    require ('../model/product.php');

    class productControlller{
        public function index(){
            $Product = new Product;
            $Product->index();
        }
        public function store(){
            $stock = $_POST['stock'];
            $category = $_POST['category'];
            $price_product = $_POST['price_product'];
            $photo_product = $_FILES['photoProduct'];
            $barcode = $_POST['barcode'];
            $name_product = $_POST['name_product'];
            $Product = new Product;
            $Product->store($name_product, $barcode, $photo_product, $stock, $category, $price_product);
        }

        public function delete(){
            $id = $_POST['product_user_delete'];
            $Product = new Product;
            $Product->delete($id);
        }
    }

    $productControlller = new productControlller;

    if(isset($_GET['action'])){
        $fuct = $_GET['action'];
        $productControlller-> $fuct();
    }
?>