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
            $num_repuesto = $_POST['num_repuesto'];
            $min_stock = $_POST['min_stock'];
            $product_cost = $_POST['product_cost'];
            $Product = new Product;
            $Product->store($name_product, $barcode, $photo_product, $stock, $category, $price_product, $num_repuesto, $min_stock, $product_cost);
        }

        public function delete(){
            $id = $_POST['product_user_delete'];
            $Product = new Product;
            $Product->delete($id);
        }

        public function edit(){
            $stock = $_POST['stock'];
            $category = $_POST['category'];
            $price_product = $_POST['price_product'];
            $photo_product = $_FILES['photo_product'];
            $barcode = $_POST['barcode'];
            $name_product = $_POST['name_product'];
            $num_repuesto = $_POST['num_repuesto'];
            $min_stock = $_POST['min_stock'];
            $img_action = $_POST['changepicturestate'];
            $id = $_POST['id'];
            $product_cost = $_POST['product_cost'];
            $Product = new Product;
            $Product->update($name_product, $barcode, $photo_product, $stock, $category, $price_product, $num_repuesto, $min_stock, $img_action, $id, $product_cost);

            header('Location: ../views/product/');
        }
    }

    $productControlller = new productControlller;

    if(isset($_GET['action'])){
        $fuct = $_GET['action'];
        $productControlller-> $fuct();
    }
?>