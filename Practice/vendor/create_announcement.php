<?php
session_start();
require_once 'connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['announcements'])) {
    $userName = $_POST['userName'];
    $userLanguage = $_POST['userLanguage'];
    $userLevel = $_POST['userLevel'];
    $userLocation = $_POST['userLocation'];
    $meetingTime = $_POST['meetingTime'];

    
    $query = "INSERT INTO announcements (name, language, level, location, time) VALUES (\$1, \$2, \$3, \$4, \$5)";
    $result = pg_query_params($conn, $query, array($userName, $userLanguage, $userLevel, $userLocation, $meetingTime));

    if ($result) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Не удалось создать объявление: ' . pg_last_error($conn)]);
    }

    pg_close($conn); 
}
?>
