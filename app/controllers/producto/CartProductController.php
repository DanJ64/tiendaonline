<?php

    require_once("app/db/producto/ConfigDB.php");
    require_once("app/db/Conexion.php");
    require_once("app/models/producto/ProductModel.php");
    require_once("app/models/producto/CarritoModel.php");

    $cesta = new CarritoModel(ConfigDB::$host, ConfigDB::$user, ConfigDB::$pass, ConfigDB::$nameDb);
    $productos = [];
    /**
         * Recojo el id y la cantidad de la cesta
         * Despues al array productos le paso el producto buscado por la id y 
         * la cantidad recogida de la cesta 
         * por lo tanto me queda el rray con el producto y la cantidad
         * */

    if(isset($_GET['ctl'])){

        if($_GET['ctl'] == "car"){
            setProductos();

        }else if ($_GET['ctl'] == "add_to_car"){
            $cesta->guardarEnLaCesta($_GET['id_producto']);
            header("Location: index.php?ctl=ver_producto&id_producto=".$_GET['id_producto']);

        }else if ($_GET['ctl'] == "delUnit"){
            $cesta->eliminarUnidad($_GET['id_producto']);
            header("Location: index.php?ctl=car");

        }else if ($_GET['ctl'] == "addUnit"){
            $cesta->agregarUnidad($_GET['id_producto']);
            header("Location: index.php?ctl=car");

        }else if($_GET['ctl'] == "confirmar_compra"){
            $cesta->confirmarCompra();
            setProductos();
            $cesta->eliminarCesta();
            crearPDF();
            header("Location: index.php");
        }
    }

    
    if(isset($_GET['delItem'])){
        $cesta->eliminarDeLaCesta($_GET['delItem']);
        header("Location: index.php?ctl=car");
    }

    function crearPDF(){
        global $cesta;
        global $productos;
        $precioTotal = 0;
        
        ob_start();
        require("app/models/producto/fpdf/fpdf.php");
        $pdf = new FPDF();
        $pdf->AddPage();
        
        //CABECERA PDF
        $pdf->SetFont('Arial','B', 14);
        $pdf->Cell(120,10,'FACTURACION', 0, 0, 'L');
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(60,10,'Fecha: '.date('l jS F Y'), 0, 0,'C');
        $pdf->Ln();$pdf->Ln();

        //DATOS CLIENTE
        $pdf->Cell(60,5,'Datos del cliente:');
        $pdf->Ln();

        $pdf->SetFont('times','B', 10);
        $pdf->Cell(10,5, "");
        $pdf->Cell(60,5,'- Nombre: '.$_SESSION['user']['nombre']." ".$_SESSION['user']['apellidos']);
        $pdf->Ln();
        $pdf->Cell(10,5, "");
        $pdf->Cell(60,5,"- Direccion: ".$_SESSION['user']['direccion']);
        $pdf->Ln();
        $pdf->Cell(10,5, "");
        $pdf->Cell(60,5,"- Tlf:".$_SESSION['user']['telefono']);
        $pdf->Ln();
        $pdf->Cell(10,5, "");
        $pdf->Cell(60,5,"- Correo: ".$_SESSION['user']['correo']);
        $pdf->Ln();
        $pdf->Ln();

        //CABECERA TABLA
        $pdf->SetFont('Arial','B', 12);
        $pdf->Cell(90,8,"Producto", 1, 0,'C');
        $pdf->Cell(30,8,"Formato", 1, 0,'C');
        $pdf->Cell(30,8,"Cantidad", 1, 0,'C');
        $pdf->Cell(30,8,"Precio", 1, 0,'C');
        $pdf->Ln();
        $pdf->SetFont('Arial','B', 8);

        //DATOS TABLA
        foreach($productos as $producto){
            $pdf->Cell(90,7,$producto['nombre'], 1, 0,'C');
            $pdf->Cell(30,7,$producto['formato'], 1, 0,'C');
            $pdf->Cell(30,7,$producto['cantidad'], 1, 0,'C');
            $pdf->Cell(30,7,$producto['precio']." euros", 1, 0,'C');
            $pdf->Ln();
            $precioTotal += $producto['precio'];
        }

        //TOTAL
        $pdf->Ln();
        $pdf->SetFont('Arial','B', 12);
        $pdf->Cell(60,8,"Total: ".$precioTotal." Euros", 1, 0,'C');

        $pdf->Output();
        ob_end_flush();
    }

    function setProductos(){
        global $cesta;
        global $productos;
        $datosCesta = $cesta->getCestaProductos();
            
        if(!empty($datosCesta)){
            foreach($datosCesta as $key => $value){
                $productos[$key] = $cesta->getProducto($key);
                $precio = 0;

                if($productos[$key]["formato"] != "Digital"){
                    if($value <= CarritoModel::CANTIDAD_MAXIMA){
                        $precio = $value;
                    }else{
                        $precio = CarritoModel::CANTIDAD_MAXIMA;
                    }
                }else{
                    $precio = 1;
                }
                $productos[$key]["cantidad"] = $precio;
                $productos[$key]["precio"] *= $precio;
            }
        }
    }

    require_once("app/views/producto/Cesta.view");
?>