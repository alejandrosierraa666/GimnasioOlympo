<?php
include('../utils/checkSession.php');
include('./../db/db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../css/style.css">
    <link rel="stylesheet" href="./../css/products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body>
    <?php include('./../includes/header.php') ?>
    <main class="main">
        <article class="banner">
            <p>Compra nuestra gama de batidos de alto contenido en proteínas, proteínas en polvo y mezclas para obtener suplementos proteicos de alta calidad que favorezcan el crecimiento y el mantenimiento de tus músculos.</p>
            <div class="product__icon">
                <i class="fa-solid fa-exclamation"></i>
            </div>
        </article>

        <section id="products" class="products">

            <?php
            $stmt = $db->prepare('select * from products');
            $stmt->execute();
            $result = $stmt->fetchAll();
            ?>

            <?php foreach ($result as $item): ?>
                <article class="product">
                    <img
                        class="product__img"
                        src="./../assets/images/products/<?= $item['image_url'] ?>"
                        alt="">

                    <div class="product__content">
                        <div>
                            <p class="product__title"><?= $item['name'] ?></p>
                            <p><?= $item['description'] ?></p>
                        </div>

                        <form class="product__form" method="POST" action="../utils/cart.php">
                            <p class="product__price"><?= $item['price'] ?> €</p>
                            <button class="product__btn"><img class="product__cart" src="../assets/images/cart.svg"></button>
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        </form>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    </main>
</body>

</html>