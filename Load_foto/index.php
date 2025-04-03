<?php  session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Меню</title>
    <link rel="stylesheet" href="https://happyhaha.github.io/css/dist/style.min.css">
</head>
<body>


    <?php
   
        // Подключаем файл с функцией dbConnect() для работы с базой данных
        require_once "db.php";  

        // Подключаемся к базе данных
        $conn = dbConnect(); // Вызываем функцию dbConnect() для установления соединения с базой данных

            // Получаем список имен файлов из базы данных
        $sql = "SELECT filename FROM images"; // SQL-запрос для выборки всех имен файлов из таблицы images
        $result = mysqli_query($conn, $sql); // Выполняем запрос к базе данных, используя соединение $conn и запрос $sql
        $images = mysqli_fetch_all($result, MYSQLI_ASSOC); // Получаем все строки результата запроса в виде ассоциативного массива
    ?>
    
<div class="w-[1200px] pb-5">
    <div class="mt-12 ml-12 flex justify-between">
        <form class="w-[400px]" action="upload.php" method="POST" enctype="multipart/form-data">
            <h1 class="max-w-2xl mb-4 text-3xl font-extrabold tracking-tight leading-none md:text-5xl dark:text-white">Загрузите фото</h1>
            <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Загрузите свои фотографии в альбом, чтобы сохранить их и поделиться с друзьями.</p>

            <!-- Флеш сообщения -->
            <?php if (isset($_SESSION["success"])): ?>
            <div class="mx-auto p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <?php echo $_SESSION["success"]; ?>
            </div>
            <?php unset($_SESSION['success']); ?> 
            <?php endif; ?>

            <?php if (isset($_SESSION["error"])): ?> 
            <div class="mx-auto p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <?php echo $_SESSION["error"]; ?>
            </div>
            <?php unset($_SESSION['error']); ?> 
            <?php endif; ?>
            <!-- Конец флеш сообщений -->

            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Загрузить фото</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" name="user_avatar" type="file" required>
            <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">Загружайте изображения в форматах JPG и PNG</div>
            <button class="block p-4 text-lg bg-black hover:bg-gray-700 transition-all text-white rounded-lg w-full mt-8">Загрузить</button>
        </form>

        <div class="w-[600px] grid grid-cols-2 md:grid-cols-3 gap-4">
            <?php foreach ($images as $image): ?>
            <div>
                <img class="h-auto max-w-full rounded-lg" src="uploads/<?php echo $image['filename']; ?>" alt="<?php echo $image['filename']; ?>">
            
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
  

    
    

    <script src="https://happyhaha.github.io/css/dist/flowbite.min.js"></script>
</body>
</html>