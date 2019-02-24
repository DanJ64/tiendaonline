<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
      <?php
        if(empty($_SESSION["user"])){
            echo '<a class="nav-link" href="index.php?ctl=registrar">Registrarse</a>';
        }else{
            echo '<a class="nav-link" href="index.php?ctl=perfil">Perfil</a>';
        }
      ?>
      </li>

      <li class="nav-item">
      <?php
        if(empty($_SESSION["user"])){
            echo '<a class="nav-link" href="index.php?ctl=login">Iniciar sesion</a>';
        }else{
            echo '<a class="nav-link" href="index.php?ctl=logout">Cerrar Sesion</a>';
        }
      ?>
      </li>

      <li class="nav-item">
      <?php
        if(!empty($_SESSION["user"])){
          if($_SESSION['user']['rol']=="admin"){
              echo '<a class="nav-link" href="index.php?ctl=register_product">Registrar Producto</a>';
          }else if($_SESSION['user']['rol']=="user"){
            echo '<a class="nav-link" href="index.php?ctl=car">Carrito</a>';
          }
        }
      ?>
      </li>
      
    </ul>
    <form class="form-inline my-2 my-lg-0" method="POST" action="<?=$_SERVER["PHP_SELF"]?>">
      <input name="search" class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search" value="<?=$buscador ?>">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
  </div>
</nav>