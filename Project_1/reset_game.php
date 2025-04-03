<?php
//Этот файл отвечает за сброс сессии при нажатии на кнопку “Новая игра”. Его задачи:
//Удалять текущие данные сессии.
//Возвращать пользователя на index.php, где генерируется новое число.


// Стартуем сессии
session_start();

// Удаляем сессию (очищаем все данные)
session_unset();
session_destroy();

// Перенаправляем пользователя на index.php
header('Location: index.php');
exit;
?>