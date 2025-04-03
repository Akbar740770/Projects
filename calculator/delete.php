<?php
session_start(); // Запускаем сессию

// Данные для подключения к базе данных
$host = 'localhost'; // Хост базы данных
$username = 'mysql'; // Имя пользователя базы данных
$password = 'mysql'; // Пароль базы данных
$database = 'raskhodi'; // Название базы данных

// Функция для подключения к базе данных
function dbConnect(){
    global $host, $username, $password, $database; // Получаем доступ к глобальным переменным
    $conn = mysqli_connect($host, $username, $password, $database); // Подключаемся к базе данных
    if (!$conn){
        die("Connection failed:" . mysqli_connect_error()); // ...выводим сообщение об ошибке подключение и завершаем скрипт
    }
    return $conn; // Возвращаем объект соединения
}

// Функция для удаления расхода из базы данных
function deleteExpense($id) {
    $conn = dbConnect(); // Подключаемся к базе данных
    $sql = "DELETE FROM raskhodi WHERE id = $id"; // Формируем SQL-запрос для удаления расхода
    if (mysqli_query($conn, $sql)) { // Выполняем запрос
        return true; // Возвращаем true, если запрос выполнен успешно
    } else {
        return false; // Возвращаем false, если произошла ошибка
    }
}

// Проверяем, передан ли ID расхода
if (isset($_GET['id'])) { // Если ID расхода передан...
    $id = $_GET['id']; // ...получаем его из GET-параметра

    // Удаляем расход из базы данных
    if (deleteExpense($id)) { // Если расход успешно удален...
        $_SESSION['success'] = 'Расход успешно удален!'; // ...создаем сообщение об успехе в сессии
    } else {
        $_SESSION['error'] = 'Ошибка при удалении расхода!'; // ...создаем сообщение об ошибке в сессии
    }

    header('Location: cost_calculator.php'); // Перенаправляем пользователя обратно на страницу с формой
    exit; // Завершаем скрипт
} else {
    $_SESSION['error'] = 'Не передан ID расхода!'; // Создаем сообщение об ошибке в сессии
    header('Location: cost_calculator.php'); // Перенаправляем пользователя обратно на страницу с формой
    exit; // Завершаем скрипт
}
