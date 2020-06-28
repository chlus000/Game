<?php
    include "connection.php";

    $id = $_POST['val'];
    $ip = ip2long($_SERVER['REMOTE_ADDR']);
    $name = $_SESSION['login'];
    $sql = "UPDATE `games` SET
        player2 = '$ip',
        name2 = '$name'
    WHERE id = '$id'
    ";
    $res = mysqli_query($conn,$sql) or die("Ошибка: ".mysqli_error($conn));

    echo('<script>document.location.href="board2.php?id='.$id.'"</script>');
?>
