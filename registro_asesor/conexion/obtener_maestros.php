<?php
include_once('Database.php');

$db = Database::getInstance();
$conn = $db->getConnection();

$query = "SELECT id_maestro, nombres, apellidos FROM maestros";
$result = mysqli_query($conn, $query);

$maestros = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $maestros[] = $row;
    }
    echo json_encode(array("DATA" => $maestros));
} else {
    echo json_encode(array("ERROR" => "Error en la consulta"));
}

mysqli_close($conn);
?>
