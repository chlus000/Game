<HTML>
<head>
    <title>Новая игра</title>
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

    $sql = "SELECT id FROM `games` ORDER BY id DESC";
    $res = mysqli_query($conn,$sql) or die("Ошибка: ".mysqli_error($conn));
    $row = $res->fetch_array(MYSQLI_ASSOC);
    $id = $row['id']+1;

    $ip = ip2long($_SERVER['REMOTE_ADDR']);
    $name = $_SESSION['login'];
    $single = 0;
    $fin = 0;
    $board = array(0=>'',1=>'',2=>'',3=>'',4=>'',5=>'',6=>'',7=>'',8=>'',);
    $board = serialize($board);
    $sql = "INSERT INTO `games` (id, player1, name1, board, single, fin) VALUES(
        '$id',
        '$ip',
        '$name',
        '$board',
        '$single',
        '$fin'
    )";
    $res = mysqli_query($conn,$sql) or die("Ошибка: ".mysqli_error($conn));

    echo('<script>document.location.href="board2.php?id='.$id.'"</script>')
    ?>
</body>
</HTML>

