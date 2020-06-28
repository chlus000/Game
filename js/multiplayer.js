var isFinished = 0;
var message=document.querySelector('#message'),
	move=0;
$(document).ready(function()
	{	
	var area = document.getElementById('area');

	setInterval('GetField()', 1000);

	area.addEventListener('click',function(event){
	if(event.target.innerHTML=='' && !isFinished){
		SetField(event.target.id);
		move++;
}
});
$('#back').click(function(){
	isFinished=1;
	location.href = "finalise.php"+location.search+"&ppl=multi";
});
});
function check(){
	var boxes = document.getElementsByClassName('block');
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
			//$.get("win.php");
		}
	}
	if(!isFinished){
		for(var i = 0; i< arr.length; i++){
			if (boxes[arr[i][0]].innerHTML=='O' && boxes[arr[i][1]].innerHTML=='O' && boxes[arr[i][2]].innerHTML=='O'){
				message.innerHTML="Победили нолики!";
				isFinished = 1;
				//$.get("lose.php");
			}else if(!isFinished&&move==9){
				message.innerHTML="Ничья!";
				isFinished = 1;
				//$.get("tie.php");
			}
		}
	}
}

function GetField(){
	if(!isFinished){
		var request = new XMLHttpRequest();
		var params = location.search.slice(1);
		request.onreadystatechange = function(){
			if(request.readyState == 4) {
				if(request.responseText!=0){
					document.querySelector('#area').innerHTML = request.responseText;
					check();
				}
			}
		}
		request.open('POST','pull_field.php');
		request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
		request.send(params);
	}

}

function SetField(event){
	if(!isFinished){
		var request = new XMLHttpRequest();
		var params = location.search.slice(1)+'&'+'event='+event;
		request.open('POST','push_field.php');
		request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
		request.send(params);
	}

}