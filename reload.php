<?php
include 'connection.php';

$id = $_GET['id'];
$level = $_GET['level'];
$sql = "UPDATE `games` SET fin='1' WHERE id='$id'";
$res = mysqli_query($conn, $sql) or die("Ошибка: ".mysqli_error($conn));

if($level=="easy"){
    echo('<script>document.location.href="single_easy.php"</script>');
}
else if($level=="hard"){
    echo('<script>document.location.href="single_hard.php"</script>');
}


?>