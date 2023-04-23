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

$idAdmin = $_SESSION['id'];

$name_admin = $_SESSION['name_teacher'];
$data = $_POST;

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
            <div action="select_disciplina.php" method="post" class="select-disciplina-form" style="width: 720px; height: 520px;" id="show_form">
                <div style="width: 100%; display: flex; justify-content: space-between; margin-bottom: 10px">
                    <h3 style="font-size: 23px; border-bottom: 2px solid black; ">Администратор: <?=$name_admin?></h3>
                    <a href="../add/add_shop.php" class="link-nav" style="height: 45px; width: 100px">
                        Добавить магазин
                    </a>
                </div>
                    <?php
                        $query = "SELECT name_shop, code_shop, id FROM shops WHERE id_admin = ?;";
                        $stmt = mysqli_prepare($connect, $query);
                        mysqli_stmt_bind_param($stmt, "i", $idAdmin);
                        mysqli_stmt_execute($stmt);
                        $shops = mysqli_stmt_get_result($stmt);
                        $shops = mysqli_fetch_all($shops);

                        foreach ($shops as $shop) {
                            // print_r($shop);
                            echo "<a href='show_points.php?id=$shop[2]&shop=$shop[0]' style='display:flex; justify-content: space-between; width: 100%; font-family: sans-serif; border-radius: 10px; background: #F0F0F0; padding: 7px; margin-bottom: 5px; font-size: 15px; text-decoration: none; color: black;'>
                                    <span>Магазин: $shop[0]</span>
                                    <span>Код: $shop[1] <button style='height: 30px; margin-left: 17px'>Удалить</button></span>
                                </a>";
                        }
                        
                    ?>
                <!-- <button name="do_select_disciplina" class="form-button" onclick="a()">Далее</button> -->
            </div>
        </div>
    </div>

<script src="../main_content/js.js"></script>
</body>
</html>