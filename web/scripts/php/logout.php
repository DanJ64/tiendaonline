<?php
    session_name("user");
    session_start();
    //unset($_SESSION);
    $_SESSION = array();
    session_destroy();

    header("Location:../../../index.php");
?>