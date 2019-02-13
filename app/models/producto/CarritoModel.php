<?php
    class CarritoModel extends ProductModel{

        function __construct($host, $user, $pass, $nameDb){
            parent::__construct($host, $user, $pass, $nameDb);
        }

        function getCestaProductos(){
            $idsProductos = [];
            
            if (isset($_SESSION['cesta'])) {
                $idsProductos = $_SESSION['cesta'];
            }
            return $idsProductos;
        }

        /**
         * En la cesta solo se guarda la id como key
         * y un valor que indica la cantidad
         * */

        function guardarEnLaCesta($id){
            $cantidad = 1;
            
            if(isset($_SESSION['cesta']["$id"])){
                $_SESSION['cesta']["$id"]++;
            }else{
                $_SESSION['cesta']["$id"] = $cantidad;
            }
            
        }

        function eliminarDeLaCesta($id){
            unset($_SESSION['cesta']["$id"]);
        }
    }
?>