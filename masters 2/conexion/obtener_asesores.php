<?php
include_once "Database.php";

// Obtener la conexión a la base de datos
$db = Database::getInstance();
$conn = $db->getConnection();

// Consulta para obtener los asesores desde la tabla alumnos
$query = "SELECT id_alumno, nombre FROM alumnos WHERE nombre IS NOT NULL";
$result = mysqli_query($conn, $query);

$asesores = array(); // Array para almacenar los asesores

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $asesores[] = array(
            'id_alumno' => $row['id_alumno'],
            'nombre_asesor' => $row['nombre'] // Mapeo correcto del nombre
        );
    }
    echo json_encode(array("DATA" => $asesores)); // Devolver en formato esperado
} else {
    echo json_encode(array("ERROR" => "Error en la consulta a la base de datos"));
}

mysqli_close($conn);
?>
