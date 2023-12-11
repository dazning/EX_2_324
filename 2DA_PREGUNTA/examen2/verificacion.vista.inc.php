<h1 align='center'>ENVIO EXITOSO</h1>
<h2 align='center'>Espere la evaluacion</h2>
<?php
session_start();
$ci = $_SESSION["ci"];


$conexion = new mysqli("localhost", "u324", "123456", "academico2");

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

$query = "SELECT * FROM documentosbs where ci=$ci";
$resultado = $conexion->query($query);

if (!$resultado) {
    die("Error al obtener los datos: " . $conexion->error);
}

echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>CI</th>
            <th>Nombre del Documento</th>
           
            <th>Estado</th>
        </tr>";

while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>
            <td>{$fila['id']}</td>
            <td>{$fila['ci']}</td>
            <td>{$fila['nombre_documento']}</td>
          
            <td>";

    // Determinar el estado y mostrar el mensaje correspondiente
    if ($fila['nueva_columna'] === 'si') {
        echo "<strong>Aprobado</strong>";
    } elseif ($fila['nueva_columna'] === 'no') {
        echo "<strong>Rechazado</strong>";
    } else {
        echo "<strong>Pendiente</strong>";
    }
    

    echo "</td>
          </tr>";
}

echo "</table>";

$conexion->close();
?>
