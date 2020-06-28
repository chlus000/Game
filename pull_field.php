<?
include 'connection.php';

$id = $_POST['id'];
$sql = "SELECT * FROM `games` WHERE id='$id'";
$res = mysqli_query($conn,$sql) or die("Ошибка: ".mysqli_error($conn));
$row = $res->fetch_assoc();

$fin = $row['fin'];
if($fin==1){?>
    <div id="info"><? echo ('Ваш соперник покинул игру');?></div>
<?}
else{
    $mes = $row['player2'];
    if($mes==null){?>
        <div id="info"><? echo ('Ожидание соперника...');?></div>
    <?}
}

$game_field = unserialize($row['board']);
for ($i = 0; $i < 9; $i++):?>
    <div class="block" id=<?echo $i?>><? echo $game_field[$i];?></div>
<?endfor?>