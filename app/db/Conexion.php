<?php
    class Conexion{

        private $conexion;

        function __construct($host, $user, $pass, $nameDb){
            $this->conexion = new mysqli($host, $user, $pass, $nameDb);
            
            if($this->conexion->connect_error){
                die('Error('.$conexion->connect_errno.')'.$conexion->connect_error);
            }
        }

        function getConexion(){
            return $this->conexion;
        }

        function cerrarConexion(){
            $this->conexion->close();
        }
        
    }
?>