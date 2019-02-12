<?php
    class CarritoModel extends ProductModel{

        function __construct($host, $user, $pass, $nameDb){
            parent::__construct($host, $user, $pass, $nameDb);
        }

        function getIdsProductos(){
            $idsProductos = [];
            if (isset($_COOKIE['musicstore'])) {
                foreach ($_COOKIE['musicstore'] as $value){
                    array_push($idsProductos, $value);
                
                }
            }
            return $idsProductos;
        }

        function crearCookie($id){
            setcookie("musicstore[$id]", "$id", time() + 3600);
        }

        function eliminarCookie($id){
            setcookie("musicstore[$id]", "$id", time() - 3600);
        }
    }
?>