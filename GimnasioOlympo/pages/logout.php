<?php
session_start();
session_unset();
session_destroy();

setcookie('cart', 0, time() - 3600, '/');
setcookie('lastConnection', '', time() - 3600, '/');
header('Location: ./login.php');
