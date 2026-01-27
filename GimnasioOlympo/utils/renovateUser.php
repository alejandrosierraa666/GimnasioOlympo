<?php
include('./../utils/checkSession.php');
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['select']) && $_SESSION['role'] === 'admin') {
    include('./../db/db.php');
    try {
        $stmt = $db->prepare('update users set expiration_date = ? where user = ?');
        $stmt->execute([$_POST['date'], $_POST['select']]);
    } catch (Exception $e) {
        echo "Error al actualizar la informacion del usuario: " . $e->getMessage();
        exit();
    }
    header('Location: ./../pages/panelAdmin.php');
    exit();
}