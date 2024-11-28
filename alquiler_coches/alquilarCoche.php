<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alquiler Coches</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>Alquiler de Vehículos</header>
    <p class="parrafo">Vehículo que va a alquilar: </p>
    <?php 
        require_once('clases.php');
        require_once('funciones.php');
        $modelo = $_GET['modelo'];
        listarCocheAlquilar($modelo, $dias);
    ?>
    
</body>
</html>