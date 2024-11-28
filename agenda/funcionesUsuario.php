<?php
    require_once('usuario.php');
    require_once('conexion.php');

    function registrarUsuario($telefono, $password, $foto) {
        $conexion = conexionBD();

        $sqlVerificarTelefono = "SELECT * FROM Usuarios WHERE telefono = ?";
        $queryVerificarTelefono = $conexion->prepare($sqlVerificarTelefono);
        $queryVerificarTelefono->bind_param('i', $telefono); 
        $queryVerificarTelefono->execute();
        $resultado = $queryVerificarTelefono->get_result();
    
        if ($resultado->num_rows > 0) {
            $conexion->close();
            return false; 
        }
    

        $nombreArchivo = $foto['name'];
        $fotoTMP = $foto['tmp_name'];
        $rutaFoto = "img/$nombreArchivo";
        $seHaGuardado = move_uploaded_file($fotoTMP, $rutaFoto);

        if ($seHaGuardado) {
            $sql = "INSERT INTO Usuarios (telefono, contraseña, foto) VALUES (?, ?, ?)";
            $queryFormateada = $conexion->prepare($sql);
            $queryFormateada-> bind_param('iss', $telefono, $password, $rutaFoto);
            $seHaEjecutadoLaQuery = $queryFormateada->execute();
            $conexion->close();
            return $seHaEjecutadoLaQuery;

            if ($telefono)  {
                echo "Error, ya se está usando ese teléfono.";
            }
        } 

        $conexion->close();
        return false;
    }
    
    function login($telefono, $password) {
        $conexion = conexionBD();

        $sql = "SELECT * FROM Usuarios WHERE telefono = ? AND contraseña = ?";
        $queryFormateada = $conexion->prepare($sql);
        $queryFormateada->bind_param('is', $telefono, $password);
        $seHaEjecutadoLaQuery = $queryFormateada->execute();

        $resultadoLogin = $queryFormateada->get_result();

        if ($resultadoLogin->num_rows == 1) {
            $usuarioBD = $resultadoLogin->fetch_assoc();
            $conexion->close();
            $usuario = new Usuario($usuarioBD['id'], $usuarioBD['telefono'], $usuarioBD['contraseña'], $usuarioBD['foto']);
            return $usuario;
        }

        $conexion->close();
        return false;
    }   