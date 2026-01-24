<?php
include('./../utils/checkSession.php');
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['user']) && $_SESSION['role'] === 'admin'){
    include('./../db/db.php');
    try {
        $stmt = $db->prepare('delete from users where user = ?');
        $stmt->execute([$_GET['user']]);
    } catch (Exception $e) {
        echo "Error al eliminar el usuario: " . $e->getMessage();
        exit();
    }
    header('Location: ./../pages/panelAdmin.php');
    exit();
}