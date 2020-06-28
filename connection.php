<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "game";
$conn = mysqli_connect($servername, $username, $password, $db);
$conn -> set_charset("utf8");
if (!$conn){
    die("Ошибка связи с базой данных: ".mysqli_connect_error());
}
?>