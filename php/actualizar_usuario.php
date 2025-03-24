<?php
session_start();
include 'conexion_horarios_be.php';

// Verificar si el usuario es dueño
if ($_SESSION['rol'] !== 'dueño') {
    echo "
    <script>
        alert('Acceso denegado');
        window.location = '../Login.php';
    </script>
    ";
    session_destroy();
    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $rol = $_POST['rol'];

    $query = "UPDATE usuarios SET rol='$rol' WHERE id='$id'";
    if ($conexion->query($query) === TRUE) {
        echo "
        <script>
            alert('Usuario actualizado correctamente'); window.location='../Panel_de_control.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Error al actualizar el usuario'); window.location='../Panel_de_control.php';
        </script>
        ";
    }

    $conexion->close();
}
?>