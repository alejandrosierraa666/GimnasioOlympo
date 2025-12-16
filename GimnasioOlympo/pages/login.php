<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!isset($_POST['user']) || !isset($_POST['password']) || empty($_POST['user']) || empty($_POST['password'])) return;
        include('../db/db.php');
        
        $result = $bd->query('select * from users where user like ? and password like ?', [$_POST['user'], password_hash($_POST['password'], PASSWORD_BCRYPT)]);

        if(!$result) return;
        else header('Location: ../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <main class="container">
        <h1>Inicia Sesión</h1>

        <section class="form__container">
            <form action="" method="POST">
                <label for="">Nombre de Usuario</label>
                <input type="text" name="user">

                <label for="">Contraseña</label>
                <input type="password" name="password">
                
                <input type="submit" value="Iniciar Sesión">
            </form>
            <a href="./register.php">¿Aún no estás registrado? Regístrate ahora!</a>
        </section>
    </main>
</body>
</html>