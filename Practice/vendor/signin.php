<?php
session_start();
require_once '../vendor/connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password'];

    
    if (empty($login) || empty($password)) {
        $_SESSION['message'] = 'Пожалуйста, заполните все поля.';
        header('Location: ../authorization/login.php'); 
        exit();
    }

    
    $query = "SELECT * FROM users WHERE username = \$1";
    $result = pg_query_params($conn, $query, array($login));

    if ($result && pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);
        
        
        if (password_verify($password, $user['password'])) {
            
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['username'] = $user['username']; 
            header('Location: ../mytask.php'); 
            exit();
        } else {
            $_SESSION['message'] = 'Неверный логин или пароль.';
            header('Location: ../authorization/login.php'); 
            exit();
        }
    } else {
        $_SESSION['message'] = 'Пользователь не найден.';
        header('Location: ../authorization/login.php'); 
        exit();
    }
}
?>

