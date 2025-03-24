<?php

    session_start();

    include 'conexion_horarios_be.php';

    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
    $contrasenia = hash('sha512', $contrasenia);

    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' 
    AND contrasenia='$contrasenia'");

    if(mysqli_num_rows($validar_login) > 0){
        $datos_usuario = mysqli_fetch_assoc($validar_login);
        $_SESSION['usuario'] = $correo;
        $_SESSION['rol'] = $datos_usuario['rol'];
        header("location: ../index.php");
        exit;
    }else{
        echo'
        <script>
            alert("Usuario no existe, por favor verifique los datos introducidos");
            window.location = "../Login.php";
        </script>
        ';
        exit;
    }

?>