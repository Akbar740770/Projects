<?php

// Получаем текст комментария из формы
$comment = $_POST["commentariy"];

// Данные для подключения к базе данных
$host ="localhost";
$username = "mysql";
$password = "mysql";
$database = "comments";

// Подключение к базе данных
$conn = mysqli_connect($host, $username, $password, $database);

// Проверка соединения
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL-запрос для вставки комментария
$sql = "insert into comments (commentariy) values ('$comment')";

// Выполнение запроса
if (mysqli_query($conn, $sql)) {
    echo "Комментарий успешно сохранен!";
} else {
    echo "Ошибка: " . $sql . "" . mysqli_error($conn);
}
?>
