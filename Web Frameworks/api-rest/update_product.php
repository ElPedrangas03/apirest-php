<?php
require_once('../includes/Product.class.php');

// Solo procesar si el método de solicitud es PUT
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $put_vars);

    // Obtener los datos del PUT
    $productID = $put_vars['productID'] ?? '';
    $productName = $put_vars['productName'] ?? '';
    $quantityPerUnit = $put_vars['quantityPerUnit'] ?? '';
    $unitPrice = $put_vars['unitPrice'] ?? '';
    $unitsInStock = $put_vars['unitsInStock'] ?? '';
    $unitsOnOrder = $put_vars['unitsOnOrder'] ?? '';
    $reorderLevel = $put_vars['reorderLevel'] ?? '';
    $discontinued = $put_vars['discontinued'] ?? '';

    // Llamar al método de actualización
    Product::update_product($productID, $productName, $quantityPerUnit, $unitPrice, $unitsInStock, $unitsOnOrder, $reorderLevel, $discontinued);
}
?>
