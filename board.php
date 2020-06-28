<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Крестики-нолики</title>
	<link rel="stylesheet" href="game_style.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	
</head>
<body>
	<div id="message" class="text"></div>
	<br>
	<div class="field">
	<div  id="area">
		<div class="block"></div>
		<div class="block"></div>
		<div class="block"></div>
		<div class="block"></div>
		<div class="block"></div>
		<div class="block"></div>
		<div class="block"></div>
		<div class="block"></div>
		<div class="block"></div>
	</div>

	<div align="center">
		<button id="reload" class="butt">Начать заново</button>
        <button id="back" class="butt">Выйти из игры</button>
	</div>
    </div>
    <?php
    if($_GET['level']=="easy"){
        echo('<script type="text/javascript" src="js/playAIeasy.js"></script>
	    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>');
    }
    else if($_GET['level']=="hard"){
        echo('<script type="text/javascript" src="js/playAIhard.js"></script>
	    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>');
    }
    ?>

</body>
</html>
