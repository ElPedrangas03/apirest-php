<!DOCTYPE html>
<html lang="es" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="css/estilo.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

    <main class="flex-shrink-0">
        <div class="container">
            <h3 class="my-3">Añadir producto</h3>

            <form action="../api-rest/create_product.php" class="row g-3" method="post" autocomplete="off">
                <div class="col-md-4">
                    <label for="nombre" class="form-label">Nombre del producto</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required autofocus>
                </div>

                <div class="col-md-8">
                    <label for="cantidad" class="form-label">Cantidad por unidad</label>
                    <input type="text" class="form-control" id="cantidad" name="cantidad" required>
                </div>

                <div class="col-md-6">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="precio" name="precio" required step=".1" min="0">
                </div>

                <div class="col-md-6">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required min="0">
                </div>

                <div class="col-md-6">
                    <label for="orders" class="form-label">Unidades en la orden</label>
                    <input type="number" class="form-control" id="orders" name="orders" min="0">
                </div>

                <div class="col-md-6">
                    <label for="CantidadPedidos" class="form-label">Cantidad de pedidos</label>
                    <input type="number" class="form-control" id="CantidadPedidos" name="CantidadPedidos" min="0">
                </div>

                <div class="col-md-4">
                    <label for="Descontinuado" class="form-label">Descontinuado</label>
                    <input type="number" class="form-control" id="Descontinuado" name="Descontinuado" min="0">
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
            <span class="text-body-secondary"> 2024 | Códigos de Programación</span>
        </div>
    </footer>

    
        <script>
            document.querySelector('form').addEventListener('submit', function(e) {
                e.preventDefault();
        
                const data = new URLSearchParams(new FormData(this));
        
                fetch('../api-rest/create_product.php', {
                    method: 'POST',
                    body: data
                })
                .then(response => {
                    if(response.ok) {
                        // Redirige al usuario o muestra un mensaje de éxito
                        window.location.href = 'index.php';
                    } else {
                        alert('Error al crear el producto');
                    }
                });
            });
        </script>
</body>

</html>