<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    !isset($_COOKIE['cart']) ? $list = [] : $list = json_decode($_COOKIE['cart'], true);
    array_push($list, $_POST["id"]);
    setcookie('cart', json_encode($list), time() + 60 * 24 * 30, "/");
    
    header('Location: ../pages/products.php');
    exit();
}
