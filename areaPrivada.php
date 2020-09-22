<?php
    session_start();
    if(!isset($_SESSION['id_usuarios']))
    {
        header("location: index.php");
        exit;
    }
?>

SEJA BEM VINDO MEU CARO

<a href="sair.php"> Logout</a>