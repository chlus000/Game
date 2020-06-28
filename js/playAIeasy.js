var isFinished = 0;
var message=document.querySelector('#message'),
	move = 0;
var boxes = document.getElementsByClassName('block');
		
		$(document).ready(function() {

			var area = document.getElementById('area');
			area.addEventListener('click', function (event) {
				if (event.target.innerHTML == '' && !isFinished) {
					{
						event.target.innerHTML = 'X';
						move++;
						check();
						if(!isFinished){AImove();};

					}
				}
			});


			$('#reload').click(function () {
				location.href = "reload.php" + location.search;
			});

			$('#back').click(function () {
				location.href = "finalise.php" + location.search +"&ppl=single";
			});

		});

	function check(){

		var arr = [
			[0,1,2],
			[3,4,5],
			[6,7,8],

			[0,3,6],
			[1,4,7],
			[2,5,8],

			[0,4,8],
			[2,4,6]
		]

		for(var i = 0; i< arr.length; i++) {
			if (boxes[arr[i][0]].innerHTML == 'X' && boxes[arr[i][1]].innerHTML == 'X' && boxes[arr[i][2]].innerHTML == 'X') {
				message.innerHTML = "Победили крестики!";
				isFinished = 1;
				$.get("win.php");
			}
		}
		if(!isFinished){
			for(var i = 0; i< arr.length; i++){
				if (boxes[arr[i][0]].innerHTML=='O' && boxes[arr[i][1]].innerHTML=='O' && boxes[arr[i][2]].innerHTML=='O'){
					message.innerHTML="Победили нолики!";
					isFinished = 1;
					$.get("lose.php");
				}else if(!isFinished&&move==9){
					message.innerHTML="Ничья!";
					isFinished = 1;
					$.get("tie.php");
				}
			}
		}
	}

		function AImove() {
			var computerSpot = getRandomInt(0.5, 7.5);
			if(boxes[computerSpot].innerHTML == ''){
				boxes[computerSpot].innerHTML = 'O';
				move++;
				check();
				return;
			}
			else{AImove();}
		}

		function getRandomInt(min, max) {
			let rand = min - 0.5 + Math.random() * (max - min + 1);
			return Math.round(rand);
		}
