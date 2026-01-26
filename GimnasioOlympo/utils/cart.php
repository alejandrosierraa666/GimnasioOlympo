<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    !isset($_COOKIE['cart']) ? $cart = [] : $cart = json_decode($_COOKIE['cart'], true);

    $productId = $_POST["id"];
    $quantity = isset($_POST["quantity"]) ? (int)$_POST["quantity"] : 1;


    $found = false;
    foreach ($cart as &$item) {
        if ($item["id"] == $productId) {
            $item["quantity"] += $quantity;
            $found = true;
            break;
        }
    }


    if (!$found) {
        array_push($cart, ["id" => $productId, "quantity" => $quantity]);
    }

    setcookie("cart", json_encode($cart), time() + 60 * 24 * 30, "/");

    file_put_contents("./../logs/cart.log", date('Y-m-d H:i:s') . " - User " . $_SESSION['user'] . " added product $productId to cart\n", FILE_APPEND);


    header("Location: ../pages/products.php");
    exit();
}
