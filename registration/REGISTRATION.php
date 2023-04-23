<?php
require_once '../vendor/connect.php';
require '../vendor/db_for_rb.php';

$data = $_POST;
$errors = array();
if (isset($data['do_login'])) {
    
    if(empty($errors)) {

        $query = "INSERT INTO admins (id, name, login, password) VALUES (NULL, ?, ?, ?)";
        $stmt = mysqli_prepare($connect, $query);
        $hash = password_hash($data['password'], PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "sss", $data['name'], $data['login'], $hash);
        mysqli_stmt_execute($stmt);
        
        header('Location: ../index.php');
    } else {
        echo array_shift($errors);
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <title>Регистрация</title>
</head>
<body>
    <div class="container">
        <div class="reg-win">
            <form class="form-main" action="REGISTRATION.php" method="post">
                <h1 class="form-title">Регистрация</h1>
                <div class="form-group">
                    <input type="text" class="form-input" name="name" id="nameInput" placeholder=" ">
                    <label class="form-label">Фамилия Имя Отчество</label>
                </div>
                
                <div class="form-group">
                    <input type="text" class="form-input" id="login" name="login" placeholder=" ">
                    <label class="form-label">Логин</label>
                </div>
                <div class="form-group">
                    <input type="text" class="form-input" id="password" name="password" placeholder=" ">
                    <label class="form-label">Пароль</label>
                </div>
                <input type="text" class="invisible" name="jsondisc" id="jsoninput" value="">
                <button class="form-button" id="to_main" name="do_login" type="submit">Зарегистрировать</button>
            </form>
        </div>
        <p class="go-to-reg-text">Уже есть аккаунт? <a href="../index.php">Войдите</a></p>
    </div>
<script src="registration.js"></script>
</body>
</html>