<?php
include_once "Database.php";

// Obtener la instancia de la base de datos y la conexión
$db = Database::getInstance();
$conn = $db->getConnection();

// Consulta para obtener las materias
$query = "SELECT id_materia, nombre_materia FROM materias";
$result = mysqli_query($conn, $query);

$materias = array(); // Array para almacenar los resultados

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $materias[] = array(
            'id_materia' => $row['id_materia'],
            'nombre_materia' => $row['nombre_materia']
        );
    }
    echo json_encode(array("DATA" => $materias)); // Formato esperado
} else {
    echo json_encode(array("ERROR" => "Error en la consulta a la base de datos"));
}

// Cerrar la conexión
mysqli_close($conn);
?>
