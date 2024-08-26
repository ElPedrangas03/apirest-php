<?php
require_once('../includes/Product.class.php');

// Obtener el ID del producto desde la URL
$productID = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Obtener los datos del producto
$product = Product::get_product_by_id($productID);

// Verificar si el producto existe
if (!$product) {
    echo "Producto no encontrado";
}
?>

<!DOCTYPE html>
<html lang="es" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/estilo.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <div class="container">
            <h3 class="my-3">Editar Producto</h3>
            <form id="edit-form" class="row g-3" method="post" action="../api-rest/update_product.php" autocomplete="off">
                <input type="hidden" id="productID" name="productID" value="<?php echo htmlspecialchars($product['ProductID']); ?>">
                <div class="col-md-4">
                    <label for="nombre" class="form-label">Nombre del producto</label>
                    <input type="text" class="form-control" id="nombre" name="productName" value="<?php echo htmlspecialchars($product['ProductName']); ?>" required autofocus>
                </div>
                <div class="col-md-8">
                    <label for="cantidad" class="form-label">Cantidad por unidad</label>
                    <input type="text" class="form-control" id="cantidad" name="quantityPerUnit" value="<?php echo htmlspecialchars($product['QuantityPerUnit']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="precio" name="unitPrice" value="<?php echo htmlspecialchars($product['UnitPrice']); ?>" required step=".1" min="0">
                </div>
                <div class="col-md-6">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="unitsInStock" value="<?php echo htmlspecialchars($product['UnitsInStock']); ?>" required min="0">
                </div>
                <div class="col-md-6">
                    <label for="orders" class="form-label">Unidades en la orden</label>
                    <input type="number" class="form-control" id="orders" name="unitsOnOrder" value="<?php echo htmlspecialchars($product['UnitsOnOrder']); ?>" min="0">
                </div>
                <div class="col-md-6">
                    <label for="CantidadPedidos" class="form-label">Cantidad de pedidos</label>
                    <input type="number" class="form-control" id="CantidadPedidos" name="reorderLevel" value="<?php echo htmlspecialchars($product['ReorderLevel']); ?>" min="0">
                </div>
                <div class="col-md-4">
                    <label for="Descontinuado" class="form-label">Descontinuado</label>
                    <input type="number" class="form-control" id="Descontinuado" name="discontinued" value="<?php echo htmlspecialchars($product['Discontinued']); ?>" min="0">
                </div>
                <div class="col-12">
                    <a href="index.php" class="btn btn-secondary">Regresar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-body-tertiary">
        <div class="container">
            <span class="text-body-secondary">2024 | Códigos de Programación</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        document.getElementById('edit-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('../api-rest/update_product.php', {
                method: 'PUT',
                body: new URLSearchParams(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '../FrontEnd/index.php';
                } else {
                    alert('Error al actualizar el producto');
                }
            });
        });

    </script>
</body>

</html>
