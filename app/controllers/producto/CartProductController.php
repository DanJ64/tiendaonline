<?php
    require_once("app/db/producto/ConfigDB.php");
    require_once("app/db/Conexion.php");
    require_once("app/models/producto/ProductModel.php");
    require_once("app/models/producto/CarritoModel.php");
    
    $cesta = new CarritoModel(ConfigDB::$host, ConfigDB::$user, ConfigDB::$pass, ConfigDB::$nameDb);
    $productos = [];

    if(isset($_GET['ctl']) && $_GET['ctl'] == "car"){
        $idsProductos = $cesta->getIdsProductos();
        
        foreach($idsProductos as $value){
            array_push($productos, $cesta->getProducto($value));
        }

    }else if (isset($_GET['ctl']) && $_GET['ctl'] == "add_to_car"){
        $cesta->crearCookie($_GET['id_producto']);
        header("Location: index.php?ctl=car");
    }
    
    if(isset($_GET['delcookie'])){
        $cesta->eliminarCookie($_GET['delcookie']);
        header("Location: index.php?ctl=car");
    }
?>

<div>
<table class = "table table-light">
    <thead class="thead-dark">
        <tr>
            <th>Nombre</th>
            <th>Formato</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    
        <?php
            foreach($productos as $producto)
            {
                echo "<tr>";
                echo "<td>".$producto['nombre']."</td>";
                echo "<td>".$producto['formato']."</td>";
                echo "<td>".$producto['precio']."</td>";
                echo "<td>".$producto['cantidad']."</td>";
                echo '<td><a href="index.php?ctl=car&delcookie='.$producto["id_producto"].'">Eliminar</td>';
                echo "</tr>";
            }
        ?>
</table>
</div>