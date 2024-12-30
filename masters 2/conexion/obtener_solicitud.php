<?php
include_once "Database.php";

// Obtener la instancia de la base de datos y la conexión
$db = Database::getInstance();
$conn = $db->getConnection();

// Consulta para obtener las solicitudes
$query = "SELECT id_alumno, nombres, apellidos FROM solicitud";
$result = mysqli_query($conn, $query);

$solicitudes = array(); // Array para almacenar los resultados

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $solicitudes[] = array(
            'id_alumno' => $row['id_alumno'],
            'nombres' => $row['nombres'],
            'apellidos' => $row['apellidos']
        );
    }
    echo json_encode(array("DATA" => $solicitudes)); // Formato esperado
} else {
    echo json_encode(array("ERROR" => "Error en la consulta a la base de datos"));
}

// Cerrar la conexión
mysqli_close($conn);
?>
