<nav>
    <ul id="menu" class="nav navbar-dark bg-dark">
        <li><a href="index.php">Inicio</a></li>
        <li>
        <?php
            if(empty($_SESSION["user"])){
                echo '<a href="index.php?ctl=registrar">Registrarse</a>';
            }else{
                echo '<a href="index.php?ctl=perfil">Perfil</a>';
            }
        ?>
        </li>
        <?php
            if(empty($_SESSION["user"])){
                echo '<a class="nav-link" href="index.php?ctl=login">Iniciar sesion</a>';
            }else{
                echo '<a class="nav-link" href="index.php?ctl=logout">Cerrar Sesion</a>';
            }
        ?>
        <li>
        <?php
            if(!empty($_SESSION["user"])){
                if($_SESSION['user']['rol']=="admin"){
                    echo '<a class="nav-link" href="index.php?ctl=register_product">Registrar Producto</a>';
                }
            }
        ?>
        </li>
    </ul>
</nav>
