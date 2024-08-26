<?php
    require_once('Database.class.php');

    class Product{
        public static function create_product($productName, $quantityPerUnit, $unitPrice, $unitsInStock, $unitsOnOrder, $reorderLevel, $discontinued){
            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('INSERT INTO products(ProductName, QuantityPerUnit, UnitPrice, UnitsInStock, UnitsOnOrder, ReorderLevel, Discontinued)
                VALUES(:productName, :quantityPerUnit, :unitPrice, :unitsInStock, :unitsOnOrder, :reorderLevel, :discontinued)');
            $stmt->bindParam(':productName', $productName);
            $stmt->bindParam(':quantityPerUnit', $quantityPerUnit);
            $stmt->bindParam(':unitPrice', $unitPrice);
            $stmt->bindParam(':unitsInStock', $unitsInStock);
            $stmt->bindParam(':unitsOnOrder', $unitsOnOrder);
            $stmt->bindParam(':reorderLevel', $reorderLevel);
            $stmt->bindParam(':discontinued', $discontinued);

            if($stmt->execute()){
                header('HTTP/1.1 201 Producto creado correctamente');
            } else {
                header('HTTP/1.1 404 Producto no se ha creado correctamente');
            }
        }

        public static function delete_product_by_id($productID){
            $database = new Database();
            $conn = $database->getConnection();

            try {
                $stmt = $conn->prepare('DELETE FROM products WHERE ProductID=:productID');
                $stmt->bindParam(':productID', $productID);
                if($stmt->execute()){
                    header('HTTP/1.1 200 Producto borrado correctamente');
                } else {
                    header('HTTP/1.1 404 Producto no se ha podido borrar correctamente');
                }
            } catch (PDOException $e) {
                error_log("Error deleting product: " . $e->getMessage());
                header('HTTP/1.1 500 Internal Server Error');
            }
        }

        public static function get_product_by_id($productID) {
            $database = new Database();
            $conn = $database->getConnection();
        
            $stmt = $conn->prepare('SELECT * FROM products WHERE ProductID = :productID');
            $stmt->bindParam(':productID', $productID);
            $stmt->execute();
        
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($result) {
                return $result; // Retornar los datos del producto si se encuentra
            } else {
                return null; // Retornar null si no se encuentra el producto
            }
        }
        
        

        public static function get_all_products(){
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare('SELECT * FROM products');
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return [];
            }
        }

        public static function update_product($productID, $productName, $quantityPerUnit, $unitPrice, $unitsInStock, $unitsOnOrder, $reorderLevel, $discontinued) {
            $database = new Database();
            $conn = $database->getConnection();
        
            $stmt = $conn->prepare('UPDATE products SET ProductName=:productName, QuantityPerUnit=:quantityPerUnit, UnitPrice=:unitPrice, UnitsInStock=:unitsInStock, 
                UnitsOnOrder=:unitsOnOrder, ReorderLevel=:reorderLevel, Discontinued=:discontinued WHERE ProductID=:productID');
            $stmt->bindParam(':productName', $productName);
            $stmt->bindParam(':quantityPerUnit', $quantityPerUnit);
            $stmt->bindParam(':unitPrice', $unitPrice);
            $stmt->bindParam(':unitsInStock', $unitsInStock);
            $stmt->bindParam(':unitsOnOrder', $unitsOnOrder);
            $stmt->bindParam(':reorderLevel', $reorderLevel);
            $stmt->bindParam(':discontinued', $discontinued);
            $stmt->bindParam(':productID', $productID);
        
            try {
                if ($stmt->execute()) {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true, 'message' => 'Producto actualizado correctamente']);
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'message' => 'Producto no se ha podido actualizar correctamente']);
                }
            } catch (Exception $e) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
        
    }

?>
