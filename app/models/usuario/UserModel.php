<?php
    class UserModel{
        
        protected $conexion;

        function __construct($host, $user, $pass, $nameDb){
            $this->conexion = new Conexion($host, $user, $pass, $nameDb);
        }

        function editarDatos($oldEmail, $oldPasswd, $nuevosDatos){
            $editado = false;
            
            //Si el correo anterior es igual al del array no intentará cambiar la clave principal
            if($oldEmail==$nuevosDatos["correo"]){
                $stmt = $this->conexion->getConexion()->prepare(
                    "UPDATE usuarios SET
                    nombre = ?, apellidos = ?, fechaNacimiento = ?,
                    telefono = ?, direccion = ?, passwd = ? 
                    WHERE correo = ? AND passwd = ?");
            }else{
                $stmt = $this->conexion->getConexion()->prepare(
                    "UPDATE usuarios SET correo = ? ,
                    nombre = ?, apellidos = ?, fechaNacimiento = ?,
                    telefono = ?, direccion = ?, passwd = ? 
                    WHERE correo = ? AND passwd = ?");
            }
            
            //Si el correo anterior es igual al del array no intentará cambiar la clave principal
            if($stmt){
                if($oldEmail==$nuevosDatos["correo"]){
                    $stmt->bind_param("sssissss", $nuevosDatos["nombre"],
                    $nuevosDatos["apellidos"], $nuevosDatos["fechaNacimiento"], $nuevosDatos["telefono"], $nuevosDatos["direccion"],
                    $nuevosDatos["passwd"], $oldEmail, $oldPasswd);
                }else{
                    $stmt->bind_param("ssssissss", $nuevosDatos["correo"], $nuevosDatos["nombre"],
                    $nuevosDatos["apellidos"], $nuevosDatos["fechaNacimiento"], $nuevosDatos["telefono"], $nuevosDatos["direccion"],
                    $nuevosDatos["passwd"], $oldEmail, $oldPasswd);
                }
                //print_r($nuevosDatos);
                $stmt->execute();

                if($stmt->affected_rows == 1){
                    $editado = true;
                }
            }
            return $editado;
        }

        function delUsuario($correo, $pass){

            $usuarioEliminado = false;

            $stmt = $this->conexion->getConexion()->prepare(
                "DELETE FROM usuarios WHERE correo = ? AND passwd = ?"
            );
            
            if($stmt){
                $stmt->bind_param("ss", $correo, $pass);
                $stmt->execute();

                if($stmt->affected_rows == 1){
                    $usuarioEliminado = true;
                }

                $stmt->close();
            }

            return $usuarioEliminado;
        }

        function getUsuario($correo, $pass){
            $stmt = $this->conexion->getConexion()->prepare(
                "SELECT * FROM usuarios WHERE correo = ? AND passwd = ?");
            
            if($stmt){
                $stmt->bind_param("ss", $correo, $pass);
                $stmt->execute();
                $resultado = $stmt->get_result();
                $datosUsuario = $resultado->fetch_assoc();
            }
            $stmt->close();
            return $datosUsuario;
        }

        function setUsuario($correo, $nombre, $apellidos, $fechaNacimiento, $telefono, $direccion, $pass, $rol){
            
            //comprobacion de existencia
            $usuarioInsertado = false;

            $stmt = $this->conexion->getConexion()->prepare(
                "INSERT INTO usuarios (
                correo, nombre, apellidos, fechaNacimiento, telefono, direccion, passwd, rol) 
                values(?,?,?,?,?,?,?,?)");

            if($stmt){
                $stmt->bind_param("ssssisss", $correo, $nombre, $apellidos, $fechaNacimiento, $telefono, $direccion, $pass, $rol);
                $stmt->execute();

                //Si ninguna fila ha sido afectada, ya existe usuario
                if($stmt->affected_rows == 1){
                    $usuarioInsertado = true;
                }
                $stmt->close();
            }
            return $usuarioInsertado;
        }

        function cerrarConexion(){
            $this->conexion->getConexion()->close();
        }
    }
?>