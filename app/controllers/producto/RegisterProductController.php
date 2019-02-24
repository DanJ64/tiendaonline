<?php
    //MODELOS
    require_once("app/db/producto/ConfigDB.php");
    require_once("app/db/Conexion.php");
    require_once("app/models/producto/ProductModel.php");

    $id = 0;
    $nombre = $_POST["nombre"];
    $anno = $_POST["anno"];
    $genero = $_POST["genero"];
    $formato = $_POST["formato"];
    $precio = $_POST["precio"];
    $unidades = $_POST["unidades"];
    $descripcion = $_POST["descripcion"];
    $muestra = $_POST['muestra'];

    $existeProducto = false;
    $registrado = false;

    //variables para la imagen
    $directorio = "web/resources/img_productos/";
    $destino = $directorio.$_FILES['imagen']['name'];

    $imagen = $destino;

    $conexion = new ProductModel(ConfigDB::$host, ConfigDB::$user, ConfigDB::$pass, ConfigDB::$nameDb);

    //Comprobacion de existencia de producto
    if(!$conexion->setProducto($nombre, $anno, $genero, $formato, $precio, $unidades, $imagen, $descripcion, $muestra)){
        $existeProducto = true;
    }else{

        //Comprobacion de subida de ficheros
        if(!empty($_FILES['imagen']['tmp_name'])){
            
            if(is_uploaded_file($_FILES['imagen']['tmp_name'])){

                if(!is_dir("web/resources/img_productos/")){
                    mkdir("web/resources/img_productos/");
                }

                //$directorio = "web/resources/img_productos/";
                //$destino = $directorio.$_FILES['imagen']['name'];

                if(!is_file($destino)){
                    move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);
                }
            }
        }
        $registrado = true;
    }
    $conexion->cerrarConexion();

    //Preparacion de mensaje para la vista
    if($registrado){
        $mensaje = 'Producto registrado con éxito.';
    }else if($existeProducto){
        $mensaje = 'Producto ya existe.';
    }else{
        $mensaje = "Error: No se ha podido registrar. Por favor, inténtelo de nuevo";
    }
    //Vista
    require_once("app/views/producto/AdminMessage.view");
?>