
function check(subjectname) {
        if(subjectname==="Other") { // if other subject is selected
          	$('#othersubject').removeAttr("hidden");   // show text box to enter subject name
          	$('#other').attr("required",true);
        }
        else {
          	$('#othersubject').attr("hidden",true);
        }
}


function myf(){
	var subject = $('#subject').val();
	var other = 0;
	if(subject=="Other") {
		other = 1;
		subject = $('#other').val();
	}
	var question = $('#question').val();
	var answer = document.getElementsByName('choice');

	for(var i=0;i<answer.length;i++) {
		if(answer[i].checked) {
			answer = answer[i].value;
			break;
		}
	}
	var choice1 = $('#choice1').val();
	var choice2 = $('#choice2').val();
	var choice3 = $('#choice3').val();
	var choice4 = $('#choice4').val();

	switch(answer) {
		case 'c': if(choice3=="") {
				  	$('#message').html('<span style="color:red; font-weight:bold;">You have selected empty choice.</span>');
				  	return false;
				  }
				  break;
		case 'd' : if(choice4=="") {
					$('#message').html('<span style="color:red; font-weight:bold;">You have selected empty choice.</span>');
					return false;
				  }	
				  break;
		}
		$('#message').html('<span style="color:green; font-weight:bold;">Submitted Successfully.</span>');
		document.getElementById("question-form").action = "Submit_Practice_Question.php?other="+other+"&answer="+answer;
  		document.getElementById("question-form").delay(3000).submit();
}