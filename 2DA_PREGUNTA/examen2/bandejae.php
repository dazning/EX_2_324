<?php
$link = mysqli_connect("localhost", "infu324", "123456", "workflow2");
session_start();
$rol = $_SESSION["rol"];
$usuario = $_SESSION["ci"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Workflow - Panel de Estudiante</title>

    <!-- Bootstrap CSS desde CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php
          echo "<div class='text-center'>";
          echo "<h3>Rol: $rol</h3>";
          echo "<h3>Usuario: $usuario</h3>";

            // Mostrar el formulario solo si el rol es de estudiante
            if ($rol == 'estudiante') {
                if (isset($_POST['iniciar_proceso'])) {
                    // Acción cuando se presiona el botón "INICIAR Proceso"

                    // Obtener la fecha actual
                    $fecha_actual = date("Y-m-d H:i:s");

                    // Definir valores para la inserción en la tabla "seguimiento"
                    $flujo = "F1";
                    $proceso = "P1";

                    // Insertar datos en la tabla "seguimiento"
                    $insert_query = "INSERT INTO seguimiento (usuario, fecha_de_inicio, fecha_fin, flujo, proceso)
                                    VALUES ('$usuario', '$fecha_actual', NULL, '$flujo', '$proceso')";

                    // Ejecutar la consulta
                    if (mysqli_query($link, $insert_query)) {
                        echo "<p class='alert alert-success'>Inserción exitosa</p>";
                    } else {
                        echo "<p class='alert alert-danger'>Error en la inserción: " . mysqli_error($link) . "</p>";
                    }

                    // Redirigir a la página de destino o realizar otras acciones necesarias
                    header("Location: bandejae.php");
                    exit();
                }

                // Mostrar el formulario
                echo '<form action="" method="post">';
                echo '<button type="submit" name="iniciar_proceso" class="btn btn-primary">INICIAR Proceso</button>';
                echo '</form>';
            }

            // Consulta para obtener datos de la tabla "seguimiento"
            $sql = "SELECT * FROM seguimiento WHERE usuario='$usuario' AND fecha_fin IS NULL ORDER BY fecha_de_inicio";
            $resultado = mysqli_query($link, $sql);

            echo "<table class='table table-bordered table-dark mt-4 border border-4'>"; // Agregué la clase border y border-2
            echo "<thead>";
            echo "<tr>";
            echo "<th scope='col'>Flujo</th>";
            echo "<th scope='col'>Proceso</th>";
            echo "<th scope='col'>Fecha y Hora de Inicio</th>";
            echo "<th scope='col'>Acción</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($fila = mysqli_fetch_array($resultado)) {
                echo "<tr>";
                echo "<td>{$fila['flujo']}</td>";
                echo "<td>{$fila['proceso']}</td>";
                echo "<td>{$fila['fecha_de_inicio']}</td>";
                echo "<td><a href='pantalla.php?flujo={$fila['flujo']}&proceso={$fila['proceso']}' class='btn btn-info'>Ver</a></td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";

            // Cerrar la conexión
            mysqli_close($link);
            ?>
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
