<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Contacto</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Agenda</h1>
        <a href="index.php" class="volver">Volver al índice</a>
        <?php
            require_once('usuario.php');
            require_once('funcionesUsuario.php');
            require_once('funcionesContactos.php');
            session_start();

            if (isset($_SESSION['usuario'])) {
                echo "<a href='login.php'><img src ={$_SESSION['usuario']->getFoto()} alt='foto'> </a>";
            }
        ?>
    </header>
    <main>
        <?php
            require_once('funcionesContactos.php');
            require_once('funcionesMensajes.php');

            if (!isset($_GET['id'])) {
                echo "<p>Error: No se proporcionó un ID de contacto.</p>";
                exit;
            }

            $id_contacto = $_GET['id'];
            $contacto = obtenerContactoPorId($id_contacto);

            if (!$contacto) {
                echo "<p>Error: Contacto no encontrado.</p>";
                exit;
            }
        ?>
        <p id="mensajes">CONTACTO:</p>
        <article>
            <img src="<?= $contacto->getFoto() ?>" alt="Foto de <?= $contacto->getNombre() ?>" />
            <p><strong>Nombre:</strong> <?= $contacto->getNombre() ?></p>
            <p><strong>Apellido:</strong> <?= $contacto->getApellido() ?></p>
            <p><strong>Teléfono:</strong> <?= $contacto->getTelefono() ?></p>
        </article>

        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mensaje'])) {
                $mensaje = $_POST['mensaje'];
                crearMensaje($mensaje, $id_contacto);
            }

            $mensajes = obtenerMensajes($id_contacto);

            echo "<p id='mensajes'>MENSAJES RECIBIDOS: </p>";
            foreach ($mensajes as $mensaje) {
                echo "<article>";
                echo "<p><strong>Fecha:</strong> {$mensaje->getFecha_Envio()}</p>";
                echo "<p>{$mensaje->getTexto()}</p>";
                echo "</article>";
            }
        ?>
        <p id="mensajes">ENVIAR MENSAJE NUEVO: </p>
        <form action="" method="post" id="formDETALLES">
            <textarea name="mensaje" placeholder="Escriba su mensaje" class="inputDETALLES" required></textarea>
            <input type="submit" value="Enviar Mensaje" class="inputDETALLES">
        </form>
    </main>
    <footer>
        <p>Ana Castillo Ramírez</p>
    </footer>
</body>

</html>