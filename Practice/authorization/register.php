<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Регистрация</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
</head>
<body>
<div class="header">
    <div class="header-line">
        <div class="logo">
            <a class="title" href="../authorization/register.php"><h1>Лингвист</h1></a>
        </div>
    </div>
</div>

<div class="auth_container">
    <div class="auth_form">
        <form id="registrationForm">
            <h1 class="h1_login">Регистрация</h1>
            <input type="text" placeholder="Введите логин" name="username" class="auth_input" required>
            <input type="email" placeholder="Введите email" name="email" class="auth_input" required>
            <input type="password" placeholder="Введите пароль" name="password" class="auth_input" required>
            <input type="password" placeholder="Подтвердите пароль" name="confirm_password" class="auth_input" required>
            <button class="btn_log" type="submit">Зарегистрироваться</button>
            <p id="message" class="message"></p>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#registrationForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: '../vendor/signup.php', 
            type: 'POST',
            data: $(this).serialize(), 
            success: function(response) {
                response = JSON.parse(response); 
                $('#message').text(response.message);
                if (response.success) {
                    
                    setTimeout(function() {
                        window.location.href = 'login.php'; 
                    }, 2000); 
                }
            },
            error: function(xhr, status, error) {
                $('#message').text("Произошла ошибка: " + error);
            }
        });
    });
});
</script>
</body>
</html>
