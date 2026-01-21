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
</head>

<body>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="Introduce tu nombre" required>
        <input type="text" name="lastname" placeholder="Introduce tus apellidos" required>
        <input type="text" name="user" placeholder="Nombre de usuario" required>
        <input type="text" name="password" placeholder="Contraseña" required>
        <input type="text" name="password2" placeholder="Repetir contraseña" required>
        <button>Registrarse</button>
        <a href="login.php">login</a>
    </form>
</body>

</html>