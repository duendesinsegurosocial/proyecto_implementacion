<?php
include_once "conexion/Database.php";

$id_alumno = $_POST['id_alumno'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$maestro = $_POST['maestro'];
$carrera = $_POST['carrera'];
$materia = $_POST['materia'];

if (!empty($id_alumno) && !empty($nombre) && !empty($apellido) && !empty($telefono) && !empty($correo) && !empty($maestro) && !empty($carrera)&& !empty($materia)) {
    $db = Database::getInstance();
    $conn = $db->getConnection();

    $sql = "INSERT INTO alumnos (id_alumno, nombre, apellido, telefono, correo, maestro, carrera, materia) 
            VALUES ('$id_alumno', '$nombre', '$apellido', '$telefono', '$correo', '$maestro', '$carrera', '$materia')";

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
