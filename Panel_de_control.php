<?php
session_start();
include 'php/conexion_horarios_be.php';

// Verificar si la sesión está iniciada y si el usuario tiene el rol adecuado
if (!isset($_SESSION['rol']) || ($_SESSION['rol'] !== 'dueño' && $_SESSION['rol'] !== 'trabajador')) {
    echo "
    <script>
        alert('Acceso denegado');
        window.location = 'Login.php';
    </script>
    ";
    session_destroy();
    die();
}

// Obtener los usuarios
$query = "SELECT * FROM usuarios";
$result = $conexion->query($query);

// Obtener los horarios actuales
$query_horarios = "SELECT * FROM horarios ORDER BY hora_inicio";
$result_horarios = $conexion->query($query_horarios);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="">
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
        <?php while ($row = mysqli_fetch_assoc($result_horarios)) { ?>
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

    <h2>Gestión de Usuarios</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Correo</th>
            <th>Usuario</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <form action="php/actualizar_usuario.php" method="POST">
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre_completo']; ?></td>
                    <td><?php echo $row['correo']; ?></td>
                    <td><?php echo $row['usuario']; ?></td>
                    <td>
                        <select name="rol">
                            <option value="usuario" <?php if ($row['rol'] == 'usuario') echo 'selected'; ?>>Usuario</option>
                            <option value="trabajador" <?php if ($row['rol'] == 'trabajador') echo 'selected'; ?>>Trabajador</option>
                            <option value="dueño" <?php if ($row['rol'] == 'dueño') echo 'selected'; ?>>Dueño</option>
                        </select>
                    </td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Actualizar</button>
                    </td>
                </form>
            </tr>
        <?php } ?>
    </table>
</body>
</html>