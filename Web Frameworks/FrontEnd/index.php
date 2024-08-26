<?php
    require_once('../includes/Product.class.php');
    $productos = Product::get_all_products();
?>

<!DOCTYPE html>
<html lang="es" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="css/estilo.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

    <main class="flex-shrink-0">
        <div class="container">
            <h3 class="my-3" id="titulo">Productos</h3>

            <a href="agregar.php" class="btn btn-success">Agregar</a>

            <table class="table table-hover table-bordered my-3" aria-describedby="titulo">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del producto</th>
                        <th scope="col">C/U</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Unidades en la orden</th>
                        <th scope="col">Cantidad de pedidos</th>
                        <th scope="col">Descontinuado</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['ProductID']) ?></td>
                        <td><?= htmlspecialchars($producto['ProductName']) ?></td>
                        <td><?= htmlspecialchars($producto['QuantityPerUnit']) ?></td>
                        <td><?= htmlspecialchars($producto['UnitPrice']) ?></td>
                        <td><?= htmlspecialchars($producto['UnitsInStock']) ?></td>
                        <td><?= htmlspecialchars($producto['UnitsOnOrder']) ?></td>
                        <td><?= htmlspecialchars($producto['ReorderLevel']) ?></td>
                        <td><?= htmlspecialchars($producto['Discontinued']) ? 'Sí' : 'No' ?></td>
                        <td>
                            <a href="editar.php?id=<?= htmlspecialchars($producto['ProductID']) ?>" class="btn btn-warning btn-sm me-2">Editar</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#eliminaModal" data-bs-id="<?= htmlspecialchars($producto['ProductID']) ?>">Eliminar</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-body-tertiary">
        <div class="container">
            <span class="text-body-secondary"> 2024 | Códigos de Programación</span>
        </div>
    </footer>

    <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="eliminaModalLabel">Aviso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Desea eliminar este registro?</p>
            </div>
            <div class="modal-footer">
                <form id="form-elimina" action="../api-rest/delete_product.php" method="post">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="productID" id="productID-eliminar" value="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script>
    const eliminaModal = document.getElementById('eliminaModal');
    eliminaModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const productID = button.getAttribute('data-bs-id');
        console.log(productID);
        const inputProductID = document.getElementById('productID-eliminar');
        inputProductID.value = productID;
    });
    </script>
    
</body>

</html>