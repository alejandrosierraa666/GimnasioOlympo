<?php
include('../utils/checkSession.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <main>
        <section id="products" class="products">
            <?php
            include('./../db/db.php');
            $stmt = $db->prepare('select * from products');
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach ($result as $item) {
                echo "<article class='product'>";
                echo "<img class='product__img' src='./../assets/images/products/" . $item['image_url'] . "' alt=''>";
                echo "<p>" . $item['name'] . "</p>";
                echo "<p>" . $item['description'] . "</p>";
                echo "<p>" . $item['price'] . " €</p>";
                echo "<form method='POST' action='../utils/addToCart.php'>";
                echo "<button>Añadir a la cesta</button>";
                echo "<input type='hidden' value='" . $item['id'] . "' name='id'>";
                echo "</form>";
                echo "</article>";
            }
            ?>
        </section>
    </main>
</body>

</html>