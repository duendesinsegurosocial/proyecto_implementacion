<?php
include_once "conexion/Database.php";

// Capturar los datos enviados por el formulario
$id_maestro = $_POST['id_maestro'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$materia = $_POST['materia']; // ID de la materia seleccionada
$carrera = $_POST['carrera'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

// Verificar que los campos obligatorios no estén vacíos
if (!empty($id_maestro) && !empty($nombres) && !empty($apellidos) && !empty($materia) && !empty($carrera) && !empty($telefono) && !empty($correo)) {
    // Obtener la conexión a la base de datos
    $db = Database::getInstance();
    $conn = $db->getConnection();

    // Consulta para insertar los datos en la tabla 'maestros'
    $sql = "INSERT INTO maestros (id_maestro, nombres, apellidos, materia, carrera, telefono, correo) 
            VALUES ('$id_maestro', '$nombres', '$apellidos', '$materia', '$carrera', '$telefono', '$correo')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro guardado correctamente.";
    } else {
        echo "Error al guardar el registro: " . $conn->error;
    }
} else {
    echo "Por favor, completa todos los campos.";
}
?>
