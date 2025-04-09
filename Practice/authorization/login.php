<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Авторизация</title>
</head>
<body>
<div class="header">
    <div class="header-line">
        <div class="logo">
            <a class="title" href="../authorization/login.php"><h1>Лингвист</h1></a>
        </div>
    </div>
</div>

<div class="auth_container">
    <div class="auth_form">
        <form action="../vendor/signin.php" method="post">
            <h1 class="h1_login">Авторизация</h1>
            <input type="text" placeholder="Введите логин" name="login" class="auth_input" required>
            <input type="password" placeholder="Введите пароль" name="password" class="auth_input" required>
            <button class="btn_log" type="submit">Войти</button>
            <p class="not_account">У вас нет аккаунта? - <a class="nt_a" href="register.php">Зарегистрируйтесь</a></p>
            <p class="message">
                <?php 
                    echo @$_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
            </p>
        </form>
    </div>
</div>  
</body>
</html>

