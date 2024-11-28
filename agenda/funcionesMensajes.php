<?php
    require_once('conexion.php');
    require_once('mensaje.php');

    function crearMensaje($texto, $id_contacto) {
        $conexion = conexionBD();
        $miFecha = date('Y-m-d H:i:s'); 
    
        $sql = "INSERT INTO Mensajes (texto, fecha_envio, id_contacto) VALUES (?, ?, ?)";
        $queryFormateada = $conexion->prepare($sql);
        $queryFormateada->bind_param('ssi', $texto, $miFecha, $id_contacto);
    
        $resultado = $queryFormateada->execute();
        $conexion->close();
    
        return $resultado;
    }

    function obtenerMensajes($id_contacto) {
        $conexion = conexionBD();
    
        $sql = "SELECT * FROM Mensajes WHERE id_contacto = ? ORDER BY fecha_envio ASC";
        $queryFormateada = $conexion->prepare($sql);
        $queryFormateada->bind_param('i', $id_contacto);
    
        $queryFormateada->execute();
        $resultado = $queryFormateada->get_result();
    
        $mensajes = [];
        while ($fila = $resultado->fetch_assoc()) {
            $mensajes[] = new Mensaje($fila['id'], $fila['texto'], $fila['fecha_envio'], $fila['id_contacto']);
        }
    
        $conexion->close();
        return $mensajes;
    }