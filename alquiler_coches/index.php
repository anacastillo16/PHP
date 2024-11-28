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
    <form action="?" method="get">
        <div id="buscador">
            <label>Buscar por modelo:</label>
            <select name="modelos" class="buscar">
                <?php
                    require_once('clases.php');
                    require_once('funciones.php');
                    $listadoModelos = obtenerModelos();
                    foreach ($listadoModelos as $modelos) {
                        echo "<option></option>";
                        echo "<option>{$modelos->getNombre()}</option>";
                    }
                ?>
            </select>
            <label>Buscar por color:</label>
            <select name="colores" class="buscar">
                <?php
                    require_once('clases.php');
                    require_once('funciones.php');
                    $listadoColores = obtenerColores();
                    foreach ($listadoColores as $colores) {
                        echo "<option></option>";
                        echo "<option>{$colores->getNombre()}</option>";
                    }
                ?>
            </select>
            <label>Precio máximo a pagar por día: </label>
            <input type="number" name="precio" class="buscar">
            <input type="submit" value="Buscar" id="boton">
        </div>
            <?php 
                require_once('clases.php');
                require_once('funciones.php');
                listarCoches();
            ?>
        </div>
    </form>
</body>
</html>