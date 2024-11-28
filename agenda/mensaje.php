<?php
    class Mensaje {
        private $id;
        private $texto;
        private $fecha_envio;
        private $id_contacto;

        public function __construct($id, $texto, $fecha_envio, $id_contacto) {
            $this->id = $id;
            $this->texto = $texto;
            $this->fecha_envio = $fecha_envio;
            $this->id_contacto = $id_contacto;
        }

        public function getId(){
            return $this->id;
        }

        public function getTexto(){
            return $this->texto;
        }

        public function getFecha_Envio(){
            return $this->fecha_envio;
        }

        public function getId_Contacto(){
            return $this->id_contacto;
        }
    }