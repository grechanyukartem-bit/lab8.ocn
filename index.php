<?php

// 1. Отримання JSON


// Варіант 1: file_get_contents()
$jsonData = file_get_contents('data.json');

// 2. Перетворення JSON у PHP-масив

$users = json_decode($jsonData, true); // true -> асоціативний масив


// 3. Фільтрація через GET-параметри

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $users = array_filter($users, function ($u) use ($id) {
        return $u['id'] === $id;
    });
}

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $users = array_filter($users, function ($u) use ($username) {
        return $u['username'] === $username;
    });
}

?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Список користувачів</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #007BFF; color: white; }
    </style>
</head>
<body>
<h1>Список користувачів</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Ім'я</th>
        <th>Username</th>
        <th>Email</th>
        <th>Місто</th>
        <th>Телефон</th>
        <th>Вебсайт</th>
        <th>Компанія</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['username']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['address']['city']) ?></td>
            <td><?= htmlspecialchars($user['phone']) ?></td>
            <td><?= htmlspecialchars($user['website']) ?></td>
            <td><?= htmlspecialchars($user['company']['name']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
