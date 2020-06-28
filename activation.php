<?php
	require_once('connection.php');
	if(isset($_GET['token']) && !empty($_GET['token'])){
		$token = $_GET['token'];
		if(isset($_GET['email']) && !empty($_GET['email'])){
			$nUsEmail = $_GET['email'];
			$sql="SELECT * FROM `users` WHERE `email`='".$nUsEmail."'";
			$result = mysqli_query($conn,$sql) or die ("Ошибка поиска");
				if($result->num_rows == 1){
					$row=$result->fetch_array(MYSQLI_ASSOC);
					if($token == $row['token']){
						$id=$row['id'];
						$sql1="UPDATE `users` SET `is_confirm`='1' WHERE `id`=".$id;
						$result=mysqli_query($cnct, $sql1) or die("Ошибка users");
					}
				}
		}
		else 
			echo('Это неправильная ссылка!!!');
	}
	else
		echo('Это неправильная ссылка!!!');

	header("Location: http://localhost/Game/");
?>