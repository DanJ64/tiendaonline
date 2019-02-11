<?php
    //MODELOS
    require_once("app/db/usuario/ConfigDB.php");
    require_once("app/db/Conexion.php");
    require_once("app/models/producto/ProductModel.php");
// POR TERMINAR: CAMBIAR DATOS A PRODUCTOS
    if($_SESSION['user']['rol']== "admin"){
        $id_producto = $_GET["id_producto"];

        $eliminado = false;

        $conection = new ProductModel(ConfigDB::$host, ConfigDB::$user, ConfigDB::$pass, ConfigDB::$nameDb);



        if($conection->eliminarProducto($id_producto)){

            $eliminado = true;
        }
        
        $conection->cerrarConexion();

        //REVISAR
        if($eliminado){
            $mensaje = 'Se ha eliminado con éxito. Por favor, <a href="index.php?ctl=login">inicie sesión.</a>';
        }else{
            $mensaje = "Error: No se ha podido eliminar. Por favor, inténtelo de nuevo";
        }

        //Vista
        unset($_POST);
        header("Location: index.php");

        echo $mensaje;
    }else{
        header("Location: index.php");
    }
?>