<?php
include_once "conexion/Database.php";

// Capturar los datos enviados por el formulario
$id_maestro = $_POST['id_maestro'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$materia = $_POST['materia'];
$carrera = $_POST['carrera'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

// Verificar que el ID del maestro esté presente
if (!empty($id_maestro)) {
    // Obtener la conexión a la base de datos
    $db = Database::getInstance();
    $conn = $db->getConnection();

    // Consulta para actualizar los datos en la tabla 'maestros'
    $sql = "UPDATE maestros 
            SET nombres = '$nombres', apellidos = '$apellidos', materia = '$materia', carrera = '$carrera', telefono = '$telefono', correo = '$correo' 
            WHERE id_maestro = '$id_maestro'";

    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado correctamente.";
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
} else {
    echo "Por favor, ingresa un ID de maestro válido.";
}
?>
