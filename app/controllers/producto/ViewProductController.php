<?php
    require_once("app/db/usuario/ConfigDB.php");
    require_once("app/db/Conexion.php");
    require_once("app/models/producto/ProductModel.php");

    $producto = new ProductModel(ConfigDB::$host, ConfigDB::$user, ConfigDB::$pass, ConfigDB::$nameDb);
    $id = $_GET["id_producto"];
    $datosProducto = $producto->getProducto($id);
    
    if(!empty($datosProducto)){
        require_once("app/views/producto/ViewProduct.view");
    }else{
        header("Location:index.php");
    }
    
?>