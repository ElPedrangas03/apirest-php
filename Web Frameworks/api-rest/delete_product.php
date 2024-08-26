<?php
require_once('../includes/Product.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['_method']) && $_POST['_method'] == 'delete') {
    if (isset($_POST['productID'])) {
        $productID = $_POST['productID'];
        Product::delete_product_by_id($productID);
        header('Location: ../FrontEnd/index.php');
        exit();
    } else {
        error_log("No jalo");
    }
} else {
    error_log("No jalo mayor");
}
?>