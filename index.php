<?php
require_once './vendor/db_for_rb.php';

$data = $_POST;
session_start();
$_SESSION['loggedin'] = false;
if (isset($data['do_login'])) { //обработка авторизации пользователя
    $errors = array();
    $user = R::findOne('admins','login = ?', array($data['login']));
    $password = $data['password'];
    $hash = $user->password;
    if ($user) {
        if (password_verify($data['password'], $user->password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['last_activity'] = time();
            $_SESSION['id'] = $user->id;
            header('Location: show/show_shops.php');
        } else {
            $errors[] = 'Неправильно введён пароль!';
        }
    } else {
        $errors[] = 'Пользователь с таким логином не найден';
    }
}

if (isset($data['do_login'])) { //обработка авторизации пользователя
    $errors = array();
    $user = R::findOne('creditors','login = ?', array($data['login']));
    $password = $data['password'];
    $hash = $user->password;
    if ($user) {
        if ($data['password'] == $user->password) {
            $_SESSION['loggedin'] = true;
            $_SESSION['last_activity'] = time();
            $_SESSION['id'] = $user->id;
            header('Location: do_credit.php');
        } else {
            $errors[] = 'Неправильно введён пароль!';
        }
    } else {
        $errors[] = 'Пользователь с таким логином не найден';
    }
}
echo $errors[0]

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Вход</title>
</head>
<body>
    <div class="container">
        <h1 style="font-family:sans-serif; width: 550px; position: absolute; top: 50px; font-size: 40px;text-shadow: 0 4px 16px rgb(165, 165, 165);">Информационная система POS-кредитования</h1>
        <div class="reg-win">
            <form class="form-main" action="index.php" method="post">
                <h1 class="form-title">Вход</h1>
                <div class="form-group">
                    <input type="text" class="form-input" name="login" placeholder=" ">
                    <label class="form-label">Логин</label>
                </div>
                <div class="form-group">
                    <input type="text" class="form-input" name="password" placeholder=" ">
                    <label class="form-label">Пароль</label>
                </div>
                <button class="form-button" id="to_main" name="do_login" type="submit">Войти</button>
            </form>
        </div>
        <p class="go-to-reg-text">Нет аккаунта? <a href="registration/REGISTRATION.php">Зарегистрируйтесь</a></p>
        <p class="go-to-reg-text"></p>
    </div>
<script src="main_content/js.js"></script>
</body>
</html>