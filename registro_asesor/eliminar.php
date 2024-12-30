<?php
include_once "conexion/Database.php";


$id_alumno = $_POST['id_alumno'];

if (!empty($id_alumno)) {
    $db = Database::getInstance();
    $conn = $db->getConnection(); 

    $sql = "DELETE FROM alumnos WHERE id_alumno = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $id_alumno); 

        if ($stmt->execute()) {
            echo "Registro eliminado correctamente.";
        } else {
            echo "Error al eliminar el registro: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
} else {
    echo "Por favor, proporciona el ID del alumno.";
}

