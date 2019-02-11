<?php

    require_once("app/db/usuario/ConfigDB.php");
    require_once("app/db/Conexion.php");
    require_once("app/models/usuario/UserModel.php");
    require_once("app/models/controllers/UserControllerModel.php");

    $controller = new UserControllerModel();

    $arrayFunctions = [
        "registrando"   => "registrarUsuario",
        "loged"         => "login",
        "editando"      => "editarUsuario",
        "delUser"       => "eliminarUsuario"
    ];

    if(isset($_GET['ctl'])){
        foreach($arrayFunctions as $key => $function){
            if($_GET['ctl'] == $key){
                $controller->$function();
            }
        }
    }

?>