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
    <link rel="stylesheet" href="./../css/register.css">
    <link rel="stylesheet" href="./../css/admin.css">
    <title>Profile</title>
</head>

<body>
    <?php
    include('./../includes/header.php');
    ?>
    <main class="admin__container">

        <section>
            <article class='admin__info'>
                <h1>Panel de Administración</h1>
                <p>Bienvenido de nuevo, <span class="profile__user">administrador</span> | <?php echo $_COOKIE['lastConnection']; ?></p>
            </article>

            <div class="stats">
                <div class="stat">
                    <h3 class="stat__title">Total Miembros</h3>
                    <div class="numero">
                        <?php
                        $stmt = $db->prepare('select count(*) as total from users where role = "user"');
                        $stmt->execute();
                        $result = $stmt->fetch();

                        echo $result['total'];
                        ?>
                    </div>
                </div>
                <div class="stat">
                    <h3 class="stat__title">Bonos Activos</h3>
                    <div class="numero">
                        <?php
                        $stmt = $db->prepare('select count(*) as total from users where estado = 1 and role = "user"');
                        $stmt->execute();
                        $result = $stmt->fetch();

                        echo $result['total'];
                        ?>
                    </div>
                </div>
            </div>

            <div class="admin__panel">
                <h2>Gestión de Miembros</h2>
                <table class="admin__table">
                    <thead class="table__head">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Estado</th>
                            <th>Vencimiento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $stmt = $db->prepare('select * from users where role = "user"');
                        $stmt->execute();
                        $result = $stmt->fetchAll();

                        foreach ($result as $user) {
                            $user['estado'] ? $estado = 'activo' : $estado = 'inactivo';
                            $user['expiration_date'] ? $expiration__class = 'date' : $expiration__class = 'no__date';

                            echo "<tr>";
                            echo "<td style=''>" . $user['name'] . "</td>";
                            echo "<td style=''>" . $user['last_name'] . "</td>";
                            echo "<td style='display:flex; height:100%; justify-content:center; align-items:center;'><div class='" . $estado . "'>" . $estado . "</div></td>";
                            echo "<td class='" . $expiration__class . "'>" . ($user['expiration_date'] ? $user['expiration_date'] : 'Sin subscripción') . "</td>";
                            echo "<td><form action='./../utils/deleteUser.php?user=" . $user['user'] . "' method='POST'><button class='delete__button'>Borrar Usuario</button></form></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <section id="users" style="display: none; padding-bottom:40px; flex-direction:column; align-items:center; margin:50px auto; gap:1rem; box-shadow: 0 0 10px rgba(0, 0, 0, 0.35); padding-top:10px; width:80%; border-radius:10px;">
                <h2>Usuarios Registrados</h2>
                <section style="display: flex; margin-top:20px; justify-content:center; gap:1rem;">
                    <?php
                    try {
                        $stmt = $db->prepare('select * from users');
                        $stmt->execute();
                        $result = $stmt->fetchAll();

                        foreach ($result as $user) {
                            if ($user['role'] == 'admin') continue;

                            !empty($user['profile_picture']) && !isset($user['profile_picture']) ? $route = $user['profile_picture'] : $route = './../assets/images/default_picture.webp';

                            echo "<article style='padding:10px; display:flex; flex-direction:column; align-items:center; width:400px; border-radius:10px;'>";
                            echo "<img src='" . $route . "' style='width:50%; height:200px; border-radius:50%;'>";
                            echo "<p>Nombre de Usuario: " . $user['user'] . "</p>";
                            echo "<p>Nombre: " . $user['name'] . "</p>";
                            echo "<p>Apellidos: " . $user['last_name'] . "</p>";
                            echo "<p>Registrado el : " . $user['expiration_date'] . "</p>";
                            echo "<form action='./../utils/deleteUser.php?user=" . $user['user'] . "' method='POST'>";
                            echo "<button class='delete__button'>Borrar Usuario</button>";
                            echo "</form>";
                            echo "<button class='renew__button'>Renovar el bono</button>";
                            echo "</article>";
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    ?>
                </section>

            </section>

            <section id="addUserCapa" style="display: flex; padding-bottom:40px; flex-direction:column; align-items:center; margin:50px auto; gap:1rem; box-shadow: 0 0 10px rgba(0, 0, 0, 0.35); padding:20px; width:50%; border-radius:10px;">
                <form action="./../utils/addUser.php" method="POST" class="register__form">
                    <h2>Añadir Nuevo Usuario</h2>
                    <label for="user">Nombre de Usuario:</label>
                    <input type="text" id="user" name="user" required>

                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="last_name">Apellidos:</label>
                    <input type="text" id="last_name" name="last_name" required>

                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>

                    <label for="expiration_date">Fecha de Expiración (YYYY-MM-DD):</label>
                    <input type="date" id="expiration_date" name="expiration_date" required>

                    <button type="submit" class="admin__button--add">Crear Usuario</button>
                </form>
            </section>
        </section>
    </main>
</body>

</html>

<script>
    let btnUsers = document.getElementById('btn-users');
    let users = document.getElementById('users');
    let btnAddUser = document.getElementById('addUser');
    let addUserCapa = document.getElementById('addUserCapa');

    function seeUsers() {
        if (users.style.display === 'none') {
            users.style.display = 'flex';
            btnUsers.textContent = 'Ocultar Usuarios';
        } else {
            hideUsers();
        }
    }

    function hideUsers() {
        users.style.display = 'none';
        btnUsers.textContent = 'Ver Usuarios';
    }

    function hideAddUser() {
        addUserCapa.style.display = 'none';
        btnAddUser.textContent = 'Añadir un nuevo usuario';
    }

    function seeAddUser() {
        if (addUserCapa.style.display === 'none') {
            addUserCapa.style.display = 'block';
            btnAddUser.textContent = 'Ocultar formulario';
        } else {
            hideAddUser();
        }
    }

    btnUsers.addEventListener('click', () => {
        seeUsers()
        hideAddUser()
    });

    btnAddUser.addEventListener('click', () => {
        seeAddUser()
        hideUsers()
    });
</script>