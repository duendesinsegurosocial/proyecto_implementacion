<?php
include_once "conexion/Database.php";

// Captura los datos enviados mediante POST
$id_alumno = $_POST['id_alumno'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$carrera = $_POST['carrera'];
$asesor = $_POST['asesor'];
$materia = $_POST['materia'];

// Verifica que los campos obligatorios no estén vacíos
if (!empty($id_alumno) && !empty($nombres) && !empty($apellidos) && !empty($carrera) && !empty($asesor) && !empty($materia)) {
    // Obtener la conexión usando el patrón Singleton
    $db = Database::getInstance();
    $conn = $db->getConnection(); // Obtener la conexión correcta

    // Sanitizar los datos para evitar inyecciones SQL
    $id_alumno = mysqli_real_escape_string($conn, $id_alumno);
    $nombres = mysqli_real_escape_string($conn, $nombres);
    $apellidos = mysqli_real_escape_string($conn, $apellidos);
    $carrera = mysqli_real_escape_string($conn, $carrera);
    $asesor = mysqli_real_escape_string($conn, $asesor);
    $materia = mysqli_real_escape_string($conn, $materia);

    // Consulta para actualizar los datos del alumno
    $sql = "UPDATE solicitud SET nombres = ?, apellidos = ?, carrera = ?, asesor = ?, materia = ? WHERE id_alumno = ?";

    // Preparar la consulta
    if ($stmt = $conn->prepare($sql)) {
        // Vincular los parámetros a la consulta (se usa "ssssss" para los tipos de datos: s = string)
        $stmt->bind_param("ssssss", $nombres, $apellidos, $carrera, $asesor, $materia, $id_alumno);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Registro actualizado correctamente.";
        } else {
            echo "Error al actualizar el registro: " . $stmt->error;
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    mysqli_close($conn);

} else {
    echo "Por favor, completa todos los campos.";
}
?>
