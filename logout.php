<?php

session_start();
$_SESSION['loggedin'] = false;

$id = $_SESSION['id'];

if (isset($id)) { //РАЗЛОГИНИВАНИЕ ПОЛЬЗОВАТЕЛЯ
    session_unset();
    
}
header('Location: index.php');

?>
