<?php
    session_name("user");
    session_start();

    $title = "Music Store";

    $enlacesGET = [
        "inicio"    => "index.php",
        "login"     => "web/content/includes/forms/login.inc",
        "registrar" => "web/content/includes/forms/registro_usuario.inc",
        "perfil"    => "app/controllers/usuario/ViewUserController.php",
        "logout"    => "web/scripts/php/logout.php",
        "editUser"  => "app/controllers/usuario/EditUserController.php",
        "delUser"   => "app/controllers/usuario/UserController.php",
        "register_product"  => "web/content/includes/forms/registro_producto.inc",
        "ver_producto" => "app/controllers/producto/ViewProductController.php",
        "editProduct" => "app/controllers/producto/EditProductController.php",
        "delProduct" => "app/controllers/producto/DeleteProductController.php",
        "car" => "app/controllers/producto/CartProductController.php",
        "add_to_car" => "app/controllers/producto/CartProductController.php",
        "addUnit" => "app/controllers/producto/CartProductController.php",
        "delUnit" => "app/controllers/producto/CartProductController.php",
        "confirmar_compra" => "app/controllers/producto/CartProductController.php"
    ];

    $enlacesPOST = [
        "login"             => "app/controllers/usuario/UserController.php",
        "registrar_usuario" => "app/controllers/usuario/UserController.php",
        "editar_usuario"    => "app/controllers/usuario/UserController.php",
        "registrar_producto" => "app/controllers/producto/RegisterProductController.php",
        "editar_producto" => "app/controllers/producto/EditProductController.php"
    ];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="web/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="web/styles/css/login.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="web/styles/css/loged.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="web/styles/css/register_user.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="web/styles/css/registered.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="web/styles/css/edit_user.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="web/styles/css/product.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="web/styles/css/mensaje.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="web/styles/bs/css/bootstrap.css" />

    <!--SCRIPTS-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<body>
    <header>Music Store</header>
    <?php

    //NAVBAR
    $buscador = "";
    if(!empty($_REQUEST["search"])){
        $buscador = $_REQUEST["search"];
    }
    require_once("web/content/includes/navs/navbar.inc");
    
    //CAROUSEL
    //require_once("web/content/includes/carousel/carousel.inc");

    //COMPROBACION DE LA VARIABLE GET
        if(isset($_GET['ctl'])){ 

            foreach($enlacesGET as $key => $enlace){
                if($_GET['ctl'] == $key){
                    if($key != "logout"){
                        require_once($enlace);
                    }else{
                        header("Location: $enlace");
                    } 
                }
            }
        }else{
            require_once("app/controllers/producto/pagination/demo.php");
        }

    //COMPROBACION DE LA VARIABLE POST
        if(!empty($_POST)){
            foreach($enlacesPOST as $key => $value){
                if(isset($_POST[$key])){
                    require_once($value);
                }
            }
        }

        //Destruir $_POST
        unset($_POST);
    ?>
</body>
</html>