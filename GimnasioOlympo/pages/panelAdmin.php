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
    <link rel="stylesheet" href="./../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
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

            <section class="stats">
                <article class="stat">
                    <h3 class="stat__title">Total Miembros</h3>
                    <articl class="numero">
                        <?php
                        $stmt = $db->prepare('select count(*) as total from users where role = "user"');
                        $stmt->execute();
                        $result = $stmt->fetch();

                        echo $result['total'];
                        ?>
                    </articl>
                </article>
                <article class="stat">
                    <h3 class="stat__title">Bonos Activos</h3>
                    <article class="numero">
                        <?php
                        $stmt = $db->prepare('select count(*) as total from users where expiration_date > date(now()) and role = "user"');
                        $stmt->execute();
                        $result = $stmt->fetch();

                        echo $result['total'];
                        ?>
                    </article>
                </article>
            </section>

            <div class="admin__panel">
                <div class="admin__overtable">
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
                                if (!$user['expiration_date'] || strtotime($user['expiration_date']) < time()) {
                                    $estado = 'inactivo';
                                    $expiration__class = 'no__date';
                                } else {
                                    $estado = 'activo';
                                    $expiration__class = 'date';
                                }

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
                <aside class="admin__aside">
                    <section id="addUserCapa" class="aside__adduser">
                        <form action="./../utils/addUser.php" method="POST" class="add__form">
                            <h2>Añadir Nuevo Usuario</h2>
                            <input class="form__input" type="text" name="user" required placeholder="Nombre de usuario deseado">

                            <input class="form__input" type="text" name="name" required placeholder="Nombre">

                            <input class="form__input" type="text" name="last_name" required placeholder="Apellidos">

                            <input class="form__input" type="password" id="password" name="password" required placeholder="Contraseña">

                            <input class="form__input" type="date" name="expiration_date" required placeholder="Fecha de expiración">
                            <button type="submit" class="admin__button admin__button--add">Crear Usuario</button>
                        </form>
                    </section>

                    <section class="aside__adduser">
                        <h2>Renueva el bono de un usuario</h2>
                        <form action="./../utils/renovateUser.php" method="POST" style="width:100%;">
                            <select name="select" class="form__select">
                                <option selected disabled>Selecciona un usuario</option>
                                <?php
                                $stmt = $db->prepare('select * from users where role = "user"');
                                $stmt->execute();
                                $result = $stmt->fetchAll();

                                foreach ($result as $user) {
                                    echo "<option value='" . $user['user'] . "'>" . $user['name'] . " " . $user['last_name'] . "</option>";
                                }
                                ?>
                            </select>

                            <input type="date" name="date" class="form__select">
                            <input class="admin__button admin__button--renovate" type="submit" value="Renovar el bono">
                        </form>
                    </section>
                </aside>
            </div>
        </section>
    </main>
</body>

</html>