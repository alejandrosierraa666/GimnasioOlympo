<?php
$cart = [];

if (isset($_COOKIE["cart"])) {
    $cart = json_decode($_COOKIE["cart"], true);
}

?>

<header class="header">
    <main class="header__container">
        <img src="/GimnasioOlympo/GimnasioOlympo/assets/images/logo.png" alt="" class="logo">
        <nav class="nav">
            <ul class="nav__list">
                <li class="list__item"><a class="list__link
                <?php
                if (str_ends_with($_SERVER['PHP_SELF'], 'index.php')) echo "active"
                ?>
                " href="/GimnasioOlympo/GimnasioOlympo/index.php">Inicio</a></li>

                <li class="list__item"><a class="list__link
                <?php
                if (str_ends_with($_SERVER['PHP_SELF'], 'products.php')) echo "active";
                ?>
                " href="/GimnasioOlympo/GimnasioOlympo/pages/products.php">Productos</a></li>
                <li class="list__item"><a class="list__link
                <?php
                $_SESSION['role'] == 'admin' ? $route = "/GimnasioOlympo/GimnasioOlympo/pages/panelAdmin.php" : $route = "/GimnasioOlympo/GimnasioOlympo/pages/profile.php";
                if (str_ends_with($_SERVER['PHP_SELF'], 'panelAdmin.php') || str_ends_with($_SERVER['PHP_SELF'], 'profile.php')) echo "active";
                ?>
                " href="<?php echo $route; ?>">Mi Perfil</a></li>

                <a href="/GimnasioOlympo/GimnasioOlympo/pages/logout.php" class="btn__logout">Cerrar Sesión</a>
                <li class="list__item list__item--cart"><img src="/GimnasioOlympo/GimnasioOlympo/assets/images/cart1.svg" class="cart__img">

                    <div id="cart" class="cart">
                        <div class="cartitems">
                            <?php
                            foreach ($cart as $item) {
                                $stmt = $db->prepare('select * from products where id = ?');
                                $stmt->execute([$item['id']]);
                                $product = $stmt->fetch();

                                echo "<div class='cartitem'>
                            <img src='/GimnasioOlympo/GimnasioOlympo/assets/images/products/{$product['image_url']}' class='cartitem__img'>
                            <p class='cartitem__name'>{$product['name']}</p>
                            <p class='cartitem__quantity'>{$item['quantity']}</p>
                          </div>";
                            }
                            ?>
                        </div>
                        <div class="cart__btncontainer">
                            <button class="cart__btn">Comprar</button>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </main>
</header>