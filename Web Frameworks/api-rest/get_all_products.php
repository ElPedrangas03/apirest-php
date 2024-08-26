<?php
    require_once('../includes/Product.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        Product::get_all_products();
    }
?>
