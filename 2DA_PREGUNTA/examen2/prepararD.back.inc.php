<?php
session_start();
$ci=$_SESSION["ci"];

// Establecer la conexión a la base de datos
$conexion = new mysqli("localhost", "u324", "123456", "academico2");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

if (isset($_GET["archivo"])) {
    $base64_pdf = $_GET["archivo"];
    $contenido_pdf = base64_decode($base64_pdf);

    $usuario_id = $_SESSION["ci"];
    
    $nombre_archivo = $_GET["archivo"];// Puedes asignar un nombre estático o implementar lógica para generar nombres únicos

    // Preparar la consulta SQL
    $sql = "INSERT INTO documentos (ci, nombre_documento, archivo_pdf) VALUES (?, ?, ?)";
    
    // Preparar la declaración
    $stmt = $conexion->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("iss", $usuario_id, $nombre_archivo, $contenido_pdf);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "El archivo PDF se subió y guardó en la base de datos correctamente.";
    } else {
        echo "Error al subir y guardar el archivo PDF: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo "Error al subir el archivo. Asegúrate de seleccionar un archivo.";
}

// Cerrar la conexión a la base de datos
$conexion->close();

?>
