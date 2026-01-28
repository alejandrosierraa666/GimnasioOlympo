<?php
include('./../utils/checkSession.php');
include('./../db/db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../css/register.css">
    <link rel="stylesheet" href="./../css/profile.css">
    <link rel="stylesheet" href="./../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <title>Profile</title>
</head>

<body>
    <?php
    include('./../includes/header.php');
    ?>

    <main class="profile__container">
        <article class='profile__info'>
            <p>Bienvenido de nuevo, <span class="profile__user"><?php echo $_SESSION['user']; ?></span> | <?php echo $_COOKIE['lastConnection']; ?></p>
        </article>

        <section class="profile__content">
            <aside class="profile__aside">
                <article class="profile__status">
                    <p>Online</p>
                    <div class="status"></div>
                </article>

                <img src="./../assets/images/default_picture.webp" alt="Foto de perfil" class="profile__image">

                <p>Nombre de Usuario: 
                    <?php
                    echo $_SESSION['user'];
                    ?>
                </p>

                <p> Nombre: 
                    <?php
                    $stmt = $db->prepare("SELECT name FROM users WHERE user = ?");
                    $stmt->execute([$_SESSION['user']]);
                    $name = $stmt->fetch();
                    echo $name['name'];
                    ?>
                </p>

                <p> Apellidos: 
                    <?php
                    $stmt = $db->prepare("SELECT last_name FROM users WHERE user = ?");
                    $stmt->execute([$_SESSION['user']]);
                    $lastname = $stmt->fetch();
                    echo $lastname['last_name'];
                    ?>
                </p>

                <p>Duracion bono:
                    <?php
                    $stmt = $db->prepare("SELECT expiration_date FROM users WHERE user = ?");
                    $stmt->execute([$_SESSION['user']]);
                    $duration = $stmt->fetch();
                    if (!$duration['expiration_date']) {
                        echo "Sin bono activo";
                    } else echo $duration['expiration_date'];
                    ?>
                </p>
            </aside>

            <section class="profile__main">
            <h2>Mis Facturas</h2>
                <section class="profile__invoices">
                    <?php
                    $stmt = $db->prepare("SELECT * FROM invoices WHERE user_id = ?");
                    $stmt->execute([$_SESSION['id']]);
                    $invoices = $stmt->fetchAll();

                    if (count($invoices) === 0) {
                        echo "<article class='invoice__empty'>";
                        echo "<p>No tienes facturas.</p>";
                        echo "</article>";
                    } else {
                        foreach ($invoices as $invoice) {
                            echo "<article class='invoice__item'>";
                            echo "<div class='invoice__header'>";
                            echo "<p>Factura ID: " . $invoice['id'] . "</p>";
                            echo "<p>Fecha: " . $invoice['date'] . "</p>";
                            echo "</div>";

                            $stmt = $db->prepare("SELECT * FROM invoices_products WHERE invoice_id = ?");
                            $stmt->execute([$invoice['id']]);
                            $invoice_products = $stmt->fetchAll();

                            echo "<p>Productos:</p>";
                            echo "<ul>";
                            foreach ($invoice_products as $product) {
                                $stmt = $db->prepare("SELECT image_url, price FROM products WHERE id = ?");
                                $stmt->execute([$product['product_id']]);
                                $product_info = $stmt->fetch();
                                echo "<li class='invoice__product'>";
                                echo "<img src='./../assets/images/products/" . $product_info['image_url'] . "' alt='Producto' class='invoice__image'>";
                                echo "<p>Cantidad: " . $product['quantity'] . "</p>";
                                echo "<p>Precio unitario: " . $product_info['price'] . " €</p>";
                                echo "</li>";
                            }
                            echo "<p class='invoice__total'>Total: " . $invoice['total'] . " €</p>";
                            echo "</article>";
                        }
                    }
                    ?>
                </section>
            </section>
        </section>
    </main>
</body>

</html>