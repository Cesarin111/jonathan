<?php
// Incluye tu archivo de conexión
include 'conexionDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene el id_estudiante del formulario
    $id_estudiante = $_POST['id_estudiante'];

    // Consulta SQL para eliminar el estudiante
    $sql = "DELETE FROM estudiantes WHERE id_estudiante = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $id_estudiante);

    if ($stmt->execute()) {
        // Redirige de nuevo a la página principal o muestra un mensaje de éxito
        header('Location: inicio.php?mensaje=Estudiante eliminado exitosamente');
        exit;
    } else {
        // Muestra un mensaje de error si la eliminación falla
        header('Location: inicio.php?error=Error al eliminar el estudiante');
        exit;
    }

    // Cierra la conexión y el statement
    $stmt->close();
    $con->close();
}
?>