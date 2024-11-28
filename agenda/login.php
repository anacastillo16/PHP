<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Agenda</h1>
    </header>

    <?php 
        require_once('funcionesUsuario.php');
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $phone = $_POST['phone'];
                $password = $_POST['password'];
                $usuario = login($phone, $password);

                if($usuario) {
                    $_SESSION['usuario'] = $usuario;
                    header('Location:index.php');
                } else {
                    echo "<p id='error'>Error</p>";
                }
        }
    ?>

    <h2>Formulario Login</h2>

    <form action="" method="post" id="formLOGIN">
        <input type="tel" name="phone" id="phone" placeholder="Número telefónico" class="inputLOGIN">
        <input type="password" name="password" id="password" placeholder="Contraseña" class="inputLOGIN">
        <input type="submit" value="Iniciar Sesión" class="inputLOGIN">
        <label for="nuevoUsuario">¿No tienes usuario?</label>
        <a href="registro.php" id="crear"> Crear usuario </a>
    </form>

    <footer>
        <p>Ana Castillo Ramírez</p>
    </footer>
    
</body>
</html>