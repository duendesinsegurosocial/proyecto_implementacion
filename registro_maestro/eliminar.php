<?php
include_once "conexion/Database.php";

// Capturar el ID del maestro que se va a eliminar
$id_maestro = $_POST['id_maestro'];

// Verificar que el ID no esté vacío
if (!empty($id_maestro)) {
    // Obtener la conexión a la base de datos
    $db = Database::getInstance();
    $conn = $db->getConnection();

    // Consulta para eliminar el registro del maestro
    $sql = "DELETE FROM maestros WHERE id_maestro = '$id_maestro'";

    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }
} else {
    echo "Por favor, ingresa un ID de maestro válido.";
}
?>
