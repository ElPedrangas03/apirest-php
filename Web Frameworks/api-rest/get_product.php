<?php
    require_once('../includes/Product.class.php');

    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['productID'])) {
        $productID = $_GET['productID'];
        $product = Product::get_product_by_id($productID);

        if ($product) {
            echo json_encode($product);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Producto no encontrado']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'ID de producto no especificado']);
    }
?>
