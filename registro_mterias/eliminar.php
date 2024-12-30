<?php
include_once "conexion/Database.php";


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}




// Captura el id del alumno que se va a eliminar
$id_materia = $_POST['id_materia'];

// Verifica que el id del alumno no esté vacío
if (!empty($id_materia)) {
    // Obtener la conexión usando el patrón Singleton
    $db = Database::getInstance();
    $conn = $db->getConnection(); // Obtener la conexión correcta

    // Consulta para eliminar el alumno
    $sql = "DELETE FROM materias WHERE id_materia = ?";

    // Preparar la consulta
    if ($stmt = $conn->prepare($sql)) {
        // Vincular el parámetro
        $stmt->bind_param("s", $id_materia); // "s" indica que el parámetro es una cadena (string)

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Registro eliminado correctamente.";
        } else {
            echo "Error al eliminar el registro: " . $stmt->error;
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
} else {
    echo "Por favor, proporciona el ID del alumno.";
}

