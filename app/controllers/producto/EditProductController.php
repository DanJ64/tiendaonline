<?php

    if(!empty($_SESSION['user']) && $_SESSION['user']['rol'] == "admin"){

        require_once("app/db/producto/ConfigDB.php");
        require_once("app/db/Conexion.php");
        require_once("app/models/producto/ProductModel.php");

        $producto = new ProductModel(ConfigDB::$host, ConfigDB::$user, ConfigDB::$pass, ConfigDB::$nameDb);

        $id = $_GET["id_producto"];
        $datosProducto = $producto->getProducto($id);
        
        //MEJORAR ESTE BLOQUE
        if(isset($_POST["editar_producto"])){

            $nuevosDatos = array();

            foreach($_POST as $key => $value){
                if($key != "editar_producto"){
                    $nuevosDatos[$key] = $value;
                }
            }

            

            //Comprobacion de subida de ficheros
            $destino = null;

            if(!empty($_FILES['imagen']['tmp_name'])){
                
                if(is_uploaded_file($_FILES['imagen']['tmp_name'])){

                    if(!is_dir("web/resources/img_productos/")){
                        mkdir("web/resources/img_productos/");
                    }

                    $directorio = "web/resources/img_productos/";
                    $destino = $directorio.$_FILES['imagen']['name'];

                    if(!is_file($destino)){
                        move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);
                    }
                }
            }

            //asignacion ruta imagen en array
            if($destino != null){
                $nuevosDatos["imagen"] = $destino;
            }else{
                $nuevosDatos["imagen"] = $datosProducto["imagen"];
            }
            

            if($producto->editarProducto($id, $nuevosDatos)){

                header('Location:index.php?ctl=ver_producto&id_producto='.$_GET["id_producto"]);
            }else{
                if(empty($datosProducto)){
                    $mensaje = "No existe el producto";
                }else{
                    $mensaje = "Error al editar";
                }
                
                require_once("app/views/producto/AdminMessage.view");
            }

        }else{
            //CARGAR VISTA
            require_once("app/views/producto/EditProduct.view");
        }
        $producto->cerrarConexion();
    }else{
        
        header('Location: index.php?ctl=ver_producto&id_producto='.$_GET["id_producto"]);
    }
?>