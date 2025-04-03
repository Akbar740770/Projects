<?php
//Этот файл обрабатывает данные, введенные пользователем. Его задачи:
//Проверять, что введено число и оно находится в диапазоне от 0 до 20.
//Сравнивать догадку игрока с загаданным числом.
//Управлять количеством оставшихся попыток.
//В случае ошибок создавать флеш-сообщение и возвращать пользователя на index.php.


// Стартуем сессию
session_start();

// Получаем введённое пользователем число
if (!isset($_POST['chislo'])) {
    header('Location: index.php');
    exit;
}

$guess = $_POST['chislo'];

// Валидация: проверяем, что это число и оно в диапазоне 0-20
if (!is_numeric($guess) || $guess < 0 || $guess > 20) {
    $_SESSION['flash_message'] = 'Введите корректное число от 0 до 20.';
    header('Location: index.php');
    exit;
}

// Если игрок угадал число
if ($guess == $_SESSION['number']) {
    $_SESSION['game_result'] = 'Поздравляем! Вы угадали число ' . $_SESSION['number'] . '.'; //сохраняем сообщение о победе, если число угадано, чтобы потом вывести его на index.php.
    header('Location: index.php');
    exit;
}

// Если догадка больше или меньше загаданного числа
if ($guess > $_SESSION['number']) {  //проверяет, совпадает ли введённое число с загаданным.
    $_SESSION['guess_hint'] = 'Загаданное число меньше.';
} else {
    $_SESSION['guess_hint'] = 'Загаданное число больше.';
}

// Уменьшаем количество попыток
if ($_SESSION['remaining_attempts'] > 0) {
        $_SESSION['remaining_attempts']--;

        // Проверяем, остались ли попытки после уменьшения
        if ($_SESSION['remaining_attempts'] <= 0) {
            $_SESSION['game_result'] = 'Попытки закончились. Загаданное число было ' . $_SESSION['number'] . '.';
            header('Location: index.php');
            exit;
        } else {
            // Подсказка о том, больше или меньше число
            if ($guess < $_SESSION['number']) {
                $_SESSION['guess_hint'] = 'Попробуйте число больше.';
            } else {
                $_SESSION['guess_hint'] = 'Попробуйте число меньше.';
            }
        }
    }

    // Перенаправление обратно к форме для новой попытки
    header('Location: index.php');
    exit;

?>