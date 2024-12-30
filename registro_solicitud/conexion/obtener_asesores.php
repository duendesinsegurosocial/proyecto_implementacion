<?php
include_once "Database.php";

// Obtener la conexión a la base de datos
$db = Database::getInstance();
$conn = $db->getConnection();

// Consulta para obtener los asesores desde la tabla alumnos
$query = "SELECT id_alumno, nombre FROM alumnos WHERE nombre IS NOT NULL";
$result = mysqli_query($conn, $query);

$asesores = array();

// Verifica si se obtuvieron resultados
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $asesores[] = array(
            'id_alumno' => $row['id_alumno'],
            'nombre_asesor' => $row['nombre']  // Cambié 'nombre_asesor' por 'nombre'
        );
    }

    // Devolver los datos en formato JSON
    echo json_encode($asesores);
} else {
    echo json_encode(array("error" => "No se pudieron obtener los asesores"));
}

mysqli_close($conn);
?>
