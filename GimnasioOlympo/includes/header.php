<header class="header">
    <main class="header__container">
        <img src="/GimnasioOlympo/GimnasioOlympo/assets/images/logo.png" alt="" class="logo">
        <nav class="nav">
            <ul class="nav__list">
                <li class="list__item"><a class="list__link
                <?php
                if (str_ends_with($_SERVER['PHP_SELF'], 'index.php'))
                    echo "active"
                ?>
                " href="/GimnasioOlympo/GimnasioOlympo/index.php">Inicio</a></li>

                <li class="list__item"><a class="list__link
                <?php
                if (str_ends_with($_SERVER['PHP_SELF'], 'products.php'))
                    echo "active"
                ?>
                " href="/GimnasioOlympo/GimnasioOlympo/pages/products.php">Productos</a></li>
                <li class="list__item"><a class="list__link
                <?php
                if (str_ends_with($_SERVER['PHP_SELF'], 'profile.php'))
                    echo "active"
                ?>
                " href="/GimnasioOlympo/GimnasioOlympo/pages/profile.php">Mi Perfil</a></li>
            </ul>
        </nav>
    </main>
</header>