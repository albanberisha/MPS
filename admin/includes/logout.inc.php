<?php
session_start();
session_unset();     // unset $_SESSION   
    session_destroy();   // destroy session data 
    $host = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = "../../index.php";
    $_SESSION["login"] = "";
    header("Location: http://$host$uri/$extra");
?>

