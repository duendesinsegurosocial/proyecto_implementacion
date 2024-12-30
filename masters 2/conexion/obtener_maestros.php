<?php
include_once "Database.php";

// Obtener la instancia de la base de datos y la conexión
$db = Database::getInstance();
$conn = $db->getConnection();

// Consulta para obtener los maestros
$query = "SELECT id_maestro, nombres, apellidos FROM maestros";
$result = mysqli_query($conn, $query);

$maestros = array(); // Array para almacenar los resultados

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $maestros[] = array(
            'id_maestro' => $row['id_maestro'],
            'nombres' => $row['nombres'],
            'apellidos' => $row['apellidos']
        );
    }
    echo json_encode(array("DATA" => $maestros)); // Formato esperado
} else {
    echo json_encode(array("ERROR" => "Error en la consulta a la base de datos"));
}

// Cerrar la conexión
mysqli_close($conn);
?>
