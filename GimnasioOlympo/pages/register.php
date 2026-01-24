<?php
include "./../db/db.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['lastname'])) {
    $username = $_POST['user'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $lastName = $_POST['lastname'];


    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $db->prepare("INSERT INTO users (user, password, name, last_name) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $hashedPassword, $name, $lastName]);

    echo "Usuario registrado exitosamente.";
    header('Location: ./login.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../css/style.css">
    <link rel="stylesheet" href="./../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <script src="./../js/register.js" defer></script>
</head>

<body>
    <main class="login">
        <section class="login__container">
            <h1 class="register__title">Regístrate!!</h1>

            <form action="" method="POST" class="register__form">
                <input class="form__input" type="text" name="name" placeholder="Introduce tu nombre" required>
                <input class="form__input" type="text" name="lastname" placeholder="Introduce tus apellidos" required>
                <input class="form__input" type="text" name="user" placeholder="Nombre de usuario deseado" required>
                <div class="eye__container">
                    <input class="form__input form__input--password" type="password" name="password" id="password" placeholder="Contraseña" required>
                    <i class="fa-solid fa-eye eye" id="eye"></i>
                </div>
                <button class="form__submit">Registrarse</button>
                <article class="register__back">
                    <a href="login.php" class="login__access">¿Ya estas registrado?, Identifícate</a>
                </article>
            </form>
        </section>
    </main>
</body>

</html>