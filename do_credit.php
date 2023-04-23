<?php

session_start();

if ($_SESSION['loggedin'] == false || !isset($_SESSION['id'])) {
    header('Location: index.php');
}

if(isset($_SESSION['last_activity'])) {
    if (time() - $_SESSION['last_activity'] > 4800) {
        header('Location: logout.php');
    }
}
unset($_SESSION['updateIsOK']);
$_SESSION['last_activity'] = time();

$idTeacher = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Добавить группу</title>
</head>
<body>
    <a href="logout.php" class="back-to-login link-nav logoutBtn">
        Выйти
    </a>
    <div class="container-add-group-main">
        <div class="modal-win" style="width: 500px">
            <div class="select-disciplina-form" id="show_form" style="width: 100%">
                <h3 style="font-size: 30px; border-bottom: 3px solid black; padding: 3px">Торговая точка:</h3>
                <div style="width: 100%;">
                    <h3>Торговая точка:</h3>
                    <select name="select-disciplina" id="search_group">
                        <option>Выберите точку...</option>
                    </select>
                </div>
                <div style="width: 100%; margin-bottom: 15px">
                    <h3>Способ оплаты: </h3>
                    <select name="select-disciplina" id="search_group">
                        <option>Выберите способ оплаты...</option>
                        <option>Банковская карта</option>
                        <option>Наличный расчёт</option>
                    </select>
                </div>
                <div style="width: 100%; margin-bottom: 15px">
                    <h3>Категория товара: </h3>
                    <select name="select-disciplina" id="search_group">
                        <option>Выберите способ оплаты...</option>
                        <option>Продукты</option>
                        <option>Недвижимость</option>
                        <option>Транспорт</option>
                    </select>
                </div>
                <div class="form-group" style="width: 100%; font-family: sans-serif;">
                    <input type="text" class="form-input" name="login" placeholder=" " style=" padding: 10px">
                    <label class="form-label">Номер телефона</label>
                </div>
                <button name="do_select_disciplina" class="form-button" onclick="go()">Далее</button>
            </div>
        </div>
    </div>


<script src="../main_content/js.js"></script>

<script>
function go() {
  alert("Заявка отправлена");
}
</script>
</body>
</html>