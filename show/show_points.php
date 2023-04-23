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

$id_shop = $data['id'];

$name_shop = $_SESSION['name_teacher'];

$data = $_GET;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../main_content/css.css">
    <title>Точки</title>
</head>
<body>
    <a href="../logout.php" class="back-to-login link-nav logoutBtn">
        Выйти
    </a>
    <a href="../show/show_shops.php" class="back-to-login link-nav logoutBtn" style="left: 85px">
        Магазины
    </a>
    <div class="container-add-group-main">
        <div class="modal-win">
            <div action="select_disciplina.php" method="post" class="select-disciplina-form" style="width: 720px; height: 520px;" id="show_form">
                <div style="width: 100%; display: flex; justify-content: space-between; margin-bottom: 10px">
                    <h3 style="font-size: 23px; border-bottom: 2px solid black; ">Магазин: <?=$data['shop']?></h3>
                    <a href="../add/add_point.php?id=<?=$data['id']?>&shop=<?=$data['shop']?>" class="link-nav" style="height: 45px; width: 100px">
                        Добавить торг. точку
                    </a>
                </div>
                <div style="overflow: auto; width: 100%; height: 470px; padding-right: 15px"> 
                    <?php
                        $query = "SELECT name_point, code_point, id, id_shop FROM points WHERE id_shop = ?;";
                        $stmt = mysqli_prepare($connect, $query);
                        mysqli_stmt_bind_param($stmt, "i", $data['id']);
                        mysqli_stmt_execute($stmt);
                        $points = mysqli_stmt_get_result($stmt);
                        $points = mysqli_fetch_all($points);

                        $shop = $data['shop'];

                        foreach ($points as $point) {
                            // print_r($point);
                            echo "<a href='show_cre.php?shop=$shop&point=$point[0]&id=$point[2]&id_shop=$point[3]' style='display:flex; justify-content: space-between; width: 100%; font-family: sans-serif; border-radius: 10px; background: #F0F0F0; padding: 7px; margin-bottom: 5px; font-size: 15px; text-decoration: none; color: black;'>
                                    <span>Торг. точка: $point[0]</span>
                                    <span>Код: $point[1] <button style='height: 30px; margin-left: 17px'>Удалить</button></span>
                                </a>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>


<script src="../main_content/js.js"></script>
</body>
</html>