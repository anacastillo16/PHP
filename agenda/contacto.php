<?php
    class Contacto {
        private $id;
        private $nombre;
        private $apellido;
        private $telefono;
        private $foto;
        private $id_usuario;

        public function __construct($id, $nombre, $apellido, $telefono, $foto, $id_usuario) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->telefono = $telefono;
            $this->foto = $foto;
            $this->id_usuario = $id_usuario;
        }

        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getApellido(){
            return $this->apellido;
        }

        public function getTelefono(){
            return $this->telefono;
        }

        public function getFoto(){
            return $this->foto;
        }

        public function getId_Usuario(){
            return $this->id_usuario;
        }
    }

