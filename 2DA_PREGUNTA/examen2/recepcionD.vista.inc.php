

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Tu título</title>
</head>
<body>
    <?php
    session_start();
    $ci = $_SESSION["ci"];

    $conexion = new mysqli("localhost", "u324", "123456", "academico2");

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    $query = "SELECT * FROM documentosbs";
    $resultado = $conexion->query($query);

    if (!$resultado) {
        die("Error al obtener los datos: " . $conexion->error);
    }
    ?>

    <div class="container mt-5" >
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CI</th>
                    <th>Nombre del Documento</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>
                            <td>{$fila['id']}</td>
                            <td>{$fila['ci']}</td>
                            <td><a href='data:application/pdf;base64," . base64_encode($fila['archivo_pdf']) . "' download='{$fila['nombre_documento']}'>{$fila['nombre_documento']}</a></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    $conexion->close();
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
