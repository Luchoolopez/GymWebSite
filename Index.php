<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
        echo '
            <script>
                alert("Por favor debes iniciar sesion");
                window.location = "Login.php";
            </script>
        ';
        session_destroy();
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gimnasio - Inicio</title>
    <link rel="stylesheet" href="/gymwebsite/assets/css/style.css">
</head> 
<body>
    <header>
        <h1>Bienvenido al Gimnasio</h1>
    </header>
    <main>
        <ul class="elementos">
        <a href=""><img src="assets/images/membresia.png" class="imagen_membresia">membresia</a>
        <a href="Clases.php"><img src="assets\images\reservar.png" class="reservar_clase">Reservar Clase</a>
        <a href="Panel_de_control.php"><img src="assets\images\progreso.png" class="admin_panel">mi progreso</a>
        <a href="php/cerrar_sesion.php"><img src="assets\images\logout.png" class="cerrar_sesio">Cerrar Sesión</a>
        </ul>

    </main>
</body>
</html>
