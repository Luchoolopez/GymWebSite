<?php
    $conexion = mysqli_connect("localhost", "root", "", "horarios_db");

    /*if($conexion_horarios){
        echo 'Conectado exitosamente a la Base de datos';
    }else{
        echo 'no se ha podido conectar a la Base de Datos';
    }*/

    if(!$conexion){ 
        die("Conexion fallida: " . mysqli_connect_error());
    }
?>
