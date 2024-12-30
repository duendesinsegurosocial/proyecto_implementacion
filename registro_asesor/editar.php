<?php
include_once('conexion/database.php');

$db = Database::getInstance();
$conn = $db->getConnection();

// Verifica que todas las variables POST estén definidas
$id_alumno = isset($_POST['id_alumno']) ? $_POST['id_alumno'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';
$maestro = isset($_POST['maestro']) ? $_POST['maestro'] : '';
$carrera = isset($_POST['carrera']) ? $_POST['carrera'] : '';
$materia = isset($_POST['materia']) ? $_POST['materia'] : '';

// Prepara la consulta SQL
$query = "UPDATE alumnos 
          SET nombre=?, apellido=?, telefono=?, correo=?, maestro=?, carrera=?, materia=?
          WHERE id_alumno=?";

// Prepara y ejecuta la consulta
$stmt = $conn->prepare($query);
$stmt->bind_param("sssssssi", $nombre, $apellido, $telefono, $correo, $maestro, $carrera, $materia, $id_alumno);

if ($stmt->execute()) {
    echo "Registro actualizado exitosamente.";
} else {
    echo "Error al actualizar el registro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
