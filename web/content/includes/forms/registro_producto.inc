<form id="form_register_product" action="index.php?ctl=registrar_producto" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend>Registro de nuevo producto</legend>
        <label for="nombre">Nombre producto</label><br>
        <input type="text" name="nombre" id="nombre"><br>
        <label for="Año">Año de producto</label><br>
        <input type="text" name="anno" id="anno"><br>
        <label for="Género">Género</label><br>
        <input type="text" name="genero" id="genero"><br>
        <label for="formato">Formato de producto</label><br>
        <input type="text" name="formato" id="formato"><br>
        <label for="precio">Precio</label><br>
        <input type="text" name="precio" id="precio"><br>
        <label for="cantidad">Cantidad</label><br>
        <input type="text" name="cantidad" id="cantidad"><br><br>
        <label for="imagen">Subir imagen</label><br>
        <input type="file" name="imagen" id="imagen"><br><br>
        <label for="muestra">Muestra</label><br>
        <input type="muestra" name="muestra" id="muestra"><br><br>
        <label for="descripcion">Descripcion de producto</label><br>
        <textarea id="descripcion" name="descripcion"></textarea><br><br>
        <input type="submit" name="registrar_producto" value="Registrar producto">
    </fieldset>
</form>
