<?php

class UserControllerModel{
    
    private $conectionUser;

    function __construct(){
        $this->conectionUser = new UserModel(ConfigDB::$host, ConfigDB::$user, ConfigDB::$pass, ConfigDB::$nameDb);
    }

    function editarUsuario(){
        if(!empty($_SESSION['user'])){
    
            $oldEmail = $_SESSION["user"]["correo"];
            $oldPasswd= $_SESSION["user"]["passwd"];
    
            if(isset($_POST["editar_usuario"])){
    
                $nuevosDatos = array();
    
                foreach($_POST as $key=>$value){
                    if($value != "editar_usuario"){
                        $nuevosDatos[$key] = $value;
                    }
                }
    
                if($this->conectionUser->editarDatos($oldEmail, $oldPasswd, $nuevosDatos)){
                    //pasar los datos a la variable $_SESSION
                    $newEmail = $nuevosDatos["correo"];
                    $newPasswd = $nuevosDatos["passwd"];
                    $datosUsuario = $this->conectionUser->getUsuario($newEmail, $newPasswd);
                    
                    $_SESSION['user']=$datosUsuario;
    
                    $this->conectionUser->cerrarConexion();
                }
    
                //header("Location: VerUsuarioController.php");
                header("Location: index.php?ctl=perfil");
    
            }else{
                //CARGAR VISTA
                require_once("app/views/usuario/EditUser.view");
            }
            $this->conectionUser->cerrarConexion();
        }else{
            header("Location: web/content/forms/login.php");
        }
    }

    function verUsuario(){
        if(!empty($_SESSION['user'])){
            require_once("app/views/usuario/ViewUser.view");
        }else{
            header("Location:index.php");
        }
    }

    function registrarUsuario(){
        //MEJORAR CON UN BUCLE
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

        //Comprobacion de existencia de usuario
        if(!$this->conectionUser->setUsuario($correo, $nombre, $apellidos, $fechaNacimiento, $telefono, $direccion, $pass, $rol)){
            $existeUsuario = true;
        }else{
            $registrado = true;
        }
        $this->conectionUser->cerrarConexion();

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
    }

    function login(){
        
        if(isset($_POST["login"])){
            
            $correo = $_POST['correo'];
            $pass = $_POST['pass'];
            
            $datosUsuario = $this->conectionUser->getUsuario($correo, $pass); 
            $this->conectionUser->cerrarConexion();
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
            require_once("app/views/usuario/UserMessage.view");
        }else{
            header("Location: index.php?ctl=login");
        }
    }

    function eliminarUsuario(){
        $correo = $_SESSION["user"]["correo"];
        $pass = $_SESSION["user"]["passwd"];

        $eliminado = false;

        if($this->conectionUser->delUsuario($correo, $pass)){
            $eliminado = true;
        }
        
        $this->conectionUser->cerrarConexion();

        if($eliminado){
            $mensaje = 'Se ha eliminado con éxito. Por favor, <a href="index.php?ctl=login">inicie sesión.</a>';
        }else{
            $mensaje = "Error: No se ha podido eliminar. Por favor, inténtelo de nuevo";
        }
        //Vista
        //require_once("app/views/usuario/EliminarUsuario.view");
        unset($_POST);
        header("Location: web/scripts/php/logout.php");

        echo $mensaje;
    }
}
?>