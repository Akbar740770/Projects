<?php
session_start();

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

// Функция для добавления расхода в базу данных
function addExpense($name,$amount){
    $conn = dbConnect();  // Подключаемся к базе данных
    $sql = "INSERT INTO raskhodi (name, amount) VALUES ('$name', '$amount' )"; // Формируем SQL-запрос для вставки данных
    if(mysqli_query($conn,$sql)) { // Выполняем запрос
        return true; // Возвращаем true, если запрос выполнен успешно
    } else{
        return false; // Возвращаем false, если произошла ошибка
    }
}

// Проверяем, была ли отправлена форма 
 if ($_SERVER['REQUEST_METHOD'] ==='POST' ) {   // Если метод запроса - POST...

    // Получаем данные из формы
    $expense_name = $_POST['expense_name'];    // Получаем название расхода из формы
    $expense_amount = $_POST['expense_amount'];  // Получаем сумму расхода из формы

    // Проверяем, заполнены ли поля
    if(empty($expense_name) || empty($expense_amount)) {   // Если название или сумма не заполнены
      $_SESSION['error'] = 'Заполните все поля!';  // ...создаем сообщение об ошибке в сессии
      header('Location: cost_calculator.php'); // Перенаправляем пользователя обратно на страницу с формой
        exit; // Завершаем скрипт
    }

// Добавляем расход в базу данных
    if(addExpense ($expense_name, $expense_amount)) {  // Если расход успешно добавлен
        $_SESSION ['success'] = 'Расход успешно добавлен!';  // ...создаем сообщение об успехе в сессии
    } else {
        $_SESSION ['error'] = 'Ошибка при добавлении расхода!';  // ...создаем сообщение об ошибке в сессии
}
    header('Location: cost_calculator.php'); // Перенаправляем пользователя обратно на страницу с формой
    exit; // Завершаем скрипт

 }


?>