<?php
    //MODELOS
    require_once("app/db/usuario/ConfigDB.php");
    require_once("app/db/Conexion.php");
    require_once("app/models/usuario/UserModel.php");

    $correo = $_SESSION["user"]["correo"];
    $pass = $_SESSION["user"]["passwd"];

    $eliminado = false;

    $conectionUser = new UserModel(ConfigDB::$host, ConfigDB::$user, ConfigDB::$pass, ConfigDB::$nameDb);

    if($conectionUser->delUsuario($correo, $pass)){
        $eliminado = true;
    }
    
    $conectionUser->cerrarConexion();

    if($eliminado){
        $mensaje = 'Se ha eliminado con éxito. Por favor, <a href="index.php?ctl=login">inicie sesión.</a>';
    }else{
        $mensaje = "Error: No se ha podido eliminar. Por favor, inténtelo de nuevo";
    }
    //Vista
    //require_once("app/views/usuario/EliminarUsuarioView.php");
    unset($_POST);
    header("Location: web/scripts/php/logout.php");

    echo $mensaje;
?>