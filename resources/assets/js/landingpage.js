
var submitButtonFormat = '<i class="checkmark icon"></i>Submit';
var nextButtonFormat = '<i class="angle double right icon"></i>Next';
var cancelButtonFormat = '<i class="remove icon"></i>Cancel';
var backButtonFormat = '<i class="angle double left icon"></i>Back';
var step = 1;
var max = 3;
$(document).ready(function(){
	
	$("#test").click(function(){
		$('#modal').modal({
        closable: false
     }).modal('show');
	});
	$('#btnNext').click(function(){
		handleStep(true);
		return false;
	})
	$('#btnBack').click(function(){
		handleStep(false);
		return false;
	})
});
function handleStep(isForward){
	if(step>=max&&isForward){
			//submit
			alert('submit');
	}else if(step==1&&(!isForward)){
		alert('exit');
	}else{
		if(isForward){
			step++;
		}else{
			step--;
		}
		if(step==max){
			document.getElementById('btnNext').innerHTML = submitButtonFormat;
		}else{
			document.getElementById('btnNext').innerHTML = nextButtonFormat;
		}
		if(step==1){
			document.getElementById('btnBack').innerHTML = cancelButtonFormat;
		}else{
			document.getElementById('btnBack').innerHTML = backButtonFormat;
		}
		alert(step);
		for(var i=step-1;i>0;i--){
			document.getElementById("step"+i).className = "completed step";
			document.getElementById("form"+i).style.display = "none";
		}
		for(var i=step+1;i<=max;i++){
			document.getElementById("step"+i).className = "step";
			document.getElementById("form"+i).style.display = "none";
		}
		document.getElementById("step"+step).className = "active step";
		document.getElementById("form"+step).style.display = "block";
	}
	
}