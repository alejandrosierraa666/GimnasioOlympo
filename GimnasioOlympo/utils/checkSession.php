<?php
    session_start();
    if(!isset($_SESSION['user'])){
        if(str_contains($_SERVER['PHP_SELF'], '/pages/')){
            header('Location: ./login.php');
            exit();
        }

        header('Location: ./pages/login.php');
        exit();
    }
?>