<?php
// Incluir el archivo de conexión
include_once('conexion/Database.php');

// Obtener la conexión usando el patrón Singleton
$db = Database::getInstance();
$conn = $db->getConnection();  // Obtener la conexión

// Verificar que la conexión se haya establecido
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Consulta para obtener los registros de los maestros
$query = "SELECT * FROM maestros";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if ($result) {
    $maestros = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $maestros[] = $row;  // Agregar cada fila de resultado al arreglo
    }
    // Enviar los datos como JSON
    echo json_encode(array("DATA" => $maestros));
} else {
    // Si la consulta falla, mostrar un mensaje de error
    echo "Error en la consulta: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>
