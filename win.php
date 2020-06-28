<?php
session_start();
include 'connection.php';
//$_SESSION['id']=1;
$sql="SELECT * FROM `users` WHERE `id`='".$_SESSION['id']."'";
$result=mysqli_query($conn,$sql) or die ("Ошибка");
$row=$result->fetch_array(MYSQLI_ASSOC);
$win=$row['winAI']+1;
$sql2 = "UPDATE `users` SET winAI='".$win."' WHERE id='".$_SESSION['id']."'";
$res2 = mysqli_query($conn, $sql2) or die("Ошибка: ".mysqli_error($conn));

$all=$row['playAI']+1;
$sql3 = "UPDATE `users` SET playAI='".$all."' WHERE id='".$_SESSION['id']."'";
$res3 = mysqli_query($conn, $sql3) or die("Ошибка: ".mysqli_error($conn));

?>