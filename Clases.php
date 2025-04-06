<?php
session_start();
include 'php/conexion_horarios_be.php';

// Obtener las clases disponibles
$query = "SELECT * FROM horarios ORDER BY hora_inicio";
$result = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Clase</title>
    <link rel="stylesheet" href="assets/css/Reserva_clase.css">
</head>
<body>
    <h1>Clases Disponibles</h1>
    <table border="1">
        <tr> <!--Table row, representa una fila en una tabla, se utiliza dentro de un table para agrupar celdas de datos o encabezados -->
            <th>Nombre de Clase</th> <!-- Table header, el encabezado de una tabla-->
            <th>Profesor</th>
            <th>Hora Inicio</th>
            <th>Hora Fin</th>
            <th>Cupo</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { 
            // Verificar cupos disponibles
            $clase_id = $row['id'];
            $query_reservas = "SELECT COUNT(*) as total_reservas FROM reservas WHERE clase_id='$clase_id'";
            $result_reservas = $conexion->query($query_reservas);
            $total_reservas = mysqli_fetch_assoc($result_reservas)['total_reservas'];
            $cupos_disponibles = $row['cupo'] - $total_reservas;

            // Verificar si la clase ya pasó
            $hora_actual = date('H:i');
            $clase_pasada = $hora_actual > $row['hora_fin'];
        ?>
            <tr>
                <td><?php echo $row['nombre_clase']; ?></td>  <!--Table data, represeunta una celda de datos en una tabla-->
                <td><?php echo $row['profesor']; ?></td>
                <td><?php echo $row['hora_inicio']; ?></td>
                <td><?php echo $row['hora_fin']; ?></td>
                <td><?php echo $cupos_disponibles; ?></td>
                <td>
                    <?php if ($cupos_disponibles > 0 && !$clase_pasada) { ?>
                        <form action="php/reservar_clase.php" method="POST">
                            <input type="hidden" name="clase_id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Reservar</button>
                        </form>
                    <?php } else { ?>
                        <button disabled>No Disponible</button>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>