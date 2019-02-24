<?php
require "PDO_Pagination.php";

/* Config Connection */
$root = 'root';
$password = '';
$host = 'localhost';
$dbname = 'tienda_online';

$connection = new PDO("mysql:host=$host;dbname=$dbname;", $root, $password);
$pagination = new PDO_Pagination($connection);

$search = null;
if(isset($_REQUEST["search"]) && $_REQUEST["search"] != "")
{
    $search = htmlspecialchars($_REQUEST["search"]);
    $pagination->param = "&search=$search";
    $pagination->rowCount("SELECT * FROM productos WHERE nombre LIKE '%$search%'");
    $pagination->config(3, 5);
    $sql = "SELECT * FROM productos WHERE nombre LIKE '%$search%' ORDER BY id_producto ASC LIMIT $pagination->start_row, $pagination->max_rows";
    $query = $connection->prepare($sql);
    $query->execute();
    $model = array();
    while($rows = $query->fetch())
    {
        $model[] = $rows;
    }
}
else
{
$pagination->rowCount("SELECT * FROM productos");
$pagination->config(3, 5);
$sql = "SELECT * FROM productos ORDER BY id_producto ASC LIMIT $pagination->start_row, $pagination->max_rows";
$query = $connection->prepare($sql);
$query->execute();
$model = array();
while($rows = $query->fetch())
{
    $model[] = $rows;
}
}
?>

<br><br>
<div class = "productos">
<?php
    foreach($model as $row){
?>
        <!--CARD-->
        <div class="card text-white bg-dark mb-3" style="width: 18rem;">
        <img src="<?=$row['imagen']?>" class="card-img-top" alt="<?=$row['nombre']?>">
            <div class="card-body">
                <h5 class="card-title"><?=$row['nombre']?></h5>
                <p class="card-text"><?=$row['precio']?>€</p>
                <a href="index.php?ctl=ver_producto&id_producto=<?=$row['id_producto']?>" class="btn btn-primary">Ver producto</a>
            </div>
        </div>
<?php
    }
?>
</div>

        <br>
        <br>
        <style>
            /* CSS */
            .btn
            {
              text-decoration: none;
              color: #FFFFFF;
              padding-left: 10px;
              padding-right: 10px;
              margin-left: 1px;
              margin-right: 1px;
              border-radius: 3px;
              background: #7F83AD;
            }
            
            .btn:hover
            {
                background: #474C80;
            }
            .active
            {
                background: #E7814A;
            }
            /* CSS */
        </style>
<div>
    <center>
<?php
    $pagination->pages("btn");
?>
</div>
    </center>

