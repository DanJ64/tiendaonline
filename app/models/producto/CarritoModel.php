<?php
    class CarritoModel extends ProductModel{

        const CANTIDAD_MAXIMA = 4;
        const CANTIDAD_MINIMA = 1;

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
            $cantidad = $this::CANTIDAD_MINIMA;
            
            if(isset($_SESSION['cesta']["$id"])){
                if($_SESSION['cesta']["$id"] < $this::CANTIDAD_MAXIMA){
                    $_SESSION['cesta']["$id"]++;
                }
            }else{
                $_SESSION['cesta']["$id"] = $cantidad;
            }
            
        }

        function agregarUnidad($id){
            
            if(isset($_SESSION['cesta']["$id"])){
                if($_SESSION['cesta']["$id"] < $this::CANTIDAD_MAXIMA){
                    $_SESSION['cesta']["$id"]++;
                }
                
            }
        }

        function eliminarUnidad($id){
            
            if(isset($_SESSION['cesta']["$id"])){
                if($_SESSION['cesta']["$id"] > $this::CANTIDAD_MINIMA){
                    $_SESSION['cesta']["$id"]--;
                }
            }
        }

        function eliminarDeLaCesta($id){
            unset($_SESSION['cesta']["$id"]);
        }
    }
?>