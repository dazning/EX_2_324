<?php
session_start();
$ci = $_SESSION["ci"];


$conexion = new mysqli("localhost", "u324", "123456", "academico2");

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["nueva_columna"])) {
        $nueva_columna = $_GET["nueva_columna"];
        $id_array = $_GET["id"];

        $query = "UPDATE documentosbs SET nueva_columna = ? WHERE id = ?";
        $stmt = $conexion->prepare($query);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }

        // Iterar sobre los valores de nueva_columna y los IDs correspondientes
        foreach ($nueva_columna as $index => $valor) {
            $id = $id_array[$index];

            $stmt->bind_param("si", $valor, $id);

            if ($stmt->execute() === false) {
                die("Error al ejecutar la consulta: " . $stmt->error);
            }
        }

        $stmt->close();

        echo "Actualización exitosa.";
    } else {
        echo "No se recibió el valor de nueva_columna.";
    }
}

$conexion->close();
?>
