<?php
include_once "conexion/Database.php";


// Captura el id del alumno que se va a eliminar
$id_alumno = $_POST['id_alumno'];

// Verifica que el id del alumno no esté vacío
if (!empty($id_alumno)) {
    // Obtener la conexión usando el patrón Singleton
    $db = Database::getInstance();
    $conn = $db->getConnection(); // Obtener la conexión correcta

    // Consulta para eliminar el alumno
    $sql = "DELETE FROM solicitud WHERE id_alumno = ?";

    // Preparar la consulta
    if ($stmt = $conn->prepare($sql)) {
        // Vincular el parámetro
        $stmt->bind_param("s", $id_alumno); // "s" indica que el parámetro es una cadena (string)

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

