<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['user']) && isset($_POST['password']) && !empty($_POST['user']) && !empty($_POST['password'])) {

        //Controlamos el error en caso de que la base de datos no esté levantada
        try {
            include('./../db/db.php');
        } catch (Exception $e) {
            echo "<p>Error: El servicio de la BD no está disponible actualmente!!</p>";
            exit();
        }

        try {
            $stmt = $db->prepare("select password, role, id from users where user like ?");
            $stmt->execute([$_POST['user']]);
            $hashed = $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        //Hashed devuelve false si ese usuario no existe
        if ($hashed == false) {
            echo "Usuario o contraseña incorrecta!!";
        }


        if (password_verify($_POST['password'], $hashed['password'])) {
            session_start();
            $_SESSION['user'] = $_POST['user'];
            $_SESSION['role'] = $hashed['role'];
            $_SESSION['id'] = $hashed['id'];

            setcookie('lastConnection', date("Y-m-d H:i:s"), time() + 24 * 60 * 365, '/');
            header('Location: ../index.php');
            exit();
        } else {
            echo "Usuario o contraseña incorrecta!!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./../css/style.css">
    <link rel="stylesheet" href="./../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <script src="./../js/register.js" defer></script>
</head>

<body>
    <main class="login">
        <section class="login__container">
            <h1 class="login__title">Inicia Sesión</h1>

            <section class="login__form">
                <form class="form" action="" method="POST">
                    <div class="form__group">
                        <label class="form__label" for="user">Nombre de Usuario</label>
                        <input class="form__input" type="text" name="user" id="user">
                    </div>

                    <div class="form__group">
                        <label class="form__label" for="password">Contraseña</label>
                        <div class="eye__container">
                            <input class="form__input form__input--password" type="password" name="password" id="password" required>
                            <i class="fa-solid fa-eye eye" id="eye"></i>
                        </div>
                    </div>

                    <input class="form__submit" type="submit" value="Iniciar Sesión">
                </form>
                <a class="login__link" href="./register.php">¿Aún no estás registrado? Regístrate ahora!</a>
            </section>
        </section>
    </main>
</body>

</html>