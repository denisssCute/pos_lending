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

$idTeacher = $_SESSION['id'];

$nameTeacher = $_SESSION['name_teacher'];
$data = $_POST;
$data_get = $_GET;
if (isset($data['do_select_disciplina']) && $data['select-disciplina'] != 'Выберите предмет...') {
    $_SESSION['disciplina'] = $data['select-disciplina'];
    header('Location: ../main_content/select.php');
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
    <a href="../show/show_points.php?id=<?=$data_get['id_shop']?>&shop=<?=$data_get['shop']?>&id=<?=$data_get['id']?>" class="back-to-login link-nav logoutBtn" style="left: 85px">
        Торговые точки
    </a>
    <div class="container-add-group-main">
        <div class="modal-win">
            <div action="select_disciplina.php" method="post" class="select-disciplina-form" style="width: 720px; height: 520px;" id="show_form">
                <div style="width: 100%; display: flex; justify-content: space-between; margin-bottom: 10px">
                    <h3 style="font-size: 23px; border-bottom: 2px solid black; ">Торговая точка: <?=$data_get['point']?></h3>
                    <a href="../add/add_cre.php?shop=<?=$data_get['shop']?>&point=<?=$data_get['point']?>&id_shop=<?=$data_get['id_shop']?>&id=<?=$data_get['id']?>" class="link-nav" style="height: 45px; width: 100px">
                        Добавить кредитора
                    </a>
                </div>                
                <div style="overflow: auto; width: 100%; height: 470px; padding-right: 15px">
                    <?php
                        $query = "SELECT name_cre, login FROM creditors WHERE id_point = ?;";
                        $stmt = mysqli_prepare($connect, $query);
                        mysqli_stmt_bind_param($stmt, "i", $data_get['id']);
                        mysqli_stmt_execute($stmt);
                        $agents = mysqli_stmt_get_result($stmt);
                        $agents = mysqli_fetch_all($agents);

                        foreach ($agents as $agent) {
                            echo "<p style='display:flex; justify-content: space-between; width: 100%; font-family: sans-serif; border-radius: 10px; background: #F0F0F0; padding: 7px; margin-bottom: 5px; font-size: 15px; text-decoration: none; color: black;'>
                                    <span>Кредитор: $agent[0]</span>
                                    <span>Логин: $agent[1] <button style='height: 30px; margin-left: 17px'>Удалить</button></span>
                                </p>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>


<script src="../main_content/js.js"></script>
</body>
</html>