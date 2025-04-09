<?php
session_start();
require_once '../vendor/connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = trim($_POST['email']);

    
    if ($password !== $confirm_password) {
        echo json_encode(['success' => false, 'message' => 'Пароли не совпадают.']);
        exit();
    }

   
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $query = "INSERT INTO users (username, password, email) VALUES (\$1, \$2, \$3)";
    $result = pg_query_params($conn, $query, array($username, $hashedPassword, $email));

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Регистрация прошла успешно!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Ошибка регистрации: ' . pg_last_error($conn)]);
    }
}
?>