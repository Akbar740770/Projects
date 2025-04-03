<?php 
session_start();
require "functions.php";

$email = $_POST ["email"];
$password = $_POST ["password"];


$user = get_user_by_email($email);

// Если эл.адрес занят пернаправляем назад
if (!empty($user)) {  
    set_flash_message ("danger", "Этот эл.адрес уже занят!");
    redirect_to("/DIPLOM/page_register.php");
}

add_user($email,$password);

set_flash_message("success","Регистрация успешно!");
redirect_to("/DIPLOM/page_login.php");


// Если пользователь не найден, выполняем вставку
$sql = "INSERT INTO my_project (email, password) VALUES (:email, :password)";
$statement = $pdo->prepare($sql);
$statement->execute([
    "email" => $email,
    "password" => password_hash($password, PASSWORD_DEFAULT),
]);

