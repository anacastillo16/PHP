<?php 
    require_once('clases.php');
    function obtenerModelos() {
        return [
            new Modelo("Toyota Corolla"),  
            new Modelo("Honda Civic"),  
            new Modelo("Ford Focus"),  
            new Modelo("Chevrolet Spark"),  
            new Modelo("Nissan Sentra"),  
            new Modelo("Volkswagen Golf"),  
            new Modelo("Hyundai Elantra"),  
            new Modelo("Kia Forte"),  
            new Modelo("Subaru Impreza"),  
            new Modelo("Mazda 3")
        ];
    }

    function obtenerColores() {
        return [
            new Color("Blanco"),
            new Color("Negro"),
            new Color("Gris"),
            new Color("Naranja"),
            new Color("Morado")
        ];
    }

    function obetenerCoches(){
        $modelo = obtenerModelos();
        $color = obtenerColores();
        return [
            new Coche("<img src='img/tc.jpeg'>", $modelo[0], $color[0], 50),
            new Coche("<img src='img/hc.jpeg'>", $modelo[1], $color[1], 55),
            new Coche("<img src='img/ff.jpeg'>", $modelo[2], $color[2], 52),
            new Coche("<img src='img/cs.jpeg'>", $modelo[3], $color[0], 40),
            new Coche("<img src='img/ns.jpeg'>", $modelo[4], $color[2], 45),
            new Coche("<img src='img/vg.jpeg'>", $modelo[5], $color[2], 60),
            new Coche("<img src='img/he.jpeg'>", $modelo[6], $color[1], 48),
            new Coche("<img src='img/kf.jpeg'>", $modelo[7], $color[2], 42),
            new Coche("<img src='img/si.jpeg'>", $modelo[8], $color[3], 120),
            new Coche("<img src='img/m3.jpeg'>", $modelo[9], $color[4], 150)
        ];
    }

    function listarCoches(){
        $listado = obetenerCoches();

        $modeloIntroducido = $_GET['modelos'];
        $colorIntroducido = $_GET['colores'];
        $precioIntroducido = $_GET['precio'];

        echo "<p class='parrafo'>Vehículos disponibles:</p>
            <section id='lista'>";

        foreach ($listado as $coches) {
            $cumpleFiltroModelo = empty($modeloIntroducido) || $modeloIntroducido == $coches->getModelo()->getNombre();
            $cumpleFiltroColor = empty($colorIntroducido) || $colorIntroducido == $coches->getColor()->getNombre();
            $cumpleFiltroPrecio = empty($precioIntroducido) || $precioIntroducido >= $coches->getPrecio();
            if ($cumpleFiltroModelo && $cumpleFiltroColor && $cumpleFiltroPrecio) {
                    echo "<article id='coches'> 
                        <p>{$coches->getImagen()}</p>
                        <p>{$coches->getModelo()->getNombre()}</p>
                        <p>{$coches->getColor()->getNombre()}</p>
                        <p>{$coches->getPrecio()}</p>
                        <p><a href='alquilarCoche.php?modelo={$coches->getModelo()->getNombre()}'>
                        <input type='button' value='Alquilar' id='botonAlquilar'></a></p>
                    </article>";
            }
        }
        echo "</section>";
    }

    $dias = $_POST['dias'];    
    function listarCocheAlquilar($modelo, $dias) {
        $listado = obetenerCoches();
        echo "<section id='lista'>";
        foreach ($listado as $coches) {
    
            if ($modelo == $coches->getModelo()->getNombre()){
                    echo "<article id='coches'>
                    <p>{$coches->getImagen()}</p>
                    <p>{$coches->getModelo()->getNombre()}</p>
                    <p>{$coches->getColor()->getNombre()}</p>
                    <p>{$coches->getPrecio()}</p>
                </article>";
                echo "<form action='#' method='post'>
                        <label for='dias' id='parrafo2'>Indique la cantidad de días que va a alquilar el coche:</label>
                        <input type='number' name='dias' id='dias'>
                        <input type='submit' value='Confirmar Reserva'>
                    </form>
                    
                </section>";
                $total = $dias * $coches->getPrecio();
                if (!empty($dias)) {
                    echo "<p id='total'>Total a pagar: {$total}</p>";
                }
            }
            
        }
    }