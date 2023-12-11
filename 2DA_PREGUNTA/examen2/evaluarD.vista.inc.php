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

echo "<form method='GET' action='recepcionD.back.inc.php'>"; // Cambia 'back.php' al nombre correcto de tu archivo backend
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>CI</th>
            <th>Nombre del Documento</th>
            
            <th>Aceptar?</th>
        </tr>";

while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>
            <td>{$fila['id']}</td>
            <td>{$fila['ci']}</td>
            <td>{$fila['nombre_documento']}</td>
            
            <td>
                <input type='hidden' name='id[]' value='{$fila['id']}'>
                <input type='text' name='nueva_columna[]' value='{$fila['nueva_columna']}'>
            </td>
          </tr>";
}



$conexion->close();
?>
