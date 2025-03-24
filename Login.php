<?php
session_start();
include 'php/conexion_horarios_be.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];

    $query = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasenia='$contrasenia'";
    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['rol'] = $user['rol'];

        if ($user['rol'] === 'dueño' || $user['rol'] === 'trabajador') {
            header('Location: Panel_de_control.php');
        } else {
            header('Location: Clases.php');
        }
    } else {
        echo "
        <script>
            alert('Usuario o contraseña incorrectos');
            window.location = 'Login.php';
        </script>
        ";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym WebSite</title>
    
    <link rel="stylesheet" href="assets/css/LoginStyles.css">
</head>
<body>
        <main>
            <div class="contenedor__todo">
                <div class="caja__trasera">
                    <div class="caja__trasera-login">
                        <h3>¿Ya tienes una cuenta?</h3>
                        <p>Inicia sesión para entrar en la página</p>
                        <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                    </div>
                    <div class="caja__trasera-register">
                        <h3>¿Aún no tienes una cuenta?</h3>
                        <p>Regístrate para que puedas iniciar sesión</p>
                        <button id="btn__registrarse">Regístrarse</button>
                    </div>
                </div>

                <!--Formulario de Login y registro-->
                <div class="contenedor__login-register">
                    <!--Login-->
                    <form action="php/login_usuario_be.php" method="POST" class="formulario__login">
                        <h2>Iniciar Sesión</h2>
                        <input type="text" placeholder="Correo Electronico" name="correo">
                        <input type="password" placeholder="Contraseña" name="contrasenia">
                        <button>Entrar</button>
                    </form>

                    <!--Register-->
                    <form action="php/registro_usuario_be.php" method="POST" class="formulario__register">
                        <h2>Regístrarse</h2>
                        <input type="text" placeholder="Nombre completo" name = "nombre_completo" required>
                        <input type="text" placeholder="Correo Electronico" name = "correo" required>
                        <input type="text" placeholder="Usuario" name = "usuario" required>
                        <input type="password" placeholder="Contraseña" name = "contrasenia" required>
                        <button>Regístrarse</button>
                    </form>
                </div>
            </div>

        </main>

        <script src="assets/js/LoginScript.js"></script>
</body>
</html>