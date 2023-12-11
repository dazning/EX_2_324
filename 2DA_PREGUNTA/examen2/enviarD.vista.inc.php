<?php

session_start();
$ci=$_SESSION["ci"];

// Crear una conexión a la base de datos
$conexion = new mysqli("localhost", "u324", "123456", "academico2");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Realizar la consulta para obtener los datos de la tabla
$query = "SELECT * FROM documentos where ci=$ci";
$resultado = $conexion->query($query);

// Verificar si la consulta fue exitosa
if (!$resultado) {
    die("Error al obtener los datos: " . $conexion->error);
}

// Mostrar los datos en una tabla HTML
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>CI</th>
            <th>Nombre del Documento</th>
            
        </tr>";

while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>
            <td>{$fila['id']}</td>
            <td>{$fila['ci']}</td>
           
            <td><a href='data:application/pdf;base64," . base64_encode($fila['archivo_pdf']) . "' download='{$fila['nombre_documento']}'>{$fila['nombre_documento']}</a></td>
            
          </tr>";
}

echo "</table>";

// Cerrar la conexión
$conexion->close();
?>


