<?php

    if(!empty($_SESSION['user'])){
        require_once("app/views/usuario/ViewUser.view");
    }else{
        header("Location:index.php");
    }
    
?>