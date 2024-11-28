<?php
    require_once('contacto.php');
    require_once('conexion.php');

    function crearContacto($nombre, $apellido, $telefono, $foto, $id_usuario) {
            $conexion = conexionBD();
            $nombreArchivo = $foto['name'];
            $fotoTMP = $foto['tmp_name'];
            $rutaFoto = "img/$nombreArchivo";
            $seHaGuardado = move_uploaded_file($fotoTMP, $rutaFoto);
    
            if ($seHaGuardado) {
                $sql = "INSERT INTO Contactos (nombre, apellido, telefono, foto, id_usuario) VALUES (?, ?, ?, ?, ?)";
                $queryFormateada = $conexion->prepare($sql);
                $queryFormateada-> bind_param('ssisi', $nombre, $apellido, $telefono, $rutaFoto, $id_usuario);
                $seHaEjecutadoLaQuery = $queryFormateada->execute();
                $conexion->close();
                return $seHaEjecutadoLaQuery;
            } 
    
            $conexion->close();
            return false;
    }

    function obtenerContactos($id_usuario, $nombre = '') {
        $conexion = conexionBD();
    
        if (!empty($nombre)) {
            $nombre = '%' . $nombre . '%';
            $sql = "SELECT * FROM Contactos WHERE id_usuario = ? AND nombre LIKE ?";
            $queryFormateada = $conexion->prepare($sql);
            $queryFormateada->bind_param('is', $id_usuario, $nombre);
        } else {
            $sql = "SELECT * FROM Contactos WHERE id_usuario = ?";
            $queryFormateada = $conexion->prepare($sql);
            $queryFormateada->bind_param('i', $id_usuario);
        }
    
        $queryFormateada->execute();
        $resultado = $queryFormateada->get_result();
    
        $contactos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $contactos[] = new Contacto($fila['id'], $fila['nombre'], $fila['apellido'], $fila['telefono'], $fila['foto'], $fila['id_usuario']);
        }
    
        $conexion->close();
        return $contactos;
    }

    function obtenerContactoPorId($id_contacto) {
        $conexion = conexionBD();
    
        $sql = "SELECT * FROM Contactos WHERE id = ?";
        $queryFormateada = $conexion->prepare($sql);
        $queryFormateada->bind_param('i', $id_contacto);
        $queryFormateada->execute();
        $resultado = $queryFormateada->get_result();
    
        $contacto = null;
        if ($fila = $resultado->fetch_assoc()) {
            $contacto = new Contacto($fila['id'], $fila['nombre'], $fila['apellido'], $fila['telefono'], $fila['foto'], $fila['id_usuario']);
        }
    
        $conexion->close();
        return $contacto;
    }