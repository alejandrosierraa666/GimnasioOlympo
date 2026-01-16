<?php
include('./utils/checkSession.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <section id="products">
            <?php
            include('./../db/db.php');
            $stmt = $db->prepare('select * from products');
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach ($result as $item) {
                echo "<article>";
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

        <script>
            const products = document.getElementById('products')

            products.addEventListener('click', (e) => {
                if (e.target.tagName == 'BUTTON') addToCart()
            })

            function addToCart() {

            }
        </script>
    </main>
</body>

</html>