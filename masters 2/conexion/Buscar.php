<?php
include_once('Database.php');

// Obtener los parámetros de búsqueda desde el formulario
$carrera = isset($_POST['carrera']) ? $_POST['carrera'] : '';
$maestro = isset($_POST['maestro']) ? $_POST['maestro'] : '';
$materia = isset($_POST['materia']) ? $_POST['materia'] : '';
$asesor = isset($_POST['asesor']) ? $_POST['asesor'] : '';

// Crear conexión con la base de datos
$db = Database::getInstance();
$conn = $db->getConnection();

// Inicializar la consulta
$sql = "";
$param = "";

// Construir la consulta según los parámetros proporcionados
if (!empty($materia)) {
    $sql = "SELECT 
                alumnos.nombre, 
                maestros.nombres AS maestro, 
                materias.nombre_materia
            FROM alumnos
            INNER JOIN maestros ON alumnos.materia = maestros.materia
            INNER JOIN materias ON alumnos.materia = materias.id_materia
            WHERE materias.id_materia = ?";
    $param = $materia;
} elseif (!empty($maestro)) {
    $sql = "SELECT 
                alumnos.nombre, 
                maestros.nombres AS maestro, 
                materias.nombre_materia
            FROM alumnos
            INNER JOIN maestros ON alumnos.materia = maestros.materia
            INNER JOIN materias ON alumnos.materia = materias.id_materia
            WHERE maestros.id_maestro = ?";
    $param = $maestro;
} elseif (!empty($asesor)) {
    $sql = "SELECT 
                alumnos.nombre, 
                maestros.nombres AS maestro, 
                materias.nombre_materia
            FROM alumnos
            INNER JOIN maestros ON alumnos.materia = maestros.materia
            INNER JOIN materias ON alumnos.materia = materias.id_materia
            WHERE alumnos.id_alumno = ?";
    $param = $asesor;
}

// Ejecutar la consulta si se construyó
if (!empty($sql)) {
    if ($stmt = $conn->prepare($sql)) {
        // Vincular el parámetro
        $stmt->bind_param("s", $param); // "s" indica que el parámetro es una cadena (string)
        echo "Consulta: $sql, Parámetro: $param";
        // Ejecutar la consulta
        if ($stmt->execute()) {
            $result = $db->get_datastmt($stmt);
            echo json_encode($result);
        } else {
            echo "Error en la búsqueda: " . $stmt->error;
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
} else {
    echo "No se proporcionaron parámetros de búsqueda válidos.";
}
?>
