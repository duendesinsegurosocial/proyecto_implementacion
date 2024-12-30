<?php
// Incluye la clase Database
include_once "conexion/Database.php";





// Captura los datos enviados mediante POST
$id_materia = $_POST['id_materia'];
$nombre_materia = $_POST['nombre_materia'];


// Verifica que los campos obligatorios no estén vacíos
if (!empty($id_materia) && !empty($nombre_materia)) {
    // Obtener la conexión usando el patrón Singleton
    $db = Database::getInstance();
    $conn = $db->getConnection();

    // Consulta para insertar los datos
    $sql = "INSERT INTO materias (id_materia, nombre_materia) 
            VALUES ('$id_materia', '$nombre_materia')";

    // Ejecuta la consulta y verifica el resultado
    $result = $db->exec($sql);

    if ($result['STATUS'] === "OK") {
        echo "Registro guardado correctamente.";
    } else {
        echo "Error al guardar el registro: " . $result['ERROR'];
    }
} else {
    echo "Por favor, completa todos los campos.";
}
?>
