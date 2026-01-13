<?php
    include('./utils/checkSession.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <?php 
            include('./../db/db.php');
            $stmt = $db->prepare('select * from products');
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach ($result as $item){
                echo "<article>";
                echo "<p>".$item['name']."</p>";
                echo "<p>".$item['description']."</p>";
                echo "<p>".$item['price']." €</p>";
                echo "<p>".$item['name']."</p>";
                echo "</article>";
            }
        ?>
    </main>
</body>
</html>