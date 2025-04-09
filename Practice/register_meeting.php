<?php
session_start();
require_once 'vendor/connect.php'; 

$data = json_decode(file_get_contents("php://input"), true);
$meetingId = $data['id'];

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Вы не авторизованы.']);
    exit();
}

$userId = $_SESSION['user_id'];

$query = "INSERT INTO meetings (user_id, meeting_id) VALUES ($userId, $meetingId)";
$result = pg_query($conn, $query);

if ($result) {
    echo json_encode(['success' => true, 'message' => 'Вы успешно записались на встречу!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Ошибка при записи на встречу. Пожалуйста, попробуйте еще раз.']);
}

pg_close($conn);
?>
