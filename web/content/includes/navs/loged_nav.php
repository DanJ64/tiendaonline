<nav>
    <ul id="menu" class="nav navbar-dark bg-dark">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="index.php?ctl=perfil">Perfil</a></li>
        <li><a href="index.php?ctl=logout">Cerrar sesión</a></li>
        <?php
            if($_SESSION['user']['rol']=="admin"){
                echo '<li><a href="index.php?ctl=register_product">Registrar Producto</a></li>';
            }
        ?>
    </ul>
</nav>
