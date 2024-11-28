<?php
    require_once('usuario.php');
    require_once('funcionesUsuario.php');
    require_once('funcionesContactos.php');

    session_start();

    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
        exit;
    }

    $id_usuario = $_SESSION['usuario']->getId();
    $nombreBuscado = isset($_GET['nombre']) ? trim($_GET['nombre']) : '';

    $contactos = obtenerContactos($id_usuario, $nombreBuscado);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['phone'];
        $foto = $_FILES['foto'];

        if (!empty($nombre) && !empty($apellido) && !empty($telefono) && !empty($foto)) {
            crearContacto($nombre, $apellido, $telefono, $foto, $id_usuario);
            header('Location: index.php'); 
            exit;
        } else {
            echo "<p id='error'>Error.</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Agenda</h1>
        <?php if (isset($_SESSION['usuario'])): ?>
            <a href="login.php"><img src="<?= $_SESSION['usuario']->getFoto() ?>" alt="Avatar"></a>
        <?php endif; ?>
    </header>

    <main>
        <div id="menu">
            <label for="nombre">Buscar por nombre:</label>
            <form action="index.php" method="get" id="formINDEX">
                <input type="text" name="nombre" id="nombre" class="inputINDEX" placeholder="Escribe un nombre"
                    value="<?= htmlspecialchars($nombreBuscado) ?>">
                <input type="submit" value="Buscar" class="inputINDEX">
            </form>
        </div>

        <p id="pMain">Lista de Contactos:</p>
        <button onclick="document.getElementById('crearContacto').showModal()">Crear Contacto</button>
        <a href="index.php" class="botonTodos">Mostrar todos los contactos</a>
        <dialog id="crearContacto">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="apellido" placeholder="Apellido" required>
                <input type="tel" name="phone" placeholder="Teléfono" required>
                <label for="foto">Foto:</label>
                <input type="file" name="foto" required>
                <input type="submit" value="Crear">
            </form>
        </dialog>

        <?php if (empty($contactos)): ?>
            <p>No se encontraron contactos.</p>
        <?php else: ?>
            <?php foreach ($contactos as $contacto): ?>
                <article>
                    <p><?= htmlspecialchars($contacto->getNombre()) ?></p>
                    <a href="detalleContacto.php?id=<?= $contacto->getId() ?>">Ver detalles</a>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>

    <footer>
        <p>Ana Castillo Ramírez</p>
    </footer>
</body>

</html>