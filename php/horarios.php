<?php
include 'php/conexion_horarios_be.php';

$consulta = "SELECT * FROM horarios";
$resultado = mysqli_query($conexion, $consulta);

while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<div class='clase'>";
    echo "<h3>{$fila['nombre_clase']}</h3>";
    echo "<p>Profesor: {$fila['profesor']}</p>";
    echo "<p>Hora: {$fila['hora_inicio']} - {$fila['hora_fin']}</p>";
    echo "<p>Cupo: {$fila['cupo']}</p>";

    if ($fila['cupo'] > 0) {
        echo "<a href='reservar_clase.php?id={$fila['id']}' class='boton'>Reservar</a>";
    } else {
        echo "<p class='agotado'>Cupo lleno</p>";
    }

    echo "</div>";
}
?>
