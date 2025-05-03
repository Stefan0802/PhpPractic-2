<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pop it MVC</title>
</head>
<body>
<header class="header">
    <nav>

        <a href="<?= app()->route->getUrl('/hello') ?>">Главная</a>
        <?php
        if (!app()->auth::check()):
            ?>

            <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
            <a href="<?= app()->route->getUrl('/signup') ?>">Регистрация</a>
            <?php

        ?>

        <?php
        else:
            ?>
            <?php
                if (app()->auth::user()->idRole == 2){
                    echo '<a href=' . app()->route->getUrl('/admin') . '>админка</a>';
                }
            ?>

            <a href="<?= app()->route->getUrl('/department') ?>">Подразделение</a>
            <a href="<?= app()->route->getUrl('/room') ?>">Помещение</a>
            <a href="<?= app()->route->getUrl('/phone') ?>">Телефоны</a>
            <a href="<?= app()->route->getUrl('/logout') ?>">Выход</a>
        <?php
        endif;
        ?>

    </nav>

</header>
<main>
    <?= $content ?? '' ?>
</main>


</body>
</html>

<style>

    body {
        background-color: #e0f7fa; /* Светло-голубой фон */
        margin: 0;
        padding: 0;
    }


    .header {
        margin: 0 auto;
        background-color: #6495ed; /* Светло-синий */
        color: white;
        text-align: center;
        padding: 20px 0;
        display: flex;
        justify-content: space-around;
    }

    .header > nav > a {
        padding: 10px 20px;
        text-decoration: none;
        color: white;
        font-weight: bold;
        transition: background-color 1s ease;
    }

    .header > nav > a:hover {
        background-color: #487eb0; /* Темнее синий при наведении */
        transform: scale(1.05); /* Легкое увеличение */
    }

</style>