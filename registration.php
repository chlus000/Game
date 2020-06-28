<?php
	session_start();
	include "connection.php";
	
	if (isset($_POST['btn_sub_reg'])){
		if (isset($_POST['newmail']) && isset($_POST['newname'])&& isset($_POST['newpass'])&& isset($_POST['repeatpass'])) {
			$newUserMail=trim($_POST['newmail']);
			$newUserMail=htmlspecialchars($newUserMail);
			$token = password_hash($newUserMail, PASSWORD_DEFAULT);;
			$newusername=trim($_POST['newname']);
			$newusername=htmlspecialchars($newusername, ENT_QUOTES);
			$newUserPassword=$_POST['newpass'];
			$newUserPassword=htmlspecialchars($newUserPassword, ENT_QUOTES);
			$paswordRepeat=$_POST['repeatpass'];
			if ($paswordRepeat==$newUserPassword){
				$sql1="SELECT * FROM `users` WHERE `email`='".$newUserMail."'";
				$result1 = mysqli_query($conn,$sql1)or die("Ошибка 1");
				$row1=$result1->fetch_array(MYSQLI_ASSOC);
				if ($row1['id']==null){
					$result1->close();
					$sql1="SELECT * FROM `users` WHERE `username`='".$newusername."'";
					$result1 = mysqli_query($conn,$sql1)or die("Ошибка 2");
					$row1=$result1->fetch_array(MYSQLI_ASSOC);
					if ($row1==null){
						$result1->close();
						$hashPass = password_hash($newUserPassword, PASSWORD_DEFAULT);
						date_default_timezone_set('Asia/Vladivostok');
						$dat=date('Y-m-d H:i:s');
						$sql1 = "INSERT INTO `users` VALUES (
									id,
									'$newusername', 
									'$hashPass',
									'$newUserMail',
									'$dat',
									'$token', 
									0,
									0,
									0,
									0
									)";
						$result1=mysqli_query($conn, $sql1) or die("Ошибка подключения");
						$_SESSION['success_message']="Вы успешно зарегистрировались";
						$subject="Подтверждение почты на сайте".$_SERVER['HTTP_HOST']."=?utf-8?B?".base64_encode($subject)."?=";
								$message = '<div style="">
										<div style="">
											Здравствуйте!
										</div>
										<div style="">
											Сегодня '.date("d.m.Y", time()).', неким пользователем была произведена регистрация на сайте <a style="" href="http://localhost/Game/">'.$_SERVER['HTTP_HOST'].'</a> используя Ваш email. Если это были Вы, то, пожалуйста, подтвердите адрес вашей электронной почты, перейдя по этой ссылке: <a style="" href="http://localhost/Game/activation.php?token='.$token.'&email='.$newUserMail.'">http://localhost/Game/activation/'.$token.'</a>
										</div>
										<div style="">
											В противном случае, если это были не Вы, то, просто игнорируйте это письмо.
										</div>
										<div style="">
											<strong>Внимание!</strong> Ссылка действительна 72 часа. После чего Ваш аккаунт будет удален из базы.
										</div>
									</div>'; 
								$headers = "FROM: $email_admin\r\nReply-to: $email_admin\r\nContent-type: text/html; charset=utf-8\r\n";
								mail($newUserMail, $subject, $message, $headers);
						header('Location: http://localhost/Game/');
					}
					else{
						$_SESSION['error_message']="Это имя уже занято";
					}	
				}
				else{
					$_SESSION['error_message']="Вы уже зарегистрированы";
				}
			}
			else{
				$_SESSION['error_message']="Пароли не совпадают";
			}
		}
		else {
			$_SESSION['error_message']="Вы заполнили не все поля";
		}
		$sql0="DELETE FROM `users` WHERE `reg_date` < ( NOW() - INTERVAL 3 DAY )";
		$result=mysqli_query($cnct,$sql0) or die ("Ошибка удаления лишних");
	}
?>


<html>
<head>
	<meta charset="utf-8"> 
	<link rel="stylesheet" type="text/css"  media="screen" href="game_style.css">
	<link rel="SHORTCUT ICON" href=" public_html/favicon.ico" type="image/x-icon">
</head>

<body>
<a href="http://localhost/Game/"><div id="info" style="margin-top: 5%;">Назад</div></a>
<form action="" method="POST">
		<?php
		if (isset($_SESSION['error_message'])){
			?>
				<div>
					<div>
						<p>
							<?php echo($_SESSION['error_message']);
							echo ($_SESSION['success_message']);
							unset($_SESSION['success_message']);
							unset($_SESSION['error_message']);
							?>
						</p>
					</div>
				</div>
			<?php
			unset($_SESSION['success_message']);
			unset($_SESSION['error_message']);
		}
		?>
			<div>
				<p><input name="newmail" type="text"  placeholder="Почта" value=""></p>
				<p><input name="newname" type="text"  placeholder="Имя пользовтеля" value="" pattern="^[А-Яа-яЁё\s\a-zA-Z\0-9]+$"></p>
				<p><input name="newpass" type="password"  placeholder="Пароль" value="" ></p>
				<p><input name="repeatpass" type="password"  placeholder="Повторить пароль" value=""></p>
				<div><input type="submit" name="btn_sub_reg" class="butt" value="Продолжить"></div>
			</div>
		</form>	
</body>