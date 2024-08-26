<?php
require_once('../includes/Product.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' 
    && isset($_POST['nombre']) && isset($_POST['cantidad']) && isset($_POST['precio']) 
    && isset($_POST['stock']) && isset($_POST['orders']) && isset($_POST['CantidadPedidos']) && isset($_POST['Descontinuado'])) {
        
    Product::create_product($_POST['nombre'], $_POST['cantidad'], $_POST['precio'], $_POST['stock'], 
                            $_POST['orders'], $_POST['CantidadPedidos'], $_POST['Descontinuado']);
}
