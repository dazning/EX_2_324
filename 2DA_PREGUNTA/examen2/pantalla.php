<?php
$flujo = $_GET["flujo"];
$proceso = $_GET["proceso"];
$link = mysqli_connect("localhost", "infu324", "123456", "workflow2");
$resultado = mysqli_query($link, "select * from flujo where flujo='$flujo' and proceso='$proceso'");
$fila = mysqli_fetch_array($resultado);
$proceso = $fila["proceso"];
$procesosiguiente = $fila["proceso_siguiente"];
$pantalla = $fila["pantalla"];
$archivo = $fila["pantalla"] . ".vista.inc.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Formulario de Proceso</title>

    <!-- Bootstrap CSS desde CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="motor.php" method="GET">
                <input type="hidden" name="pantalla" value="<?php echo $pantalla; ?>"/>
                <input type="hidden" name="flujo" value="<?php echo $flujo; ?>"/>
                <input type="hidden" name="proceso" value="<?php echo $proceso; ?>"/>
                <input type="hidden" name="procesosiguiente" value="<?php echo $procesosiguiente; ?>"/>
                <?php include $archivo; ?>
                <div class="mt-4 text-center">
                    <button type="submit" name="Anterior" class="btn btn-secondary">Anterior</button>
                    <button type="submit" name="Siguiente" class="btn btn-primary">Siguiente</button>
                </div>
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
