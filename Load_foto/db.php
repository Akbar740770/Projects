<?php


// Данные для подключения к базе данных
$host = 'localhost'; // Хост базы данных
$username = 'mysql'; // Имя пользователя базы данных
$password = 'mysql'; // Пароль базы данных
$database = 'upload_images'; // Название базы данных

// Функция для подключения к базе данных
function dbConnect(){
    global $host, $username, $password, $database; // Получаем доступ к глобальным переменным
    $conn = mysqli_connect($host, $username, $password, $database); // Подключаемся к базе данных
    if (!$conn){
        die("Connection failed:" . mysqli_connect_error()); // ...выводим сообщение об ошибке подключение и завершаем скрипт
    }
    return $conn; // Возвращаем объект соединения
}





?>