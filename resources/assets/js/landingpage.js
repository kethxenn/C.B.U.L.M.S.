
var submitButtonFormat = '<i class="checkmark icon"></i>Submit';
var nextButtonFormat = '<i class="angle double right icon"></i>Next';
var cancelButtonFormat = '<i class="remove icon"></i>Cancel';
var backButtonFormat = '<i class="angle double left icon"></i>Back';
var step = 1;
var max = 3;
$(document).ready(function(){
	
	$("#test").click(function(){
		$('#modal').modal({
        closable: false,
        observeChanges: true
     }).modal('show').modal('refresh');
	});
	$('#btnNext').click(function(e){
		e.preventDefault();
		handleStep(true);
		return false;
	})
	$('#btnBack').click(function(){
		handleStep(false);
		return false;
	})
	$('.dropdown').dropdown();
	$('.ui.checkbox').checkbox();
	$('#form2').form({
    fields: {
      firstname: {
        identifier: 'first-name',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter your first name'
          }
        ]
      },
      lastname: {
        identifier: 'last-name',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter your last name'
          }
        ]
      },
      email:{
      	identifier:'email',
      	rules:[{
      		type: 'email',
      		prompt:'Please enter a valid email'
      	}]
      },
      gender: {
        identifier: 'gender',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select a gender'
          }
        ]
      },
      address:{
      	identifier:'address',
      	rules:[{
      		type: 'empty',
      		prompt: 'Please enter your address'
      	}]
      },
      terms: {
        identifier: 'terms',
        rules: [
          {
            type   : 'checked',
            prompt : 'You must agree to the terms and conditions'
          }
        ]
      }
    }
  })
;
});
function handleStep(isForward){
	if(step>=max&&isForward){
		//submit logic
			
	}else if(step==1&&(!isForward)){
		$('#modal').modal('hide');
	}else{
		if(isForward){
			//check if form step is valid
			var t = '#form'+step;
			if($(t).form('is valid')){
				updateStepUI(true);
			}else{
				$(t).form('validate form');
			}
		}else{
			updateStepUI(false);
		}
		
	}
	function updateStepUI(isForward){
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
		//alert(step);
		for(var i=step-1;i>0;i--){
			document.getElementById("step"+i).className = "completed step";
			document.getElementById("container"+i).style.display = "none";
		}
		for(var i=step+1;i<=max;i++){
			document.getElementById("step"+i).className = "step";
			document.getElementById("container"+i).style.display = "none";
		}
		document.getElementById("step"+step).className = "active step";
		document.getElementById("container"+step).style.display = "block";
	}
	
}