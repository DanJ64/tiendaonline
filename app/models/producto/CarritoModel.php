<?php
    class CarritoModel {

        function __construct(){
            
        }

        function crearCookie($id){
            setcookie("musicstore[$id]", "$id");
        }

        function eliminarCookie($id){

        }
    }
?>