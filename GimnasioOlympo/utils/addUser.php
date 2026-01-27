<?php
include('./../utils/checkSession.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['role'] === 'admin') {
    if (isset($_POST['user'], $_POST['name'], $_POST['last_name'], $_POST['password'], $_POST['expiration_date'])) {
        include('./../db/db.php');
        try {
            $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $stmt = $db->prepare('insert into users (user, name, last_name, password, expiration_date, estado) values (?, ?, ?, ?, ?, ?)');
            $stmt->execute([$_POST['user'], $_POST['name'], $_POST['last_name'], $hashedPassword, $_POST['expiration_date'], 1]);
            header('Location: ./../pages/panelAdmin.php');
            exit();
        } catch (Exception $e) {
            echo "Error al añadir el usuario: " . $e->getMessage();
            exit();
        }
    }
}
