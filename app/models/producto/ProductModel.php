<?php
    class ProductModel{
        
        protected $conexion;

        function __construct($host, $user, $pass, $nameDb){
            $this->conexion = new Conexion($host, $user, $pass, $nameDb);
        }

        function editarProducto($id, $nuevosDatos){
            $editado = false;
            
            $stmt = $this->conexion->getConexion()->prepare(
                "UPDATE productos SET nombre = ?, anno = ?, genero = ?,
                formato = ?, precio = ?, unidades = ?,
                imagen = ?, descripcion = ?, muestra = ? WHERE id_producto = ?");
            
            if($stmt){
                
                $stmt->bind_param("sissdisssi", $nuevosDatos["nombre"],
                $nuevosDatos["anno"], $nuevosDatos["genero"], $nuevosDatos["formato"], $nuevosDatos["precio"],
                $nuevosDatos["unidades"], $nuevosDatos["imagen"], $nuevosDatos["descripcion"], $nuevosDatos["muestra"], $id);
                
                $stmt->execute();

                if($stmt->affected_rows == 1){
                    $editado = true;
                }
            }
            return $editado;
        }

        function eliminarProducto($id){

            $productoEliminado = false;

            $this->eliminarArchivos($id);

            $stmt = $this->conexion->getConexion()->prepare(
                "DELETE FROM productos WHERE id_producto = ?"
            );
            
            if($stmt){
                $stmt->bind_param("i", $id);
                $stmt->execute();

                if($stmt->affected_rows == 1){
                    $productoEliminado = true;
                }

                $stmt->close();
            }

            return $productoEliminado;
        }

        function getProducto($id){
            $stmt = $this->conexion->getConexion()->prepare(
                "SELECT * FROM productos WHERE id_producto = ?");
            
            if($stmt){
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $resultado = $stmt->get_result();
                $datosProducto = $resultado->fetch_assoc();
            }
            
            $stmt->close();
            return $datosProducto;
        }

        function setProducto($nombre, $anno, $genero, $formato, $precio, $unidades, $imagen, $descripcion, $muestra){
            
            //comprobacion de existencia
            $productoInsertado = false;

            $stmt = $this->conexion->getConexion()->prepare(
                "INSERT INTO productos (
                nombre, anno , genero, formato, precio, unidades, imagen, descripcion, muestra) 
                values(?,?,?,?,?,?,?,?,?)");

            if($stmt){
                $stmt->bind_param("sissdisss", $nombre, $anno, $genero, $formato, $precio, $unidades, $imagen, $descripcion, $muestra);
                $stmt->execute();

                //Si ninguna fila ha sido afectada, ya existe producto
                if($stmt->affected_rows == 1){
                    $productoInsertado = true;
                }
                $stmt->close();
            }
            return $productoInsertado;
        }

        function cerrarConexion(){
            $this->conexion->getConexion()->close();
        }

        function eliminarArchivos($id){
            $stmt = $this->conexion->getConexion()->prepare(
                "SELECT imagen FROM productos WHERE id_producto = ?"
            );

            if($stmt){
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->bind_result($imagen);
                $stmt->fetch();
                $stmt->close();
                
                //Eliminar archivo
                unlink($imagen);
            }
        }
    }
?>