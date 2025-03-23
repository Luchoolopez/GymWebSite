<?php
session_start();
include 'conexion_horarios_be.php';

// Verificar si la conexión se ha establecido correctamente
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar si el usuario está logueado y tiene un ID de usuario
if (!isset($_SESSION['usuario_id'])) {
    die("Error: Usuario no logueado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clase_id = $_POST['clase_id'];
    $usuario_id = $_SESSION['usuario_id']; // Asumiendo que el ID del usuario está almacenado en la sesión

    // Verificar cupos disponibles
    $query_reservas = "SELECT COUNT(*) as total_reservas FROM reservas WHERE clase_id='$clase_id'";
    $result_reservas = $conexion->query($query_reservas);
    $total_reservas = mysqli_fetch_assoc($result_reservas)['total_reservas'];

    $query_clase = "SELECT * FROM horarios WHERE id='$clase_id'";
    $result_clase = $conexion->query($query_clase);
    $clase = mysqli_fetch_assoc($result_clase);

    $cupos_disponibles = $clase['cupo'] - $total_reservas;

    // Verificar si la clase ya pasó
    $hora_actual = date('H:i');
    $clase_pasada = $hora_actual > $clase['hora_fin'];

    if ($cupos_disponibles > 0 && !$clase_pasada) {
        // Insertar reserva
        $query_reserva = "INSERT INTO reservas (clase_id, usuario_id) VALUES ('$clase_id', '$usuario_id')";
        if ($conexion->query($query_reserva) === TRUE) {
            echo "
            <script>
                alert('Reserva realizada correctamente'); window.location='../Clases.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Error al realizar la reserva'); window.location='../Clases.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
            alert('No hay cupos disponibles o la clase ya pasó'); window.location='../Clases.php';
        </script>
        ";
    }

    $conexion->close();
}
?>