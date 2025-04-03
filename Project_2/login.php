<?php 
session_start();
require "functions.php";

// Проверка метода запроса 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Получаем EMAIL и PASSWORD
    $email = $_POST['email'];
    $parol = $_POST['password'];

    // Вызов функции для проверки учетных данных
    $user = login($email, $parol);

    if ($user) {
        // если успешный вход записываем данные пользователя в сессию
        $_SESSION['id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        
        // Перенаправляем на страницу пользователья
        redirect_to("/DIPLOM/page_profile.php");
    } else {
         // Иначе неверная электронная почта или пароль
        redirect_to("/DIPLOM/page_login.php");
    }
}

?>