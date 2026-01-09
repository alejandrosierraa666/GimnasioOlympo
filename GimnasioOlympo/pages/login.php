<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['user']) && isset($_POST['password']) && !empty($_POST['user']) && !empty($_POST['password'])){
            include('./../db/db.php');
        
            $stmt = $db->prepare("select password from users where user like ?");
            $stmt->execute([$_POST['user']]);
            $hashed = $stmt->fetch();


            if(password_verify($_POST['password'], $hashed['password'])){
                session_start();
                $_SESSION['user'] = $_POST['user'];
                header('Location: ../index.php');
                exit();
            }else{
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