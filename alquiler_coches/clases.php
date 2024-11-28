<?php 
    class Coche {
        private  $imagen;
        private $modelo;
        private $color;
        private $precio;

        public function __construct($imagen, $modelo, $color, $precio) {
            $this->imagen = $imagen;
            $this->modelo = $modelo;
            $this->color = $color;
            $this->precio = $precio;
        }

        public function getImagen() {
            return $this->imagen;
        }

        public function getModelo() {
            return $this->modelo;
        }

        public function getColor() {
            return $this->color;
        }

        public function getPrecio() {
            return $this->precio;
        }

    }

    class Modelo{
        private $nombre;

        public function __construct($nombre){
            $this->nombre = $nombre;
        }

        public function getNombre() {
            return $this->nombre;
        }
    }

    class Color{
        private $nombre;

        public function __construct($nombre){
            $this->nombre = $nombre;
        }

        public function getNombre() {
            return $this->nombre;
        }
    }

        