<?php
include 'connection.php';

$id = $_GET['id'];
$ppl = $_GET['ppl'];
$sql = "UPDATE `games` SET fin='1' WHERE id='$id'";
$res = mysqli_query($conn, $sql) or die("Ошибка: ".mysqli_error($conn));

if($ppl=='single'){
    echo('<script>document.location.href="single_game.php"</script>');
}
else if($ppl=='multi'){
    echo('<script>document.location.href="multiple_game.php"</script>');
}

?>