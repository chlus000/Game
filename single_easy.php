<HTML>
<head>
    <title>Одиночная игра</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="game_style.css">

</head>
<body>
<?php
include "connection.php";

$sql = "CREATE TABLE IF NOT EXISTS `games`(
            id INT AUTO_INCREMENT,
            player1 VARBINARY (16) NOT NULL,
            name1 varchar (30),
            player2 VARBINARY (16),
            name2 varchar (30),
            board TEXT,
            single BOOLEAN,
            fin BOOLEAN,
            move BOOLEAN,
            PRIMARY KEY(id)
        )";
$res = mysqli_query($conn,$sql) or die("Ошибка: ".mysqli_error($conn));

$ip = ip2long($_GET['ip']);
$name = $_SESSION['login'];
$board = "";
$single = 1;
$fin = 0;

$sql = "SELECT id FROM `games` ORDER BY id DESC";
$res = mysqli_query($conn,$sql) or die("Ошибка: ".mysqli_error($conn));
$row = $res->fetch_array(MYSQLI_ASSOC);
$id = $row['id']+1;

$sql = "INSERT INTO `games` (id, player1, name1, board, single, fin) VALUES(
            '$id',
            '$ip',
            '$name',
            '$board',
            '$single',
            '$fin'
        )";
$res = mysqli_query($conn,$sql) or die("Ошибка: ".mysqli_error($conn));

echo('<script>document.location.href="board.php?id='.$id.'&level=easy"</script>
    ');
?>

</body>

</HTML>
