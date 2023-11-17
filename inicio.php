<?php
// confirmar sesion
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="loggedin">
    <nav class="navtop">
        <div class="header">
            <h1 style="color:white; margin-right: 20px;">PartiTech</h1>
            <div class="nav-links">
                <a href="listagrupos.php" class="nav-link">Grupos</a>
                <a href="perfil.php" class="nav-link">Perfil</a>
                <a href="cerrar-sesion.php" class="nav-link">Cerrar Sesión</a>
            </div>
        </div>
    </nav>
    <div class="content">
        <h2>Insertar Nuevo VideoJuego</h2>
        <!-- Formulario para insertar datos en la tabla students con diseño Bootstrap -->
        <?php
        if (isset($_GET['mensaje'])) {
            echo "<p style='color: green;'>" . $_GET['mensaje'] . "</p>";
        }
        if (isset($_GET['error'])) {
            echo "<p style='color: red;'>" . $_GET['error'] . "</p>";
        }
        ?>
        <form method="POST" action="registro.php" class="form-horizontal">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>peliulas:</th>
                    <th>Año:</th>
                    <th>casa productora:</th>
                    <th>Genero:</th>
                    <th>Enviar</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><input type="text" class="form-control" name="nombres" required></td>
                    <td><input type="text" class="form-control" name="apellidomat" required></td>
                    <td><input type="text" class="form-control" name="apellidopat" required></td>
                    <td><input type="text" class="form-control" name="grupo" required></td>
                    <td><input type="submit" class="btn btn-primary" value="Guardar"></td>
                </tr>
                </tbody>
            </table>
        </form>
        <!-- Mostrar la tabla de estudiantes -->
        <h3>Tabla de peliculas</h3>
        <?php
        // Aquí debes obtener y mostrar los datos de la tabla students
        // Conectar a la base de datos (incluye tu archivo de conexión)
        include 'conexionDB.php';
        global $con;
        // Consulta SQL para obtener todos los registros de students
        $sql = "SELECT * FROM estudiantes";
        $result = $con->query($sql);
        // Verificar si la tabla está vacía
        if ($result->num_rows > 0) 
            echo "<table border='1'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Id peliculas</th>";
            echo "<th>peliculas</th>";
            echo "<th>Año</th>";
            echo "<th>casa productora</th>";
            echo "<th>Genero</th>";
            echo "<th>Borrar</th>";
            echo "<th>actualizar</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id_estudiante']}</td>";
                echo "<td>{$row['nombres']}</td>";
                echo "<td>{$row['apellidomat']}</td>";
                echo "<td>{$row['apellidopat']}</td>";
                echo "<td>{$row['grupo']}</td>";
                echo "<td><form method='POST' action='borrar_estudiante.php'>
                    <input type='hidden' name='id_estudiante' value='{$row['id_estudiante']}'>
                    <input type='submit' class='btn btn-danger' value='Borrar'>
                </form></td>";
                echo "<td><form method='POST' action='editar_estudiante.php'>
                    <input type='hidden' name='id_estudiante' value='{$row['id_estudiante']}'>
                    <input type='submit' class='btn btn-danger' value='Editar'>
                </form></td>";
        echo "</tr>";
     }   
            
            echo "</tbody>";
            echo "</table>";
   
        // Cerrar la consulta
        $result->close();
        ?>
    </div>
 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"> 
    </script>
    <script>
    function cancelarEdicion(button) {
        // Encuentra el formulario de edición relacionado al botón "Cancelar"
        var editForm = button.parentNode;
        // Restaura el contenido original de la fila
        var originalContent = editForm.getAttribute('data-original-content');
        editForm.innerHTML = originalContent;
    }
</script>
</body>
</html>
