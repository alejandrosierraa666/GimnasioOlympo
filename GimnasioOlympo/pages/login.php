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
            $stmt = $db->prepare("select password, role from users where user like ?");
            $stmt->execute([$_POST['user']]);
            $hashed = $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        //Hashed devuelve false si ese usuario no existe
        if ($hashed == false) {
            echo "Usuario o contraseña incorrecta!!";
            exit();
        }


        if (password_verify($_POST['password'], $hashed['password'])) {
            session_start();
            $_SESSION['user'] = $_POST['user'];
            $_SESSION['role'] = $hashed['role'];

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