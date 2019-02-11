<?php
    /*if(empty($_GET['ctl'])){
        header("Location: ../../../index.php");
    }*/
?>

<form id="form_login" action="index.php?ctl=loged" method="POST">
    <fieldset>
        <legend>Inicio de sesión</legend>
        <label for="correo">Correo electrónico</label><br>
        <input type="text" name="correo" id="correo" required><br>
        <label for="pass">Contraseña</label><br>
        <input type="password" name="pass" id="pass" required><br>
        <br>
        <input type="submit" name= "login" value="Iniciar">
    </fieldset>
</form>