<?php
session_start();
if (!isset($_SESSION['user'])) {
    if (str_contains($_SERVER['PHP_SELF'], '/pages/')) {
        header('Location: ./login.php');
        exit();
    }

    header('Location: ./pages/login.php');
    exit();
}

if (isset($_COOKIE['lastConnection']) && isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
    if (strtotime($_COOKIE['lastConnection']) < time() - 24 * 60 * 60) {
        session_unset();
        session_destroy();

        if (str_contains($_SERVER['PHP_SELF'], '/pages/')) {
            header('Location: ./login.php');
            exit();
        }

        header('Location: ./pages/login.php');
        exit();
    } else {
        setcookie('lastConnection', date("Y-m-d H:i:s"), time() + 24 * 60 * 365, '/');
    }
}
