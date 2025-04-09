<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Обмен языковыми знаниями</title>
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
        <h2>Создать объявление</h2>
        <input type="text" id="userName" placeholder="Ваше имя">
        <input type="text" id="userLanguage" placeholder="Язык">
        <select id="userLevel">
            <option value="Начальный">Начальный</option>
            <option value="Средний">Средний</option>
            <option value="Продвинутый">Продвинутый</option>
        </select>
        <input type="text" id="userLocation" placeholder="Место">
        <input type="datetime-local" id="meetingTime">
        <button onclick="createAnnouncement()">Создать объявление</button>
    </div>

    <script>
        function createAnnouncement() {
            const name = document.getElementById('userName').value;
            const language = document.getElementById('userLanguage').value;
            const level = document.getElementById('userLevel').value;
            const location = document.getElementById('userLocation').value;
            const time = document.getElementById('meetingTime').value;

            if (!name || !language || !location || !time) {
                alert('Пожалуйста, заполните все поля.');
                return;
            }

            const data = new FormData();
            data.append('announcements', true);
            data.append('userName', name);
            data.append('userLanguage', language);
            data.append('userLevel', level);
            data.append('userLocation', location);
            data.append('meetingTime', time);

            fetch('vendor/create_announcement.php', { 
                    method: 'POST',
                    body: data,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Объявление успешно создано!');
                        window.location.href = 'announcements.php'; 
                    } else {
                        alert(`Ошибка: ${data.message}`);
                    }
                })
                .catch(error => console.error('Ошибка:', error));
        }
    </script>
</body>

</html>