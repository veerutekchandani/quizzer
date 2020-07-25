var defaultListItem = <?php echo json_encode($firstquesid); ?>;
var defaultQues = "ques_"+defaultListItem;
$(document).ready(function() {
	
	$('.clickable').click(function(event){
			var activeQues = event.target.id;
			var activeListItem = activeQues;
			
			$("#"+defaultListItem).removeClass("active");
			$("#"+activeListItem).addClass("active");
			defaultListItem=activeListItem;
			activeQues = "ques_"+activeQues;
			$("#"+defaultQues).attr("hidden",true);
			$("#"+activeQues).removeAttr("hidden");
			defaultQues=activeQues;
	})
});

var noOfQuestion = <?php echo json_encode($noOfQuestion); ?>;
var type = <?php echo json_encode($TYPE); ?>;
var answer = <?php echo json_encode($ANSWER); ?>;
var contestid = <?php echo json_encode($ContestId); ?>;

var userAnswer = [];
var isAns = [];

for(var i=0;i<=noOfQuestion;i++) {
	isAns[i]=0;
}

function checkAnswer() {
	var id = defaultListItem;
	var name = "choice_"+id;
	if(type[id]=="MCSA") {
		var ele = document.getElementsByName(name);
		for(i=0;i<ele.length;i++) {
			if(ele[i].checked) {
				if(i==0)
					userAnswer[id]="a";
				else if(i==1)
					userAnswer[id]="b";
				else if(i==2)
					userAnswer[id]="c";
				else
					userAnswer[id]="d";
				break;
			}
		}
		isAns[id]=1;
	}
	else if(type[id]=="TF") {
		var ele = document.getElementsByName(name);
		for(i=0;i<ele.length;i++) {
			if(ele[i].checked) {
				if(i==0)
					userAnswer[id]="True";
				else
					userAnswer[id]="False";
				break;
			}
		}
		isAns[id]=1;
	}
	else if(type[id]=="MCMA") {
		var ele = document.getElementsByName(name);
		var x ="";
		for(i=0;i<ele.length;i++) {
			if(ele[i].checked) {
				if(i==0)
					x+="a,";
				else if(i==1)
					x+="b,";
				else if(i==2)
					x+="c,";
				else
					x+="d,";
			}
		}
		isAns[id]=1;
		userAnswer[id]=x;
	}
	else {
		var ele = document.getElementById(name).value;
		userAnswer[id]=ele;
		isAns[id]=1;
	}
}

var marks = 0;
function calculateMarks() {
	for(var i=1;i<=noOfQuestion;i++) {
		if(type[i]=="TF" && isAns[i]==1) {
			if(answer[i]==userAnswer[i]) {
				marks+=4;
			}
			else {
				marks-=2;
			}
		}
		else if(isAns[i]==1){
			if(answer[i]==userAnswer[i]) {
				marks+=4;
			}
			else {
				marks-=1;
			}
		}
	}
	window.location="Contest_Finish.php?contestid="+contestid+"&"+"marks="+marks;
}

var end = <?php echo json_encode($endtime); ?>;
var endtime = new Date(end);

function startTime() {	
	var currenttime = new Date();
	var diff = endtime-currenttime;

	var secs = Math.floor(diff/1000);
	var mins = Math.floor(diff/(60000));
	var hrs = Math.floor(mins/60);
	var days = Math.floor(hrs/24);
	secs = secs % 60;
	mins = mins%60;
	hrs = hrs%60;
	days = days%365;

	if(days==0 && hrs==0 && mins==0 && secs==0) {
		window.location="Contest_Finish.php?contestid="+contestid+"&"+"marks="+marks;
	}

	secs = checkTime(secs);
	mins = checkTime(mins);
	hrs = checkTime(hrs);
	days = checkTime(days);

	if(days!=0)
		document.getElementById("time").innerHTML = days+":"+hrs+":"+mins+":"+secs;
	else if(hrs!=0)
		document.getElementById("time").innerHTML = hrs+":"+mins+":"+secs;
	else
		document.getElementById("time").innerHTML = mins+":"+secs;
	var t = setTimeout(function(){ startTime() }, 500);
}

function checkTime(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}
