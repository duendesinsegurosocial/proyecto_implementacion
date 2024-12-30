<?php
include_once "Database.php";

// Obtener la conexión a la base de datos
$db = Database::getInstance();
$conn = $db->getConnection();

// Consulta para obtener todas las materias
$sql = "SELECT id_materia, nombre_materia FROM materias";
$result = $conn->query($sql);

// Crear un array para almacenar las materias
$materias = [];

if ($result->num_rows > 0) {
    // Recuperar los resultados
    while ($row = $result->fetch_assoc()) {
        $materias[] = $row;
    }
}

// Devolver los datos en formato JSON
echo json_encode($materias);
?>
