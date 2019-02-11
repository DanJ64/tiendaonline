<form id="form_register_user" action="index.php?ctl=registrando" method="POST">
    <fieldset>
        <legend>Registro de nuevo usuario</legend>
        <label for="correo">Correo</label><br>
        <input type="email" name="correo" id="correo" required><br>
        <label for="nombre">Nombre</label><br>
        <input type="text" name="nombre" id="nombre" required><br>
        <label for="apellidos">Apellidos</label><br>
        <input type="text" name="apellidos" id="apellidos" required><br>
        <label for="fechaNacimiento">Fecha de nacimiento:</label><br>
        <input type="date" name="fechaNacimiento" id="fechaNacimiento" required><br>
        <label for="telefono">Teléfono</label><br>
        <input type="text" name="telefono" id="telefono" required><br>
        <label for="direccion">Dirección</label><br>
        <input type="text" name="direccion" id="direccion" required><br>
        <label for="pass">Contraseña</label><br>
        <input type="password" name="pass" id="pass" required><br><br>
            
        <input type="submit" name="registrar_usuario" value="Registrar usuario">
    </fieldset>
</form>
