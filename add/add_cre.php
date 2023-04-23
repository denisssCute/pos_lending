<?php
require_once '../vendor/connect.php';
require '../vendor/db_for_rb.php';


session_start();

if ($_SESSION['loggedin'] == false || !isset($_SESSION['id'])) {
    header('Location: ../index.php');
}

if(isset($_SESSION['last_activity'])) {
    if (time() - $_SESSION['last_activity'] > 4800) {
        header('Location: ../logout.php');
    }
}
unset($_SESSION['updateIsOK']);
$_SESSION['last_activity'] = time();


$data = $_POST;
$data_get = $_GET;

$errors = array();
if (isset($data['do_create'])) {
    
    if(empty($errors)) {

        $id = $data['id'];
        $name = $data['name'];
        $login = $data['login'];
        $pswd = $data['password'];

        echo "INSERT INTO creditors (`id`, `id_point`, `name_cre`, `login`, `password`) VALUES (NULL, $id, '$name', '$login', '$pswd')";
        
        $query = "INSERT INTO creditors (`id`, `id_point`, `name_cre`, `login`, `password`) VALUES (NULL, $id, '$name', '$login', '$pswd')";

        mysqli_query($connect, $query);

        
        echo $data['id'];
        header('Location: ../show/show_cre.php?shop=' . urlencode($data['shop']) . '&point=' . urlencode($data['point']) . '&id_shop=' . urlencode($data['id_shop']) . '&id=' . urlencode($data['id']));
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
    <link rel="stylesheet" href="../main_content/css.css">
    <title>Кредиторы</title>
</head>
<body>
    <a href="../logout.php" class="back-to-login link-nav logoutBtn">
        Выйти
    </a>
    
    <div class="container-add-group-main">
        <div class="modal-win">
            <div class="select-disciplina-form" style="width: 440px; height: 240px;" id="show_form">
                <div style="width: 100%; display: flex; justify-content: space-between; margin-bottom: 15px">
                    <h3 style="font-size: 23px; border-bottom: 2px solid black; margin-bottom: 5px">Добавить кредитора</h3>
                    <a href="../show/show_cre.php?shop=<?=$data_get['shop']?>&point=<?=$data_get['point']?>&id_shop=<?=$data_get['id_shop']?>" class="link-nav" style="height: 35px; width: 80px; padding: 7px">
                        Назад
                    </a>
                </div>
                <form class="form-main" action="add_cre.php" method="post" style="width: 100%; height: 100%; font-family: sans-serif;">
                    <div class="form-group">
                        <input type="text" class="form-input" name="name" placeholder=" ">
                        <label class="form-label">ФИО кредитора</label>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" name="login" placeholder=" ">
                        <label class="form-label">Логин</label>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" name="password" placeholder=" ">
                        <label class="form-label">Пароль</label>
                    </div>
                    <input type="text" style="display: none;" value="<?=$data_get['id_shop']?>" name="id_shop">
                    <input type="text" style="display: none;" value="<?=$data_get['id']?>" name="id">
                    <input type="text" style="display: none;" value="<?=$data_get['point']?>" name="point">
                    <input type="text" style="display: none;" value="<?=$data_get['shop']?>" name="shop">
                    <button class="form-button" id="to_main" name="do_create" type="submit">Создать</button>
                </form>
            </div>
        </div>
    </div>

<script src="../main_content/js.js"></script>
</body>
</html>