<?php
include('./../utils/checkSession.php');
include('./../db/db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../css/style.css">
    <link rel="stylesheet" href="./../css/profile.css">
    <title>Profile</title>
</head>

<body>
    <?php
    include('./../includes/header.php');
    echo "<article class='profile__info'>";
    echo "<h1>Perfil de Usuario</h1>";
    echo "<div class='profile__data'>";
    echo "<p>Hola, <span class='profile__user'>" . $_SESSION['user'] . "</span> bienvenido de nuevo</p>";
    echo "<p>Última conexion --> " . $_COOKIE['lastConnection'] . "</p>";
    echo "</div>";
    echo "</article>";
    ?>

    <?php if ($_SESSION['role'] == 'admin'){ ?>
        <div style="border:1px solid red">
            <p>Esta capa solo la van a poder ver los admins</p>

            <section>
                <article>
                    <h2>Gestión de Usuarios</h2>
                    <p>Accede a la información de los usuarios registrados.</p>
                    <button id="btn-users">Ver Usuarios</button>
                </article>

                <article>
                    <h2>Gestión de Productos</h2>
                    <p>Añade, edita o elimina productos del catálogo.</p>
                    <button>Gestionar Productos</button>
                </article>
            </section>


            <section style="display: none; margin-top:20px;" id="users">
                <?php
                try {
                    $stmt = $db->prepare('select * from users');
                    $stmt->execute();
                    $result = $stmt->fetchAll();

                    foreach ($result as $user) {
                        if ($user['role'] == 'admin') continue;

                        !empty($user['profile_picture']) && !isset($user['profile_picture']) ? $route = $user['profile_picture'] : $route = './../assets/images/default_picture.webp';

                        echo "<article style='border:1px solid black; margin:10px; padding:10px; display:flex; flex-direction:column; align-items:center; width:500px;'>";
                        echo "<img src='" . $route . "' style='width:100%; height:400px; border-radius:50%;'>";
                        echo "<p>Nombre de Usuario: " . $user['user'] . "</p>";
                        echo "<p>Nombre: " . $user['name'] . "</p>";
                        echo "<p>Apellidos: " . $user['last_name'] . "</p>";
                        echo "<p>Suscrito hasta: " . $user['expiration_date'] . "</p>";
                        echo "<button>Borrar Usuario</button>";
                        echo "<button>Renovar el bono</button>";
                        echo "</article>";
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                ?>

                
                <button>Añadir un nuevo usuario</button>
            </section>

        </div>
    <?php }?>
</body>

</html>

<script>
    let btnUsers = document.getElementById('btn-users');
    let users = document.getElementById('users');

    btnUsers.addEventListener('click', () => {
        if (users.style.display === 'none') {
            users.style.display = 'grid';
            btnUsers.textContent = 'Ocultar Usuarios';
        } else {
            users.style.display = 'none';
            btnUsers.textContent = 'Ver Usuarios';
        }
    });
</script>