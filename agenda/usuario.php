<?php
    class Usuario {
        private $id;
        private $telefono;
        private $password;
        private $foto;
        
        function __construct($id, $telefono, $password, $foto) {
            $this->id = $id;
            $this->telefono = $telefono;
            $this->password = $password;
            $this->foto = $foto;
        }

        function getId() {
            return $this->id;
        }
        function getTelefono() {
            return $this->telefono;
        }

        function getPassword() {
            return $this->password;
        }

        public function getFoto(){
            return $this->foto;
        }
    }