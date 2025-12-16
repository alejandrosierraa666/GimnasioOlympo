<?php
include "./db/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "hola";
    $username = $_POST['user'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    echo $username;

    if ($password === $password2) {
        echo "coinciden";
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        echo $hashedPassword;
        $db->query("INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')");

        echo "Usuario registrado exitosamente.";
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
</head>

<body>
    <form action="" method="POST">
        <input type="text" name="user" placeholder="Nombre de usuario">
        <input type="text" name="password" placeholder="Contraseña">
        <input type="text" name="password2" placeholder="Repetir contraseña">
        <button>Registrarse</button>
        <a href="login.php">login</a>
    </form>
</body>

</html>