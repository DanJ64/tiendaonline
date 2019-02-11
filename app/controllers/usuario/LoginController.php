<?php

    if(isset($_POST["login"])){
        require_once("app/db/usuario/ConfigDB.php");
        require_once("app/db/Conexion.php");
        require_once("app/models/usuario/UserModel.php");

        $correo = $_POST['correo'];
        $pass = $_POST['pass'];
        
        //modelo
        $login = new UserModel(ConfigDB::$host, ConfigDB::$user, ConfigDB::$pass, ConfigDB::$nameDb);

        $datosUsuario = $login->getUsuario($correo, $pass); 
        echo $login->cerrarConexion();
        $isLoged = false;

        //recoger los datos en la variable SESSION
        if(!empty($datosUsuario)){
            $isLoged = true;
            $_SESSION['user'] = $datosUsuario;
        }
        //Preparacion de la vista
        if(!$isLoged){
            $mensaje = 'Usuario o contraseña incorrectos. Por favor, compruebe los datos e <a href="index.php?ctl=login">inicie sesión.</a><br>
            Es posible que el usuario no exista, en ese caso <a href="index.php?ctl=registrar">regístrese.</a>';
        }else{
            $mensaje = 'Ha iniciado sesión<br><a href="index.php">Ir a inicio</a>';
        }
        require_once("app/views/usuario/UserMessage.php");
    }else{
        header("Location: index.php?ctl=login");
    }
    
?>