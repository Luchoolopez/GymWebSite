<?php
include 'conexion_horarios_be.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre_clase = $_POST['nombre_clase'];
    $profesor = $_POST['profesor'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $cupo = $_POST['cupo'];

    if (empty($id)) {
        // Insertar nueva clase
        $query = "INSERT INTO horarios(nombre_clase, profesor, hora_inicio, hora_fin, cupo) 
                  VALUES ('$nombre_clase', '$profesor', '$hora_inicio', '$hora_fin', '$cupo')";
    } else {
        // Actualizar clase existente
        $query = "UPDATE horarios SET nombre_clase='$nombre_clase', profesor='$profesor', hora_inicio='$hora_inicio', hora_fin='$hora_fin', cupo='$cupo' WHERE id='$id'";
    }

    if ($conexion->query($query) === TRUE) {
        echo "
        <script>
            alert('Clase actualizada correctamente'); window.location='../Panel_de_control.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Error al actualizar la clase'); window.location='../Panel_de_control.php';
        </script>
        ";
    }

    $conexion->close();
}
?>
