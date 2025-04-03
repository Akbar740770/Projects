<?php 
session_start();

// // Поиск полбзователья эд.адресу
// function get_user_by_email ($email){

// $pdo = new PDO("mysql:host=localhost;dbname=diplom", "mysql", "mysql");


// $sql = "SELECT * FROM my_project WHERE email = :email";

// $statement = $pdo->prepare($sql);
// $statement->execute(["email" => $email]);
// $user = $statement->fetch(PDO::FETCH_ASSOC);
// return $user;
// }; 

// // Добавить пользователья в БД
// function add_user ($email,$password){

// $pdo = new PDO("mysql:host=localhost;dbname=diplom", "mysql", "mysql");

// // Если пользователь не найден, выполняем вставку
// $sql = "INSERT INTO my_project (email, password) VALUES (:email, :password)";
// $statement = $pdo->prepare($sql);
// $statement->execute([
//     "email" => $email,
//     "password" => password_hash($password, PASSWORD_DEFAULT),
// ]);

// }; 

// // Подготовить  флеш сообщения 
// function set_flash_message ($name,$message){
//      $_SESSION['flash'] = "Неправильный email или пароль ГА ГА ГА ГА.";

// };  

// //Вывезти флеш сообщения
// function displayFlash() {
//        if (isset($_SESSION['flash'])) {
//            echo "<div class='flash'>{$_SESSION['flash']}</div>";
//            unset($_SESSION['flash']);
//        }
//    }


// // Перенаправить на другую страницу
// function redirect_to($path) {
//     header("Location: " . $path);
//     exit; 
// }

// // Авторизация пользователя 
// function login($email, $parol) {

//     // Устанавливаем соединение с БД
//     $pdo = new PDO("mysql:host=localhost;dbname=diplom", "mysql", "mysql");

//     // Запрос на поиск пользователя
//     $sql = "SELECT email, password FROM my_project WHERE email = :email";
//     $statement = $pdo->prepare($sql);
//     $statement->execute(["email" => $email]);

//     // Получаем данные пользователя
//     $user = $statement->fetch(PDO::FETCH_ASSOC);

//       // Проверка, существует ли пользователь и совпадают ли пароли
//        if ($user && password_verify($parol, $user['password'])) {
//            return $user; 
//        }

//        set_flash_message('flash',"Неправильный email или пароль."); // Установка флеш-сообщения для неудачного входа
//        return null; // Если пользователь не найден или пароль неверный
//    }


// Список пользователей 

// Проверка, является ли пользователь аутентифицированным
function is_logged_in()
{
    return isset($_SESSION["user"]); // Проверяем, существует ли пользователь в сессии
}

// Получаем всех пользователей из базы данных
function get_users()
{
    $pdo = new PDO("mysql:host=localhost;dbname=diplom", "mysql", "mysql");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->query("SELECT * FROM users");
    return $statement->fetchAll(PDO::FETCH_ASSOC); // Возвращаем массив пользователей
}

// Функция для аутентификации пользователя
function login1($email, $password)
{
    $users = get_users(); // Получаем всех пользователей из базы данных

    foreach ($users as $user) {
        // Проверяем email и пароль
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            // Сохраняем данные пользователя в сессии
            $_SESSION["user"] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
            return true; // Успешная аутентификация
        }
    }
    return false; // Неудачная аутентификация
}

// Получаем текущего аутентифицированного пользователя 
function get_authenticated_user()
{
    return is_logged_in() ? $_SESSION["user"] : null; // Возвращаем данные пользователя или null
}

// Проверка, является ли текущий пользователь администратором
function is_admin()
{
    $user = get_authenticated_user();
    return $user && $user['role'] === 'admin'; // Проверяем, является ли пользователь администратором
}






//             // Редактирование профилья

// //Проверить, автор ли текущий авторизованный пользователь
// function is_author($logged_user_id, $edit_user_id){
    
// };

// //Получить пользолвателья по id
// function get_user_by_id ($id){

//         $pdo = new PDO("mysql:host=localhost;dbname=diplom", "mysql", "mysql");

//         $sql = "SELECT * FROM my_project WHERE id = :id";

//         $statement = $pdo->prepare($sql);
//         $statement->execute(["id" => $id]);
//         $user = $statement->fetch(PDO::FETCH_ASSOC);
//         return $user;
//     }; 

// // Редактировать общую информацию
// function edit_info($user_id, $username, $job_title, $phone, $address) {};