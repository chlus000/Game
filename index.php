<?php
session_start();
include "connection.php";
?>

<HTML>
<head>
    <title>Главная</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="game_style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</head>
<body>

<?php
$sql = "CREATE TABLE IF NOT EXISTS users (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		username TEXT NOT NULL, 
		password TEXT NOT NULL,
		email TEXT NOT NULL ,
		reg_date DATETIME NOT NULL,
		token TEXT NOT NULL,
		is_confirm BOOLEAN NOT NULL,
		playAI int NOT NULL,
		looseAI int NOT NULL,
		winAI int NOT NULL
	)";
$result1 = mysqli_query($conn,$sql)or die("Ошибка 3");


$sql0="SELECT * FROM `users` WHERE `id`='".$_SESSION['id']."'";
$result=mysqli_query($conn,$sql0) or die ("Ошибка");
$row=$result->fetch_array(MYSQLI_ASSOC);
$win=$row['winAI'];
$lose=$row['looseAI'];
$all=$row['playAI'];
echo('<div class="obl">
<div class="score">Игр сыграно: '.$all.'</div>
<div class="score">Побед: '.$win.'</div>
<div class="score">Поражений: '.$lose.'</div>
</div>
')
?>
    <div class="main_menu">
        <a href="authorization.php"><div class="main_menu_button_1"><p class="main_menu_button_text">Вход</p></div></a>
        <a href="registration.php"><div class="main_menu_button_1"><p class="main_menu_button_text">Регистрация</p></div></a>
        <a href="single_game.php"><div class="main_menu_button"><p class="main_menu_button_text">Одиночная игра</p></div></a>
        <a href="multiple_game.php"><div class="main_menu_button"><p class="main_menu_button_text">Сетевая игра</p></div></a>
    </div>

</body>
</HTML>
