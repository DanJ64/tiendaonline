<form id="form_register_product" action="index.php?ctl=registrar_producto" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend>Registro de nuevo producto</legend>
        <div class="form-group">
            <label for="nombre">Nombre producto</label>
            <input type="text" class="form-control" name="nombre" id="nombre">
        </div>
        <div class="form-group">
            <label for="Año">Año de producto</label>
            <input type="text" class="form-control" name="anno" id="anno">
        </div>
        <div class="form-group">
            <label for="Género">Género</label>
            <input type="text" class="form-control" name="genero" id="genero">
        </div>
        <div class="form-group">
            <label for="formato">Formato de producto</label>
            <select class="form-control" id="formato" name="formato">
                <option value="CD">CD</option>
                <option value="Digital">Digital</option>
            </select>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="text" class="form-control" name="precio" id="precio">
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="text" class="form-control" name="cantidad" id="cantidad">
        </div>
        <div class="form-group"><label for="imagen">Subir imagen</label>
            <input type="file" name="imagen" id="imagen">
        </div>

        <div class="form-group">
            <label for="muestra">Muestra</label>
            <input type="muestra" class="form-control" name="muestra" id="muestra">
        </div>

        <div class="form-group">
            <label for="descripcion">Descripcion de producto</label>
            <textarea id="descripcion" class="form-control" name="descripcion"></textarea>
        </div>

        <input type="submit" class="btn btn-primary" name="registrar_producto" value="Registrar producto">
    </fieldset>
</form>