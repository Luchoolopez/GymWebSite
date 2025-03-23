<?php
session_start();
include 'php/conexion_horarios_be.php';

// Obtener los horarios actuales
$query = "SELECT * FROM horarios ORDER BY hora_inicio";
$result = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="assets/css/LoginStyles.css">
</head>
<body>
    <h1>Panel de Control - Gestión de Clases</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre de Clase</th>
            <th>Profesor</th>
            <th>Hora Inicio</th>
            <th>Hora Fin</th>
            <th>Cupo</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <form action="php/actualizar_clase.php" method="POST">
                    <td><?php echo $row['id']; ?></td>
                    <td><input type="text" name="nombre_clase" value="<?php echo $row['nombre_clase']; ?>" required></td>
                    <td><input type="text" name="profesor" value="<?php echo $row['profesor']; ?>" required></td>
                    <td><input type="time" name="hora_inicio" value="<?php echo $row['hora_inicio']; ?>" required></td>
                    <td><input type="time" name="hora_fin" value="<?php echo $row['hora_fin']; ?>" required></td>
                    <td><input type="number" name="cupo" value="<?php echo $row['cupo']; ?>" required></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Actualizar</button>
                        <a href="php/eliminar_clase.php?id=<?php echo $row['id']; ?>">Eliminar</a>
                    </td>
                </form>
            </tr>
        <?php } ?>
    </table>

    <h2>Agregar Nueva Clase</h2>
    <form action="php/actualizar_clase.php" method="POST">
        <input type="text" name="nombre_clase" placeholder="Nombre de la clase" required>
        <input type="text" name="profesor" placeholder="Profesor" required>
        <input type="time" name="hora_inicio" required>
        <input type="time" name="hora_fin" required>
        <input type="number" name="cupo" placeholder="Cupo" required>
        <button type="submit">Agregar Clase</button>
    </form>
</body>
</html>