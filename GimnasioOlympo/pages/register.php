<?php
include "./../db/db.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['password2'])) {
    $username = $_POST['user'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $name = $_POST['name'];
    $lastName = $_POST['lastname'];

    echo $username;

    if ($password === $password2) {
        echo "coinciden";
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $db->prepare("INSERT INTO users (user, password, expiration_date, name, last_name) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$username, $hashedPassword, date("d/m/y") , $name, $lastName]);


        echo "Usuario registrado exitosamente.";
        header('Location: ./login.php');
    } else {
        echo "Las contraseñas no coinciden.";
    }
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
</head>

<body>
    <main class="login__container">
        <h1 class="register__title">Regístrate!!</h1>

        <form action="" method="POST" class="register__form">
            <input class="form__input" type="text" name="name" placeholder="Introduce tu nombre" required>
            <input class="form__input" type="text" name="lastname" placeholder="Introduce tus apellidos" required>
            <input class="form__input" type="text" name="user" placeholder="Nombre de usuario deseado" required>
            <input class="form__input" type="text" name="password" placeholder="Contraseña" required>
            <input class="form__input" type="text" name="password2" placeholder="Repetir contraseña" required>
            <button class="form__submit">Registrarse</button>
            <article class="register__back">
                <a href="login.php" class="login__access">¿Ya estas registrado?, Identifícate</a>
            </article>
        </form>
    </main>
</body>

</html>