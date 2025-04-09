<?php
require_once 'vendor/connect.php';

$query = "SELECT * FROM announcements";
$result = pg_query($conn, $query);

if (!$result) {
    echo "Ошибка выполнения запроса: " . pg_last_error($conn);
    exit();
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Объявления</title>
</head>
<body>
    <div class="header">
        <div class="header-line">
            <div class="logo">
                <a class="title" href="mytask.php">
                    <h1>Главная</h1>
                </a>
                <a class="title" href="announcements.php">
                    <h1>Объявления</h1>
                </a>
            </div>
            <div class="logout">
                <form action="vendor/logout.php" method="post">
                    <button type="submit" class="btn_logout">Выход</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>Список объявлений</h2>
        <table>
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Язык</th>
                    <th>Уровень</th>
                    <th>Место</th>
                    <th>Время встречи</th>
                    <th>Действия</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                if (pg_num_rows($result) > 0) {
                    while ($row = pg_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['language']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['level']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                        echo "<td>" . htmlspecialchars(date('d.m.Y H:i', strtotime($row['time']))) . "</td>";
                        echo "<td><button class='btn_register' onclick='registerForMeeting(" . $row['id'] . ")'>Записаться</button></td>"; // Кнопка записи
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Нет объявлений</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function registerForMeeting(meetingId) {
            if (confirm("Вы уверены, что хотите записаться на встречу?")) {
                fetch('register_meeting.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: meetingId })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.success) {
                        location.reload(); 
                    }
                })
                .catch((error) => {
                    console.error('Ошибка:', error);
                });
            }
        }
    </script>
</body>
</html>

<?php
pg_close($conn); 
?>
