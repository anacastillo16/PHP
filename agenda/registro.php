<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        require_once('funcionesUsuario.php');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $phone = $_POST['phone'];
                $password = $_POST['password'];
                $foto = $_FILES['foto'];
                $registro = registrarUsuario($phone, $password, $foto);

                if($registro) {
                    header('Location:login.php');
                } else if ($registro == false) {
                    echo "<p id='error'>El número de teléfono ya está en uso.</p>";
                } else {
                    echo "<p id='error'>Error</p>";
                }
        }
    ?> 
    
    <header>
        <h1>Agenda</h1>
    </header>

    <h2>Nuevo Usuario</h2>

    <form action="" method="post" enctype="multipart/form-data" id="formREGISTRO">
        <input type="tel" name="phone" id="phone" placeholder="Número telefónico" class="inputREGISTRO">
        <input type="password" name="password" id="password" placeholder="Contraseña" class="inputREGISTRO">

        <label for="foto">Introduce la foto de perfil: </label>
        <input type="file" name="foto" accept="image/*" id="foto" required class="inputREGISTRO">

        <input type="submit" name="guardar" value="Guardar Usuario" class="inputREGISTRO">
    </form>

    <footer>
        <p>Ana Castillo Ramírez</p>
    </footer>
</body>
</html>