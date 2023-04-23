<?php
require_once '../vendor/connect.php';


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

if (isset($data['do_create'])) {
    $name = $data['name'];
    $code = $data['code'];
    $name = strval($name);

    $query = "INSERT INTO `points` (`id`, `id_shop`, `name_point`, `code_point`) VALUES (NULL, ?, ?, ?)";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "isi", $data['id'], $data['name'], $data['code']);
    mysqli_stmt_execute($stmt);

    header('Location: ../show/show_points.php?id=' . urlencode($data['id']) . "&shop=" . urlencode($data['shop']));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../main_content/css.css">
    <title>Магазины</title>
</head>
<body>
    <a href="../logout.php" class="back-to-login link-nav logoutBtn">
        Выйти
    </a>
    
    <div class="container-add-group-main">
        <div class="modal-win">
            <div action="add_shop.php" method="post" class="select-disciplina-form" style="width: 440px; height: 190px;" id="show_form">
                <div style="width: 100%; display: flex; justify-content: space-between; margin-bottom: 15px">
                    <h3 style="font-size: 23px; border-bottom: 2px solid black; margin-bottom: 5px">Добавить торговую точку</h3>
                    <a href="../show/show_points.php?id=<?=$data_get['id']?>&shop=<?=$data_get['shop']?>" class="link-nav" style="height: 35px; width: 80px; padding: 7px">
                        Назад
                    </a>
                </div>
                <form class="form-main" action="add_point.php" method="post" style="width: 100%; height: 100%; font-family: sans-serif;">
                    <div class="form-group">
                        <input type="text" class="form-input" name="name" placeholder=" ">
                        <label class="form-label">Название торговой точки</label>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" name="code" placeholder=" ">
                        <label class="form-label">Код торговой точки</label>
                    </div>
                    <input type="text" style="display: none;" value="<?=$data_get['id']?>" name="id">
                    <input type="text" style="display: none;" value="<?=$data_get['shop']?>" name="shop">
                    <button class="form-button" id="to_main" name="do_create" type="submit">Создать</button>
                </form>
            </div>
        </div>
    </div>


<script src="../main_content/js.js"></script>
</body>
</html>