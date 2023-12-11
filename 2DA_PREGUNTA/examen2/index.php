<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Formulario de Ingreso</title>

    <!-- Bootstrap CSS desde CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="bg-dark">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-light p-4 rounded">
            <h2 class="text-center text-dark mb-4">LOGIN</h2>
            <form action="validaingreso.php" method="GET">
                <div class="form-group">
                    <label for="ci">Usuario</label>
                    <input type="text" class="form-control" id="ci" name="ci" value="">
                </div>
                <div class="form-group">
                    <label for="pass">Clave</label>
                    <input type="password" class="form-control" id="pass" name="pass" value="">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Aceptar</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS y Popper.js desde CDN -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-Ew5BxIM+9udFdBc2WEv1wOyIRqmeO5mrMUn1GDAZs1jTk9qF8F+XJyOpTNTlR4N2" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
