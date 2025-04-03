<?php
session_start(); // Запускаем сессию

// Проверяем была ли отправлена форма 
if ($_SERVER["REQUEST_METHOD"] === "POST") {

   //Поолучаем текст комментария из формы и записываем в переменную comment
   $comment = $_POST["komentariya"];

   //Проверяем , заполнено ли поле комментария
   if (empty($comment)) {
    $_SESSION["error"] = "Заполните поле комментария!";
    header("Location: form_validation.php"); // Перенаправляем пользователья обратно к форме
    exit;
   }
 
} 
   // Код для подключения к базе данных и записи комментария
    $host ="localhost";
    $username = "mysql";
    $password = "mysql";
    $database = "comment_validation";

    // Подключение к базе данных
    $conn = mysqli_connect($host, $username, $password, $database);

    // Проверка соединения
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


// SQL-запрос для вставки комментария
$sql = "INSERT INTO comment_validation (comment_validation) VALUES ('$comment')";

// Выполнение запроса
if (mysqli_query($conn, $sql)) {
    $_SESSION['success'] = 'Комментарий успешно сохранен!';
    header('Location: form_validation.php'); // Перенаправляем пользователя обратно к форме
    exit;
} else {
    echo "Ошибка: " . $sql . "" . mysqli_error($conn);
}
?>