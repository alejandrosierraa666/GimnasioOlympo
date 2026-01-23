<?php
include('./utils/checkSession.php');
?>

<!-- Publicidad del gimnasio -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Gimnasio Olympo</title>
</head>

<body>
    <?php include('./includes/header.php') ?>
    <section class="welcome">
        <div class="welcome__container">
            <div class="welcome__content">
                <h1 class="welcome__title">Bienvenido a Gimnasio Olympo</h1>
                <p class="welcome__text">Tu lugar para alcanzar la mejor versión de ti mismo. Únete a nosotros y transforma tu vida hoy.</p>
            </div>
            <div class="welcome__image">
                <img src=".//assets/images/portada.webp" alt="Imagen del gimnasio">
            </div>
        </div>
    </section>
    <section class="info">
        <div class="info__container">
            <h2 class="info__title">Instalaciones de Primera</h2>
            <p class="info__text">Nuestras instalaciones están equipadas con la última tecnología en equipos de entrenamiento para ofrecerte una experiencia inigualable.</p>
            <div class="installations">
                <div class="installation">
                    <img class="installation__img" src="./assets/images/pesas.webp">
                    <p>Área de Pesas</p>
                </div>
                <div class="installation">
                    <img class="installation__img" src="./assets/images/cardio.webp">
                    <p>Zona de Cardio</p>
                </div>
                <div class="installation">
                    <img class="installation__img" src="./assets/images/clases.webp">
                    <p>Clases Grupales</p>
                </div>
            </div>
        </div>
    </section>
</body>

</html>