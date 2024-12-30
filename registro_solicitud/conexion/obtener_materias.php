<?php
include_once "Database.php";

// Obtener la conexión a la base de datos
$db = Database::getInstance();
$conn = $db->getConnection();

// Consulta para obtener todas las materias
$query = "SELECT id_materia, nombre_materia FROM materias";
$result = mysqli_query($conn, $query);

$materias = array();

// Verifica si se obtuvieron resultados
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $materias[] = $row;
    }

    // Devolver los datos en formato JSON
    echo json_encode($materias);
} else {
    echo json_encode(array("error" => "No se pudieron obtener las materias"));
}

mysqli_close($conn);
?>
