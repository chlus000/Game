<?php
	session_start();
	include "connection.php";
	if (isset($_POST['b_ent'])){
		if ((isset($_POST['username'])) && (isset($_POST['userpass']))){
			$username=trim($_POST['username']);
			$password=$_POST['userpass'];
			$username=htmlspecialchars($username, ENT_QUOTES);
			$password=htmlspecialchars($password, ENT_QUOTES);
			$sql="SELECT * FROM `users` WHERE `username`='".$username."'";
			$result = mysqli_query($conn,$sql) or die("Ошибка 1");
			$row = $result->fetch_assoc();
			if ($row['username'] == $username){
				$hashpass=$row['password'];
				$rows1 = mysqli_num_rows($result);
				if (password_verify($password, $hashpass)) {				
					$_SESSION['username']=$username;
					$_SESSION['id']=$row['id'];
					$_SESSION['email']=$row['email'];
					header('Location: http://localhost/Game/');
				}
				else {
					$_SESSION['error_message']="Невеный пароль";
				}
			}
			else {
				$_SESSION['error_message']="Такого имени не существует";
			}
		}
		else {
			$_SESSION['error_message']="Вы заполнили не все поля";
		}
	}

	$sql0="DELETE FROM `users` WHERE `reg_date` < ( NOW() - INTERVAL 3 DAY )";
	$result=mysqli_query($conn,$sql0) or die ("Ошибка удаления лишних");
?>

<html>
<head>
	<meta charset="utf-8"> 
	<link rel="stylesheet" type="text/css"  media="screen" href="game_style.css">
	<link rel="SHORTCUT ICON" href=" public_html/favicon.ico" type="image/x-icon">
</head>
<body>
<a href="http://localhost/Game/"><div id="info" style="margin-top: 5%;">Назад</div></a>
<form class="" action="" method="POST">
	<?php
		if (isset($_SESSION['error_message'])){
	?>
			<div class="error_box">
				<div class="error_block">
					<p class="err_text">
						<?php echo($_SESSION['error_message']);?>
					</p>
				</div>
			</div>
		<?php
			unset($_SESSION['success_message']);
			unset($_SESSION['error_message']);
		}
		?>
		<p><input name="username" type="text" size="30" placeholder="Имя пользователя" value="" pattern="^[А-Яа-яЁё\s\a-zA-Z\0-9]+$"></p>
		<p><input name="userpass" type="password" size="30" placeholder="Пароль" value="" ></p>
		<div>
			<input type="submit" name="b_ent" class="butt" value="Подтвердить">
		</div>
	</form>	
</body>