<?php

    require_once("app/db/producto/ConfigDB.php");
    require_once("app/db/Conexion.php");
    require_once("app/models/producto/ProductModel.php");
    require_once("app/models/producto/CarritoModel.php");

    $cesta = new CarritoModel(ConfigDB::$host, ConfigDB::$user, ConfigDB::$pass, ConfigDB::$nameDb);
    $productos = [];
    /**
         * Recojo el id y la cantidad de la cesta
         * Despues al array productos le paso el producto buscado por la id y 
         * la cantidad recogida de la cesta 
         * por lo tanto me queda el rray con el producto y la cantidad
         * */

    if(isset($_GET['ctl'])){

        if($_GET['ctl'] == "car"){
            $datosCesta = $cesta->getCestaProductos();
            
            if(!empty($datosCesta)){
                foreach($datosCesta as $key => $value){
                    $productos[$key] = $cesta->getProducto($key);
                    $precio = 0;

                    if($productos[$key]["formato"] != "Digital"){
                        if($value <= CarritoModel::CANTIDAD_MAXIMA){
                            $precio = $value;
                        }else{
                            $precio = CarritoModel::CANTIDAD_MAXIMA;
                        }
                    }else{
                        $precio = 1;
                    }
                    $productos[$key]["cantidad"] = $precio;
                    $productos[$key]["precio"] *= $precio;
                }
            }

        }else if ($_GET['ctl'] == "add_to_car"){
            $cesta->guardarEnLaCesta($_GET['id_producto']);
            header("Location: index.php?ctl=ver_producto&id_producto=".$_GET['id_producto']);

        }else if ($_GET['ctl'] == "delUnit"){
            $cesta->eliminarUnidad($_GET['id_producto']);
            header("Location: index.php?ctl=car");

        }else if ($_GET['ctl'] == "addUnit"){
            $cesta->agregarUnidad($_GET['id_producto']);
            header("Location: index.php?ctl=car");
        }
    }

    
    if(isset($_GET['delItem'])){
        $cesta->eliminarDeLaCesta($_GET['delItem']);
        header("Location: index.php?ctl=car");
    }

    require_once("app/views/producto/Cesta.view");
?>