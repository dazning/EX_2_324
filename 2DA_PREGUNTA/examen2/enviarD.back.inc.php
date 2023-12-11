<?php
session_start();
$ci=$_SESSION["ci"];
// Crear una conexión a la base de datos
$conexion = new mysqli("localhost", "u324", "123456", "academico2");
$conexion2 = new mysqli("localhost", "u324", "123456", "workflow2");
// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}
if ($conexion2->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Copiar registros de la tabla 'documentos' a 'documentosbs'
$query = "INSERT INTO documentosbs (id, ci, nombre_documento, archivo_pdf, nueva_columna)
SELECT id, ci, nombre_documento, archivo_pdf, '' AS nueva_columna
FROM documentos
WHERE ci = $ci;
";

$resultado = $conexion->query($query);

$query2 = "INSERT INTO seguimiento (secuencia, usuario, fecha_de_inicio, fecha_fin, flujo, proceso)
VALUES
('', 200, NOW(), NULL, 'F1', 'P3')";

$resultado2 = $conexion2->query($query2);


// Cerrar la conexión
$conexion->close();
?>
