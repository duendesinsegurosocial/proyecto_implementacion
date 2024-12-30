<?php
// Incluye la clase Database
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
    $conn = $db->getConnection();

    // Sanitización de los datos para evitar inyecciones SQL
    $id_alumno = mysqli_real_escape_string($conn, $id_alumno);
    $nombres = mysqli_real_escape_string($conn, $nombres);
    $apellidos = mysqli_real_escape_string($conn, $apellidos);
    $carrera = mysqli_real_escape_string($conn, $carrera);
    $asesor = mysqli_real_escape_string($conn, $asesor);
    $materia = mysqli_real_escape_string($conn, $materia);

    // Consulta para insertar los datos
    $sql = "INSERT INTO solicitud (id_alumno, nombres, apellidos, carrera, asesor, materia) 
            VALUES ('$id_alumno', '$nombres', '$apellidos', '$carrera', '$asesor', '$materia')";

    // Ejecuta la consulta y verifica el resultado
    if (mysqli_query($conn, $sql)) {
        echo "Registro guardado correctamente.";
    } else {
        echo "Error al guardar el registro: " . mysqli_error($conn);
    }

    // Cierra la conexión
    mysqli_close($conn);
} else {
    echo "Por favor, completa todos los campos.";
}
?>
