<?php
    function conexionBD() {
        $host = 'localhost';
        $basededatos = 'agenda';
        $usuario = 'root';
        $password= '';

        $conexion = new mysqli($host, $usuario, $password, $basededatos);

        if ($conexion->connect_error) {
            die('Todo ha ido mal');
        }

        return $conexion;
    }