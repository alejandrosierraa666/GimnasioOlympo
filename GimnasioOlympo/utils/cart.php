<?php
session_start();
include_once "./../db/db.php";

// Añadir producto al carrito
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

    file_put_contents("./../../logs/cart.log", date('Y-m-d H:i:s') . " - User " . $_SESSION['user'] . " added product $productId to cart\n", FILE_APPEND);


    header("Location: ../pages/products.php");
    exit();
}

// Eliminar producto del carrito
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['remove_id'])) {
    !isset($_COOKIE['cart']) ? $cart = [] : $cart = json_decode($_COOKIE['cart'], true);

    $removeId = $_GET['remove_id'];

    foreach ($cart as $index => $item) {
        if ($item["id"] == $removeId) {
            unset($cart[$index]);
            break;
        }
    }

    $cart = array_values($cart);

    setcookie("cart", json_encode($cart), time() + 60 * 24 * 30, "/");

    file_put_contents("./../../logs/cart.log", date('Y-m-d H:i:s') . " - User " . $_SESSION['user'] . " removed product $removeId from cart\n", FILE_APPEND);

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

// Comprar carrito
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['buy_cart'])) {
    $cart = [];

    if (isset($_COOKIE['cart'])) {
        $cart = json_decode($_COOKIE['cart'], true);
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    if (empty($cart)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $smtp = $db->prepare('insert into invoices (user_id, total) values (?, ?)');
    $total = 0;
    $date = date("Y-m-d H:i:s");
    foreach ($cart as $item) {
        echo "Processing item ID: " . $item['id'] . " with quantity: " . $item['quantity'] . "\n";
        $productStmt = $db->prepare("select price from products where id = ?");
        $productStmt->execute([$item['id']]);
        $product = $productStmt->fetch(PDO::FETCH_ASSOC);
        if ($product) {
            $total += $product["price"] * $item["quantity"];
        }
    }

    $smtp->execute([$_SESSION["id"], $total]);

    // Obtener el ID de la factura recién creada
    $invoiceId = $db->lastInsertId();
    // Insertar los detalles de la factura
    foreach ($cart as $item) {
        $productStmt = $db->prepare("select price from products where id = ?");
        $productStmt->execute([$item['id']]);
        $product = $productStmt->fetch(PDO::FETCH_ASSOC);
        if ($product) {
            $detailStmt = $db->prepare("insert into invoices_products (invoice_id, product_id, quantity) values (?, ?, ?)");
            $detailStmt->execute([$invoiceId, $item["id"], $item["quantity"]]);
        }
    }

    file_put_contents("./../../logs/cart.log", date('Y-m-d H:i:s') . " - User " . $_SESSION['user'] . " purchased cart: " . json_encode($cart) . "\n", FILE_APPEND);
    setcookie("cart", "", time() - 3600, "/");
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
