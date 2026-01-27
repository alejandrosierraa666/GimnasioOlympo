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

        <section>
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
        </section>
    </main>
</body>

</html>