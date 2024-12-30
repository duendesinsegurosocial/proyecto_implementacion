<?php
include_once('Database.php');

$db = Database::getInstance();
$conn = $db->getConnection();

$query = "SELECT id_materia, nombre_materia FROM materias";
$result = mysqli_query($conn, $query);

$materias = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $materias[] = $row;
    }
    echo json_encode(array("DATA" => $materias));
} else {
    echo json_encode(array("ERROR" => "Error en la consulta"));
}

mysqli_close($conn);
?>
