<?php
    //MODELOS
    require_once("app/db/usuario/ConfigDB.php");
    require_once("app/db/Conexion.php");
    require_once("app/models/usuario/UserModel.php");

    $correo = $_POST["correo"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $fechaNacimiento = $_POST["fechaNacimiento"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $pass = $_POST["pass"];
    $rol = "user"; //por defecto

    $existeUsuario = false;
    $registrado = false;

    $conectionUser = new UserModel(ConfigDB::$host, ConfigDB::$user, ConfigDB::$pass, ConfigDB::$nameDb);

    //Comprobacion de existencia de usuario
    if(!$conectionUser->setUsuario($correo, $nombre, $apellidos, $fechaNacimiento, $telefono, $direccion, $pass, $rol)){
        $existeUsuario = true;
    }else{
        $registrado = true;
    }
    $conectionUser->cerrarConexion();

    //Preparacion de mensaje para la vista
    if($registrado){
        $mensaje = 'Se ha registrado con éxito. Por favor, <a href="index.php?ctl=login">inicie sesión.</a>';
    }else if($existeUsuario){
        $mensaje = 'Usuario ya existe. Por favor, <a href="index.php?ctl=login">inicie sesión.</a>';
    }else{
        $mensaje = "Error: No se ha podido registrar. Por favor, inténtelo de nuevo";
    }
    //Vista
    require_once("app/views/usuario/RegisterUser.view");
?>