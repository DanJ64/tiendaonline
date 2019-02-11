<?php

    if(!empty($_SESSION['user'])){

        require_once("app/db/usuario/ConfigDB.php");
        require_once("app/db/Conexion.php");
        require_once("app/models/usuario/UserModel.php");

        $usuario = new UserModel(ConfigDB::$host, ConfigDB::$user, ConfigDB::$pass, ConfigDB::$nameDb);

        $oldEmail = $_SESSION["user"]["correo"];
        $oldPasswd= $_SESSION["user"]["passwd"];

        //MEJORAR ESTE BLOQUE
        if(isset($_POST["editar_usuario"])){

            $nuevosDatos = array();

            foreach($_POST as $key=>$value){
                if($value != "editar_usuario"){
                    $nuevosDatos[$key] = $value;
                }
            }

            if($usuario->editarDatos($oldEmail, $oldPasswd, $nuevosDatos)){
                //pasar los datos a la variable $_SESSION
                $newEmail = $nuevosDatos["correo"];
                $newPasswd = $nuevosDatos["passwd"];
                $datosUsuario = $usuario->getUsuario($newEmail, $newPasswd);
                
                $_SESSION['user']=$datosUsuario;

                $usuario->cerrarConexion();
            }

            //header("Location: VerUsuarioController.php");
            header("Location: index.php?ctl=perfil");

        }else{
            //CARGAR VISTA
            require_once("app/views/usuario/EditUser.view");
        }
        $usuario->cerrarConexion();
    }else{
        header("Location: index.php?ctl=login");
    }
?>