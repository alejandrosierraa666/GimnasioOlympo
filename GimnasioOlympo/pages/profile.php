<?php
include('./../utils/checkSession.php');
include('./../db/db.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
    <header>
        <?php
        echo "<p>Hola, " . $_SESSION['user'] . " bienvenido de nuevo</p>";
        echo "<p>Última conexion --> " . $_COOKIE['lastConnection'] . "</p>";
        ?>

        <?php if ($_SESSION['role'] == 'admin'): ?>
            <div style="border:1px solid red">
                <p>Esta capa solo la van a poder ver los admins</p>

                <?php
                try {
                    $stmt = $db->prepare('select * from users');
                    $stmt->execute();
                    $result = $stmt->fetchAll();

                    foreach ($result as $user) {
                        !empty($user['profile_picture']) && !isset($user['profile_picture']) ? $route = $user['profile_picture'] : $route = './../assets/default_picture.webp';

                        echo "<article>";
                        echo "<img src='" . $route . "'>";
                        echo "<p>Nombre: " . $user['name'] . "</p>";
                        echo "<p>Apellidos: " . $user['last_name'] . "</p>";
                        echo "<p>Suscrito hasta: " . $user['expiration_date'] . "</p>";
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                ?>
            </div>
        <?php endif; ?>

    </header>
</body>

</html>