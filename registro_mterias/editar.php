<?php
include_once "conexion/Database.php";


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}




// Captura los datos enviados mediante POST
$id_materia = $_POST['id_materia'];
$nombre_materia	 = $_POST['nombre_materia'];

// Verifica que los campos obligatorios no estén vacíos
if (!empty($id_materia) && !empty($nombre_materia)) {
    // Obtener la conexión usando el patrón Singleton
    $db = Database::getInstance();
    $conn = $db->getConnection(); // Obtener la conexión correcta

    // Consulta para actualizar los datos del alumno
    $sql = "UPDATE mateias SET nombre_materia = ? WHERE id_materia = ?";

    // Preparar la consulta
    if ($stmt = $conn->prepare($sql)) {
        // Vincular los parámetros a la consulta
        $stmt->bind_param("sssssss", $nombre_materia,$id_materia);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Registro actualizado correctamente.";
        } else {
            echo "Error al actualizar el registro: " . $stmt->error;
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
} else {
    echo "Por favor, completa todos los campos.";
}
?>
