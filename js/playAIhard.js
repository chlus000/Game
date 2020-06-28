var isFinished = 0;
var message=document.querySelector('#message'),
	move = 0;
var boxes = document.getElementsByClassName('block');
$(document).ready(function()
	{
	var area = document.getElementById('area');
	area.addEventListener('click',function(event){
	if(event.target.innerHTML=='' && !isFinished){
	{	
		event.target.innerHTML = 'X';
		move++;
		check();
		AImove();
		
	}
}
});

$('#reload').click(function(){
	location.href = "reload.php" + location.search;
});

$('#back').click(function(){
	location.href = "finalise.php"+location.search+"&ppl=single";
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

function AImove(){
		if(move==2&&boxes[8].innerHTML=='X')
		{
			boxes[6].innerHTML='O';
			move++;
			check();
			return;
		}
		if(move==2&&boxes[2].innerHTML=='X')
		{
			boxes[6].innerHTML='O';
			move++;
			check();
			return;
		}
		if(move==2&&boxes[6].innerHTML=='X')
		{
			boxes[2].innerHTML='O';
			move++;
			check();
			return;
		}
		if(move==2&&boxes[5].innerHTML=='X')
		{
			boxes[2].innerHTML='O';
			move++;
			check();
			return;
		}
		if(move==2&&boxes[7].innerHTML=='X')
		{
			boxes[6].innerHTML='O';
			move++;
			check();
			return;
		}
		if(move==2&&boxes[4].innerHTML=='X')
		{
			boxes[8].innerHTML='O';
			move++;
			check();
			return;
		}
		if(move==2&&boxes[1].innerHTML=='X')
		{
			boxes[3].innerHTML='O';
			move++;
			check();
			return;
		}
		if(move==4&&boxes[1].innerHTML=='X'&&boxes[6].innerHTML=='X')
		{
			boxes[4].innerHTML='O';
			move++;
			check();
			return;
		}
		for(var i=0;i<boxes.length; i++)
		{
			if(boxes[i].innerHTML==''){
				if(isIHaveWin(i)){
					boxes[i].innerHTML='O';
					move++;
					check();
					return;
				}
			}
		}
		for(var i=0;i<boxes.length; i++)
		{
			if(boxes[i].innerHTML==''){
				if(isYouHaveWin(i)){
					boxes[i].innerHTML='O';
					move++;
					check();
					return;
				}
			}
		}
		for(var i=0;i<boxes.length; i++)
		{
			if(boxes[i].innerHTML==''){
				boxes[i].innerHTML='O';
				break;
			}
		}
		move++;
		check();
}

function isIHaveWin(num){
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
	boxes[num].innerHTML='O';
	for(var i = 0; i< arr.length; i++){
		if (boxes[arr[i][0]].innerHTML=='X' && boxes[arr[i][1]].innerHTML=='X' && boxes[arr[i][2]].innerHTML=='X'){
			boxes[num].innerHTML='';
			return 1;
		}else if(boxes[arr[i][0]].innerHTML=='O' && boxes[arr[i][1]].innerHTML=='O' && boxes[arr[i][2]].innerHTML=='O')	{
			boxes[num].innerHTML='';
			return 1;
		}	
	}
	boxes[num].innerHTML='';
	return 0;
}
function isYouHaveWin(num){
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
	boxes[num].innerHTML='X';
	for(var i = 0; i< arr.length; i++){
		if (boxes[arr[i][0]].innerHTML=='X' && boxes[arr[i][1]].innerHTML=='X' && boxes[arr[i][2]].innerHTML=='X'){
			boxes[num].innerHTML='';
			return 1;
		}else if(boxes[arr[i][0]].innerHTML=='O' && boxes[arr[i][1]].innerHTML=='O' && boxes[arr[i][2]].innerHTML=='O')	{
			boxes[num].innerHTML='';
			return 1;
		}	
	}
	boxes[num].innerHTML='';
	return 0;
}