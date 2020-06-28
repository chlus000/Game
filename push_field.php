<?
include 'connection.php';

$id = $_POST['id'];
$event = $_POST['event'];
$player = $_SERVER['REMOTE_ADDR'];
$sql = "SELECT * FROM `games` WHERE id='$id'";
$res = mysqli_query($conn,$sql) or die("Ошибка: ".mysqli_error($conn));
$row = $res->fetch_array(MYSQLI_ASSOC);
$move = $row['move'];
$fin = $row['fin'];

if($fin==0){
    if($move==0 && $player==long2ip($row['player1'])){
        $board = unserialize($row['board']);
        $board[$event]='X';
        $board = serialize($board);
        $sql = "UPDATE `games` SET board = '$board', move=1 WHERE id = '$id'";
        $res = mysqli_query($conn,$sql) or die("Ошибка: ".mysqli_error($conn));
    }

    if($move==1 && $player==long2ip($row['player2'])){
        $board = unserialize($row['board']);
        $board[$event]='O';
        $board = serialize($board);
        $sql = "UPDATE `games` SET board = '$board', move=0 WHERE id = '$id'";
        $res = mysqli_query($conn,$sql) or die("Ошибка: ".mysqli_error($conn));
    }
}


?>