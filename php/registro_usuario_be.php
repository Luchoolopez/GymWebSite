<?php

    include 'conexion_horarios_be.php';

    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $contrasenia = hash('sha512', $contrasenia); //contrasena encriptada 

    $query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasenia) 
              VALUES ('$nombre_completo', '$correo', '$usuario', '$contrasenia')";

    //Verifica que el correo no se repita en la Base de Datos
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo' ");
    if(mysqli_num_rows($verificar_correo) > 0)
    {
        echo '
            <script>
                alert("Este correo ya esta registrado, intente con otro diferente");
                window.location = "../Login.php";
            </script>
        ';
        exit();
    }

    //Verifica que usuario no se repita en la Base de Datos
    $vericar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");
    if(mysqli_num_rows($vericar_usuario) > 0 )
    {
        echo '
        <script>
            alert("Este usuario ya esta registrado, intente con otro diferente");
            window.location = "../Login.php";
        </script>
        ';
        exit();
    }

    //ejecutar query
    $ejecutar = mysqli_query($conexion, $query);

        if($ejecutar){
            echo '
                <script>
                    alert("Usuario almacenado exitosamente");
                    window.location = "../Login.php";
                </script>
            ';
        }else{
            echo '
            <script>
                alert("Intentalo de nuevo, usuario no almacenado");
                window.location = "../Login.php";
            </script>
        '; 
        }

        mysqli_close($conexion);
?>